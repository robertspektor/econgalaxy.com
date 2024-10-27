@props(['id', 'name', 'image', 'description', 'benefits', 'drawbacks' => [], 'selected' => false])


<div wire:click="chooseOrigin({{ $id }})" class="
    p-4 group relative flex flex-col border rounded-lg

    {{ !$selected ? 'border-gray-200 bg-white hover:border-gray-300 dark:bg-neutral-800 dark:border-neutral-700/50 dark:hover:border-neutral-700'
    : 'border-blue-500 bg-blue-50 dark:bg-blue-900 dark:border-blue-500' }}
    ">
    <div class="h-full flex gap-x-5">
        <div class="w-64">
            <img class="rounded-lg" src="{{ asset('/images/origins/' . $image) }}" alt="{{ $name }}">
        </div>

        <div class="grow">
            <div class="h-full flex flex-col">
                <div>
                    <h3 class="inline-flex items-center gap-x-1 font-medium text-gray-800 dark:text-neutral-200">
                        {{ $name }}
                    </h3>

                    <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
                        {{ $description }}
                    </p>

                    <ul class="mt-2 text-sm text-gray-500 dark:text-neutral-500">
                        @foreach($benefits as $benefit)
                            <li class="flex gap-x-1">
                                <svg class="size-4 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ $benefit }}
                            </li>
                        @endforeach
                    </ul>

                    <ul class="mt-2 text-sm text-gray-500 dark:text-neutral-500">
                        @foreach($drawbacks as $drawback)
                            <li class="flex gap-x-1">
                                <svg class="size-4 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                {{ $drawback }}
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <a class="after:absolute after:inset-0 after:z-10" href="#"></a>
</div>
