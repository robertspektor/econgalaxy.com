<div>
{{--    <div id="hs-pro-shac2" class="p-1 flex flex-col bg-gray-100 border border-gray-200 rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 h-[32rem]">--}}
{{--        <!-- Body -->--}}
{{--        <div class=" h-full min-h-40 bg-white rounded-xl shadow-sm dark:bg-neutral-900 overflow-hidden z-40">--}}
            <div id="system-map" class=""></div>
{{--        </div>--}}
        <!-- End Body -->

        <!-- Footer -->
{{--        <div class="mt-auto">--}}
{{--            <ul class="flex flex-wrap justify-center items-center gap-3">--}}
{{--                <li class="inline-flex items-center relative text-xs text-gray-500 pe-3.5 last:pe-0 last:after:hidden after:absolute after:top-1/2 after:end-0 after:inline-block after:w-px after:h-3 after:bg-gray-300 after:-translate-y-1/2 dark:text-neutral-500 dark:after:bg-neutral-600">--}}
{{--                    <button type="button" class="py-3 font-medium text-xs text-gray-800 underline underline-offset-4 hover:text-indigo-600 focus:outline-none focus:text-indigo-600 disabled:opacity-50 disabled:pointer-events-none disabled:no-underline dark:text-neutral-200 dark:hover:text-indigo-400 dark:focus:text-indigo-400" data-hs-overlay="#hs-pro-sheam">--}}
{{--                        Edit--}}
{{--                    </button>--}}
{{--                </li>--}}
{{--                <li class="inline-flex items-center relative text-xs text-gray-500 pe-3.5 last:pe-0 last:after:hidden after:absolute after:top-1/2 after:end-0 after:inline-block after:w-px after:h-3 after:bg-gray-300 after:-translate-y-1/2 dark:text-neutral-500 dark:after:bg-neutral-600">--}}
{{--                    <button type="button" class="py-3 font-medium text-xs text-gray-800 underline underline-offset-4 hover:text-indigo-600 focus:outline-none focus:text-indigo-600 disabled:opacity-50 disabled:pointer-events-none disabled:no-underline dark:text-neutral-200 dark:hover:text-indigo-400 dark:focus:text-indigo-400"  data-hs-remove-element="#hs-pro-shac2">--}}
{{--                        Remove--}}
{{--                    </button>--}}
{{--                </li>--}}
{{--                <li class="inline-flex items-center relative text-xs text-gray-500 pe-3.5 last:pe-0 last:after:hidden after:absolute after:top-1/2 after:end-0 after:inline-block after:w-px after:h-3 after:bg-gray-300 after:-translate-y-1/2 dark:text-neutral-500 dark:after:bg-neutral-600">--}}
{{--                    <button type="button" class="py-3 font-medium text-xs text-gray-800 underline underline-offset-4 hover:text-indigo-600 focus:outline-none focus:text-indigo-600 disabled:opacity-50 disabled:pointer-events-none disabled:no-underline dark:text-neutral-200 dark:hover:text-indigo-400 dark:focus:text-indigo-400" >--}}
{{--                        Set as default--}}
{{--                    </button>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
        <!-- End Footer -->
    </div>

{{--</div>--}}

<script>

    document.addEventListener('livewire:navigated', function () {
        renderSystemMap();
    });

</script>
