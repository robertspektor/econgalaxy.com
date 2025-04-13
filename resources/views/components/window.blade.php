<div
    x-data="{
        isDragging: false,
        isResizing: false,
        isMinimized: false,
        isMaximized: false,
        posX: {{ $app['position']['x'] ?? 100 }},
        posY: {{ $app['position']['y'] ?? 100 }},
        mouseX: 0,
        mouseY: 0,
        width: {{ $app['size']['width'] ?? 500 }},
        height: {{ $app['size']['height'] ?? 300 }},
        default: { x: {{ $app['position']['x'] ?? 100 }}, y: {{ $app['position']['y'] ?? 100 }}, width: {{ $app['size']['width'] ?? 500 }}, height: {{ $app['size']['height'] ?? 300 }} },

        init() {
            this.posX = {{ $app['position']['x'] ?? 100 }};
            this.posY = {{ $app['position']['y'] ?? 100 }};
            this.width = {{ $app['size']['width'] ?? 500 }};
            this.height = {{ $app['size']['height'] ?? 300 }};
            this.default = { x: this.posX, y: this.posY, width: this.width, height: this.height };
            console.log('Window initialized: ', { posX: this.posX, posY: this.posY, width: this.width, height: this.height });
        },
        startDrag(e) {
            if (this.isMinimized || this.isMaximized) return;
            this.isDragging = true;
            this.isResizing = false;
            this.mouseX = e.clientX - this.posX;
            this.mouseY = e.clientY - this.posY;
            console.log('Start dragging: ', { mouseX: this.mouseX, mouseY: this.mouseY });
        },
        onDrag(e) {
            if (this.isDragging) {
                this.posX = e.clientX - this.mouseX;
                this.posY = e.clientY - this.mouseY;
                $dispatch('window:move', { name: '{{ $windowId }}', x: this.posX, y: this.posY });
                console.log('Dragging: ', { posX: this.posX, posY: this.posY });
            }
        },
        stopDrag() {
            this.isDragging = false;
            console.log('Stop dragging');
        },
        startResize(e) {
            if (this.isMinimized || this.isMaximized) return;
            this.isResizing = true;
            this.isDragging = false;
            this.mouseX = e.clientX;
            this.mouseY = e.clientY;
            console.log('Start resizing: ', { mouseX: this.mouseX, mouseY: this.mouseY });
        },
        onResize(e) {
            if (this.isResizing) {
                let deltaX = e.clientX - this.mouseX;
                let deltaY = e.clientY - this.mouseY;

                this.width += deltaX;
                this.height += deltaY;

                // Minimale Größe sicherstellen
                this.width = Math.max(300, this.width);
                this.height = Math.max(200, this.height);

                this.mouseX = e.clientX;
                this.mouseY = e.clientY;

                $dispatch('window:resize', { name: '{{ $windowId }}', width: this.width, height: this.height });
                console.log('Resizing: ', { width: this.width, height: this.height });
            }
        },
        stopResize() {
            this.isResizing = false;
            console.log('Stop resizing');
        },
        close() {
            $dispatch('window:close', { name: '{{ $windowId }}' });
            console.log('Close window: {{ $windowId }}');
        },
        minimize() {
            this.isMinimized = true;
            $dispatch('window:minimize', { name: '{{ $windowId }}' });
            console.log('Minimize window: {{ $windowId }}');
        },
        maximize() {
            this.isMaximized = !this.isMaximized;
            if (this.isMaximized) {
                this.posX = 0;
                this.posY = 0;
                this.width = window.innerWidth;
                this.height = window.innerHeight - 48;
            } else {
                this.width = this.default.width;
                this.height = this.default.height;
                this.posX = this.default.x;
                this.posY = this.default.y;
            }
            $dispatch('window:resize', { name: '{{ $windowId }}', width: this.width, height: this.height });
            $dispatch('window:move', { name: '{{ $windowId }}', x: this.posX, y: this.posY });
            console.log('Maximize/Minimize window: ', { isMaximized: this.isMaximized, width: this.width, height: this.height });
        }
    }"
    x-init="init()"
    x-show="!isMinimized"
    :style="`top: ${posY}px; left: ${posX}px; width: ${width}px; height: ${height}px;`"
    class="fixed z-40 bg-[#1a1a24] border border-zinc-700 rounded shadow-xl overflow-hidden text-sm text-gray-300"
    @mousemove.window="isDragging ? onDrag($event) : onResize($event)"
    @mouseup.window="isDragging ? stopDrag() : stopResize()"
>
    <!-- HEADER / TITLE BAR -->
    <div
        class="bg-[#23232f] text-white px-4 py-2 cursor-move flex justify-between items-center border-b border-zinc-700 select-none"
        @mousedown="startDrag"
    >
        <span>{{ $title }}</span>
        <div class="flex gap-1">
            <button @click="minimize"
                    class="w-6 h-6 flex items-center justify-center text-xs bg-yellow-400 text-black rounded-full hover:bg-yellow-300">–</button>
            <button @click="maximize"
                    class="w-6 h-6 flex items-center justify-center text-xs bg-green-500 text-black rounded-full hover:bg-green-400">☐</button>
            <button @click="close"
                    class="w-6 h-6 flex items-center justify-center text-xs bg-red-500 text-white rounded-full hover:bg-red-400">×</button>
        </div>
    </div>

    <!-- BODY -->
    <div class="p-4 h-full overflow-auto">
        {{ $slot }}
    </div>

    <!-- Resize Handle (nur unten rechts) -->
    <div class="absolute bottom-0 right-0 w-4 h-4 cursor-se-resize">
        <svg class="text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4l16 16m0-16L4 20"></path>
        </svg>
        <div class="absolute inset-0" @mousedown="startResize($event)"></div>
    </div>
</div>
