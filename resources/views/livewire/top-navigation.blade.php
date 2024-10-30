<nav class="fixed w-full justify-center z-40 bg-white border-b border-gray-200 dark:bg-neutral-900 dark:border-neutral-800">
    <div class="flex justify-between items-center mx-auto md:py-2.5 px-4 sm:px-6 lg:px-8">

        <div class=""></div>

        <!-- Nav Links -->
        <div class="">
            <div  class="overflow-hidden transition-all duration-300 md:block" >
                <div class="md:flex md:flex-wrap md:items-center md:gap-x-1 py-2 md:py-0 space-y-0.5 md:space-y-0">

                    <a wire:navigate href="{{ route('galaxy.index') }}" class="py-2 px-3 md:px-2.5 xl:px-2 flex items-center gap-x-2 text-sm text-start text-nowrap text-gray-800 rounded-lg hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:text-neutral-200 dark:hover:bg-neutral-800/40 dark:focus:bg-neutral-800">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="1"></circle>
                            <path d="M2 12a10 10 0 0 1 20 0a10 10 0 0 1-20 0"></path>
                            <path d="M4.5 12a7.5 7.5 0 0 1 15 0a7.5 7.5 0 0 1-15 0"></path>
                            <path d="M7 12a5 5 0 0 1 10 0a5 5 0 0 1-10 0"></path>
                        </svg>
                        Galaxyansicht
                    </a>

                    <a class="py-2 px-3 md:px-2.5 xl:px-2 flex items-center gap-x-2 text-sm text-start text-nowrap text-gray-800 rounded-lg hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:text-neutral-200 dark:hover:bg-neutral-800/40 dark:focus:bg-neutral-800" href="#">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="7" height="7" x="14" y="3" rx="1"></rect>
                            <path d="M10 21V8a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H3"></path>
                        </svg>
                        Integrations
                    </a>


                    <div class="md:flex md:justify-end md:items-center md:gap-x-2 md:ms-auto">
                        <a class="flex items-center gap-x-2 p-2 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-800 dark:text-neutral-300 dark:focus:bg-neutral-800" href="../../pro/index.html">
                  <span class="flex justify-center items-center size-5 bg-indigo-600 text-white rounded-md dark:bg-indigo-500">
                    <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>
                      <path d="m3.3 7 8.7 5 8.7-5"></path>
                      <path d="M12 22V12"></path>
                    </svg>
                  </span>
                            PRO
                        </a>


                    </div>
                </div>
            </div>
            <!-- End Collapse -->
        </div>
        <!-- End Nav Links -->

        <div class="">
            <a class="py-2 px-3 md:px-2.5 xl:px-2 flex items-center gap-x-2 text-sm text-start text-nowrap text-yellow-400 rounded-lg hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:text-yellow-400 dark:hover:bg-neutral-800/40 dark:focus:bg-neutral-800" href="#">
                10.000
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="8" r="6"/><path d="M18.09 10.37A6 6 0 1 1 10.34 18"/><path d="M7 6h1v4"/><path d="m16.71 13.88.7.71-2.82 2.82"/></svg>
            </a>
        </div>
    </div>
</nav>
