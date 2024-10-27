<div>
    <livewire:maps.system-map />
    <!-- Overlay User Profile -->
{{--    <div class="relative pt-5 before:absolute before:top-0 before:start-0 before:-z-[1] before:w-full before:h-[200px] lg:before:h-[230px] before:bg-gray-800 dark:before:bg-neutral-950">--}}
{{--        <div class="max-w-[90rem] mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="flex sm:items-center gap-5 pt-4 lg:pt-10 mb-5 md:mb-8">--}}
{{--                <!-- Avatar -->--}}
{{--                <div class="shrink-0">--}}
{{--                    <div class="relative shrink-0">--}}
{{--                        <div class="shrink-0 size-16 sm:size-20 bg-gray-700 rounded-3xl dark:bg-neutral-900">--}}
{{--                          <span class="flex shrink-0 justify-center items-center size-16 sm:size-20 bg-gray-600 text-2xl font-semibold uppercase text-white rounded-2xl sm:rounded-3xl">--}}
{{--                            {{ $sector->name[0] }} {{ $sector->name[1] }}--}}
{{--                          </span>--}}
{{--                        </div>--}}
{{--                        <div class="absolute -bottom-3 inset-x-0 text-center">--}}
{{--                            <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-semibold uppercase rounded-md bg-gradient-to-tr from-lime-500 to-teal-500 text-white">Pro</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- End Avatar -->--}}

{{--                <!-- Body -->--}}
{{--                <div class="grow">--}}
{{--                    <h1 class="text-2xl md:text-3xl font-semibold text-white">--}}
{{--                        {{ $sector->name }}--}}
{{--                    </h1>--}}

{{--                    <!-- List -->--}}
{{--                    <ul class="mt-2 flex flex-wrap items-center gap-x-3">--}}
{{--                        <li class="relative before:hidden md:before:inline-block first:before:hidden first:before:ms-0 before:content-['•'] before:text-white/40 before:me-1.5">--}}
{{--                            <span class="text-sm text-white/50">--}}
{{--                              {{ __('Faction') }}:--}}
{{--                            </span>--}}
{{--                            <span class="inline-flex items-center gap-x-2 text-sm text-gray-200">--}}
{{--                                {{ $sector->faction->name }}--}}
{{--                            </span>--}}
{{--                        </li>--}}

{{--                        <li class="relative before:hidden md:before:inline-block first:before:hidden first:before:ms-0 before:content-['•'] before:text-white/40 before:me-1.5">--}}
{{--                            <span class="text-sm text-white/50">--}}
{{--                                {{ __('Celestial bodies') }}:--}}
{{--                            </span>--}}
{{--                            <span class="inline-flex items-center gap-x-2 text-sm text-gray-200">--}}
{{--                                {{ $sector->celestialBodies?->count() }}--}}
{{--                            </span>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                    <!-- End List -->--}}
{{--                </div>--}}
{{--                <!-- End Body -->--}}

{{--                <div class="ms-auto">--}}
{{--                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-nowrap text-sm bg-white/10 text-white rounded-lg hover:bg-white/20 focus:outline-none focus:bg-white/20 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#@@modalID">--}}
{{--                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                            <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />--}}
{{--                            <path d="M8 12h.01" />--}}
{{--                            <path d="M12 12h.01" />--}}
{{--                            <path d="M16 12h.01" />--}}
{{--                        </svg>Contact--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- End Overlay User Profile -->

    <!-- Content -->
{{--    <div class="max-w-[90rem] mx-auto sm:px-6 lg:px-8">--}}
{{--        <!-- Stats Grid -->--}}
{{--        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-4">--}}
{{--            <!-- Card -->--}}
{{--            <a class="group p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg hover:-translate-y-0.5 focus:outline-none focus:shadow-lg focus:-translate-y-0.5 transition dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-black" href="#">--}}
{{--                <div class="flex gap-x-3">--}}
{{--                    <div class="grow">--}}
{{--                        <h2 class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                            Total hours (7D)--}}
{{--                        </h2>--}}
{{--                        <p class="text-xl font-semibold text-gray-800 dark:text-white">--}}
{{--                            38h 9m--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <svg class="shrink-0 size-6 text-gray-500 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                        <path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5" />--}}
{{--                        <path d="M16 2v4" />--}}
{{--                        <path d="M8 2v4" />--}}
{{--                        <path d="M3 10h5" />--}}
{{--                        <path d="M17.5 17.5 16 16.25V14" />--}}
{{--                        <path d="M22 16a6 6 0 1 1-12 0 6 6 0 0 1 12 0Z" />--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--                <span class="mt-3 inline-flex items-center gap-x-1 text-sm text-teal-600 font-medium group-hover:text-teal-500 group-focus:text-teal-500">--}}
{{--            View reports--}}
{{--            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">--}}
{{--              <path d="m9 18 6-6-6-6" />--}}
{{--            </svg>--}}
{{--          </span>--}}
{{--            </a>--}}
{{--            <!-- End Card -->--}}

{{--            <!-- Card -->--}}
{{--            <a class="group p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg hover:-translate-y-0.5 focus:outline-none focus:shadow-lg focus:-translate-y-0.5 transition dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-black" href="#">--}}
{{--                <div class="flex gap-x-3">--}}
{{--                    <div class="grow">--}}
{{--                        <h2 class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                            Avg. daily hours--}}
{{--                        </h2>--}}
{{--                        <p class="text-xl font-semibold text-gray-800 dark:text-white">--}}
{{--                            5h 32m--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <svg class="shrink-0 size-6 text-gray-500 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                        <path d="M5 22h14" />--}}
{{--                        <path d="M5 2h14" />--}}
{{--                        <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22" />--}}
{{--                        <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2" />--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--                <span class="mt-3 inline-flex items-center gap-x-1 text-sm text-teal-600 font-medium group-hover:text-teal-500 group-focus:text-teal-500">--}}
{{--            View reports--}}
{{--            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">--}}
{{--              <path d="m9 18 6-6-6-6" />--}}
{{--            </svg>--}}
{{--          </span>--}}
{{--            </a>--}}
{{--            <!-- End Card -->--}}

{{--            <!-- Card -->--}}
{{--            <a class="group p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg hover:-translate-y-0.5 focus:outline-none focus:shadow-lg focus:-translate-y-0.5 transition dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-black" href="#">--}}
{{--                <div class="flex gap-x-3">--}}
{{--                    <div class="grow">--}}
{{--                        <h2 class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                            Over limit--}}
{{--                        </h2>--}}
{{--                        <p class="text-xl font-semibold text-gray-800 dark:text-white">--}}
{{--                            0s--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <svg class="shrink-0 size-6 text-gray-500 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                        <path d="M22 12A10 10 0 1 1 12 2" />--}}
{{--                        <path d="M22 2 12 12" />--}}
{{--                        <path d="M16 2h6v6" />--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--                <span class="mt-3 inline-flex items-center gap-x-1 text-sm text-teal-600 font-medium group-hover:text-teal-500 group-focus:text-teal-500">--}}
{{--            View reports--}}
{{--            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">--}}
{{--              <path d="m9 18 6-6-6-6" />--}}
{{--            </svg>--}}
{{--          </span>--}}
{{--            </a>--}}
{{--            <!-- End Card -->--}}

{{--            <!-- Card -->--}}
{{--            <a class="group p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg hover:-translate-y-0.5 focus:outline-none focus:shadow-lg focus:-translate-y-0.5 transition dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-black" href="#">--}}
{{--                <div class="flex gap-x-3">--}}
{{--                    <div class="grow">--}}
{{--                        <h2 class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                            Under limit--}}
{{--                        </h2>--}}
{{--                        <p class="text-xl font-semibold text-gray-800 dark:text-white">--}}
{{--                            1h 51m--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <svg class="shrink-0 size-6 text-gray-500 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                        <path d="M2 12a10 10 0 1 1 10 10" />--}}
{{--                        <path d="m2 22 10-10" />--}}
{{--                        <path d="M8 22H2v-6" />--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--                <span class="mt-3 inline-flex items-center gap-x-1 text-sm text-teal-600 font-medium group-hover:text-teal-500 group-focus:text-teal-500">--}}
{{--            View reports--}}
{{--            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">--}}
{{--              <path d="m9 18 6-6-6-6" />--}}
{{--            </svg>--}}
{{--          </span>--}}
{{--            </a>--}}
{{--            <!-- End Card -->--}}
{{--        </div>--}}
{{--        <!-- End Stats Grid -->--}}

{{--        <!-- Card Grid Group -->--}}
{{--        <div class="mt-5 md:mt-10 grid md:grid-cols-8 gap-y-5 md:gap-y-0 md:gap-x-4">--}}
{{--            <div class="md:col-span-4 lg:col-span-5">--}}
{{--                <!-- Card -->--}}

{{--                <!-- End Card -->--}}
{{--            </div>--}}

{{--            <div class="md:col-span-4 lg:col-span-3">--}}
{{--                <!-- Card -->--}}
{{--                <div class="h-full relative flex flex-col bg-white border border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">--}}
{{--                    <div class="pt-2.5 px-4">--}}
{{--                        <h2 class="font-semibold text-gray-800 dark:text-white">--}}
{{--                            Total costs--}}
{{--                        </h2>--}}
{{--                    </div>--}}

{{--                    <!-- Body -->--}}
{{--                    <div class="p-1.5 flex flex-col h-full">--}}
{{--                        <div class="p-2.5">--}}
{{--                            <h4 class="font-semibold text-xl md:text-2xl text-gray-800 dark:text-white">--}}
{{--                                $7,800--}}
{{--                            </h4>--}}

{{--                            <!-- Progress -->--}}
{{--                            <div class="relative mt-3">--}}
{{--                                <div class="flex w-full h-2 bg-gray-200 rounded-sm overflow-hidden dark:bg-neutral-700" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100">--}}
{{--                                    <div class="flex flex-col justify-center rounded-sm overflow-hidden bg-teal-500 text-xs text-white text-center whitespace-nowrap transition duration-500" style="width: 72%"></div>--}}
{{--                                </div>--}}
{{--                                <div class="absolute top-1/2 start-[71%] w-2 h-5 bg-teal-500 border-2 border-white rounded-sm transform -translate-y-1/2 dark:border-neutral-700"></div>--}}
{{--                            </div>--}}
{{--                            <!-- End Progress -->--}}

{{--                            <!-- Progress Status -->--}}
{{--                            <div class="mt-3 flex justify-between items-center">--}}
{{--                  <span class="text-xs text-gray-500 dark:text-neutral-500">--}}
{{--                    $0.00 USD--}}
{{--                  </span>--}}
{{--                                <span class="text-xs text-gray-500 dark:text-neutral-500">--}}
{{--                    $12,000 USD--}}
{{--                  </span>--}}
{{--                            </div>--}}
{{--                            <!-- End Progress Status -->--}}

{{--                            <p class="mt-4 text-sm text-gray-600 dark:text-neutral-400">--}}
{{--                                A project-wise breakdown of total spendings complemented by detailed insights.--}}
{{--                            </p>--}}
{{--                        </div>--}}

{{--                        <!-- Top Earners -->--}}
{{--                        <div class="md:mt-auto p-2.5 rounded-lg bg-gray-100 dark:bg-neutral-900">--}}
{{--                            <h2 class="mb-3 text-sm font-semibold text-gray-800 dark:text-white">--}}
{{--                                Talents costs--}}
{{--                            </h2>--}}

{{--                            <!-- List Group -->--}}
{{--                            <ul class="mb-1 space-y-2">--}}
{{--                                <!-- Item -->--}}
{{--                                <li class="flex items-center gap-x-2">--}}
{{--                    <span class="flex shrink-0 justify-center items-center size-6 bg-white border border-gray-200 text-gray-800 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200 text-xs font-medium uppercase rounded-lg">--}}
{{--                      B--}}
{{--                    </span>--}}
{{--                                    <div class="grow flex justify-between items-center gap-x-2">--}}
{{--                      <span class="text-sm font-medium text-gray-600 dark:text-neutral-400">--}}
{{--                        BlueVista Innovations--}}
{{--                      </span>--}}
{{--                                        <span class="text-sm text-gray-600 dark:text-neutral-400">--}}
{{--                        $6,810--}}
{{--                      </span>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <!-- End Item -->--}}

{{--                                <!-- Item -->--}}
{{--                                <li class="flex items-center gap-x-2">--}}
{{--                    <span class="flex shrink-0 justify-center items-center size-6 bg-white border border-gray-200 text-gray-800 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200 text-xs font-medium uppercase rounded-lg">--}}
{{--                      T--}}
{{--                    </span>--}}
{{--                                    <div class="grow flex justify-between items-center gap-x-2">--}}
{{--                      <span class="text-sm font-medium text-gray-600 dark:text-neutral-400">--}}
{{--                        TerraNova Dynamics--}}
{{--                      </span>--}}
{{--                                        <span class="text-sm text-gray-600 dark:text-neutral-400">--}}
{{--                        $1,200--}}
{{--                      </span>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <!-- End Item -->--}}

{{--                                <!-- Item -->--}}
{{--                                <li class="flex items-center gap-x-2">--}}
{{--                    <span class="flex shrink-0 justify-center items-center size-6 bg-white border border-gray-200 text-gray-800 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200 text-xs font-medium uppercase rounded-lg">--}}
{{--                      L--}}
{{--                    </span>--}}
{{--                                    <div class="grow flex justify-between items-center gap-x-2">--}}
{{--                      <span class="text-sm font-medium text-gray-600 dark:text-neutral-400">--}}
{{--                        Lumen Systems--}}
{{--                      </span>--}}
{{--                                        <span class="text-sm text-gray-600 dark:text-neutral-400">--}}
{{--                        $680--}}
{{--                      </span>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <!-- End Item -->--}}
{{--                            </ul>--}}
{{--                            <!-- End List Group -->--}}

{{--                            <p class="text-center">--}}
{{--                                <a class="py-1 px-1.5 inline-flex items-center justify-center gap-x-1 text-xs hover:bg-white rounded-md text-teal-600 font-medium hover:text-teal-500 focus:outline-none focus:bg-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" href="#">--}}
{{--                                    View all costs--}}

{{--                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                                        <path d="m9 18 6-6-6-6" />--}}
{{--                                    </svg>--}}
{{--                                </a>--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <!-- End Top Earners -->--}}
{{--                    </div>--}}
{{--                    <!-- End Body -->--}}
{{--                </div>--}}
{{--                <!-- End Card -->--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- End Card Grid Group -->--}}

{{--        <!-- Filter Group -->--}}
{{--        <div class="mt-10 mb-4 flex flex-wrap justify-between items-center gap-3">--}}
{{--            <div>--}}
{{--                <h2 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-white">--}}
{{--                    Projects--}}
{{--                </h2>--}}
{{--            </div>--}}
{{--            <!-- End Col -->--}}

{{--            <div class="flex justify-end items-center flex-wrap gap-x-1">--}}
{{--                <!-- Select -->--}}
{{--                <div class="relative flex items-center">--}}
{{--                    <span class="me-1 text-sm text-gray-500 dark:text-neutral-500">Status:</span>--}}
{{--                    <select data-hs-select='{--}}
{{--                "placeholder": "Status",--}}
{{--                "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",--}}
{{--                "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-1 ps-1.5 pe-7 inline-flex shrink-0 justify-center items-center gap-x-1.5 border border-transparent text-sm text-gray-800 rounded-lg hover:bg-gray-100 hover:text-gray-800 focus:outline-none focus:bg-gray-100 before:absolute before:inset-0 before:z-[1] dark:text-neutral-200 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:hover:text-neutral-200 dark:focus:bg-neutral-800",--}}
{{--                "dropdownClasses": "end-0 mt-2 p-1 space-y-0.5 z-50 w-32 bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] dark:bg-neutral-950",--}}
{{--                "optionClasses": "hs-selected:bg-gray-100 dark:hs-selected:bg-neutral-800 flex gap-x-3 py-1.5 px-2 text-[13px] text-gray-800 hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800",--}}
{{--                "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-gray-800 dark:text-neutral-200\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\"><path d=\"M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z\"/></svg></span></div>"--}}
{{--              }' class="hidden">--}}
{{--                        <option value="">Choose</option>--}}
{{--                        <option selected>All</option>--}}
{{--                        <option>Active</option>--}}
{{--                        <option>Completed</option>--}}
{{--                        <option>On Hold</option>--}}
{{--                        <option>No status</option>--}}
{{--                    </select>--}}

{{--                    <div class="absolute top-1/2 end-2 -translate-y-1/2">--}}
{{--                        <svg class="shrink-0 size-3.5 text-gray-600 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                            <path d="m6 9 6 6 6-6" />--}}
{{--                        </svg>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- End Select -->--}}

{{--                <!-- Select -->--}}
{{--                <div class="relative flex items-center">--}}
{{--                    <span class="me-1 text-sm text-gray-500 dark:text-neutral-500">Sort:</span>--}}
{{--                    <select data-hs-select='{--}}
{{--                "placeholder": "Sort",--}}
{{--                "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",--}}
{{--                "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-1 ps-1.5 pe-7 inline-flex shrink-0 justify-center items-center gap-x-1.5 border border-transparent text-sm text-gray-800 rounded-lg hover:bg-gray-100 hover:text-gray-800 focus:outline-none focus:bg-gray-100 before:absolute before:inset-0 before:z-[1] dark:text-neutral-200 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:hover:text-neutral-200 dark:focus:bg-neutral-800",--}}
{{--                "dropdownClasses": "end-0 mt-2 p-1 space-y-0.5 z-50 w-28 bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] dark:bg-neutral-950",--}}
{{--                "optionClasses": "hs-selected:bg-gray-100 dark:hs-selected:bg-neutral-800 flex gap-x-3 py-1.5 px-2 text-[13px] text-gray-800 hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800",--}}
{{--                "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-gray-800 dark:text-neutral-200\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\"><path d=\"M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z\"/></svg></span></div>"--}}
{{--              }' class="hidden">--}}
{{--                        <option value="">Choose</option>--}}
{{--                        <option selected>Newest</option>--}}
{{--                        <option>Oldest</option>--}}
{{--                    </select>--}}

{{--                    <div class="absolute top-1/2 end-2 -translate-y-1/2">--}}
{{--                        <svg class="shrink-0 size-3.5 text-gray-600 dark:text-neutral-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                            <path d="m6 9 6 6 6-6" />--}}
{{--                        </svg>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- End Select -->--}}
{{--            </div>--}}
{{--            <!-- End Col -->--}}
{{--        </div>--}}
{{--        <!-- End Filter Group -->--}}

{{--        <!-- Card Grid Group -->--}}
{{--        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4">--}}
{{--            <!-- Card -->--}}
{{--            <div class="p-4 flex flex-col bg-white border border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">--}}
{{--                <div class="space-y-1">--}}
{{--                    <h4 class="mb-2.5 font-medium text-sm text-gray-800 dark:text-neutral-300">--}}
{{--                        NexaCore Ventures--}}
{{--                    </h4>--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Total hours:--}}
{{--              </span>--}}
{{--                        <span class="text-sm font-medium text-gray-800 dark:text-white">--}}
{{--                6h 30m--}}
{{--              </span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Days:--}}
{{--              </span>--}}
{{--                        <span class="text-sm font-medium text-gray-800 dark:text-white">--}}
{{--                3--}}
{{--              </span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Status:--}}
{{--              </span>--}}

{{--                        <span class="inline-flex items-center gap-x-1.5 py-0.5 px-1.5 rounded-md text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500">Completed</span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- End Card -->--}}

{{--            <!-- Card -->--}}
{{--            <div class="p-4 flex flex-col bg-white border border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">--}}
{{--                <div class="space-y-1">--}}
{{--                    <h4 class="mb-2.5 font-medium text-sm text-gray-800 dark:text-neutral-300">--}}
{{--                        BlueVista Innovations--}}
{{--                    </h4>--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Total hours:--}}
{{--              </span>--}}
{{--                        <span class="text-sm font-medium text-gray-800 dark:text-white">--}}
{{--                ---}}
{{--              </span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Days:--}}
{{--              </span>--}}
{{--                        <span class="text-sm font-medium text-gray-800 dark:text-white">--}}
{{--                ---}}
{{--              </span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Status:--}}
{{--              </span>--}}

{{--                        <span class="inline-flex items-center gap-x-1.5 py-0.5 px-1.5 rounded-md text-xs font-medium bg-gray-100 text-gray-800 dark:bg-neutral-800/30 dark:text-neutral-500">No status</span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- End Card -->--}}

{{--            <!-- Card -->--}}
{{--            <div class="p-4 flex flex-col bg-white border border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">--}}
{{--                <div class="space-y-1">--}}
{{--                    <h4 class="mb-2.5 font-medium text-sm text-gray-800 dark:text-neutral-300">--}}
{{--                        Quantum Sphere--}}
{{--                    </h4>--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Total hours:--}}
{{--              </span>--}}
{{--                        <span class="text-sm font-medium text-gray-800 dark:text-white">--}}
{{--                8h 26m--}}
{{--              </span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Days:--}}
{{--              </span>--}}
{{--                        <span class="text-sm font-medium text-gray-800 dark:text-white">--}}
{{--                7--}}
{{--              </span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Status:--}}
{{--              </span>--}}

{{--                        <span class="inline-flex items-center gap-x-1.5 py-0.5 px-1.5 rounded-md text-xs font-medium bg-sky-100 text-sky-800 dark:bg-sky-800/30 dark:text-sky-500">Active</span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- End Card -->--}}

{{--            <!-- Card -->--}}
{{--            <div class="p-4 flex flex-col bg-white border border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">--}}
{{--                <div class="space-y-1">--}}
{{--                    <h4 class="mb-2.5 font-medium text-sm text-gray-800 dark:text-neutral-300">--}}
{{--                        Lumen Systems--}}
{{--                    </h4>--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Total hours:--}}
{{--              </span>--}}
{{--                        <span class="text-sm font-medium text-gray-800 dark:text-white">--}}
{{--                55m--}}
{{--              </span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Days:--}}
{{--              </span>--}}
{{--                        <span class="text-sm font-medium text-gray-800 dark:text-white">--}}
{{--                2--}}
{{--              </span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Status:--}}
{{--              </span>--}}

{{--                        <span class="inline-flex items-center gap-x-1.5 py-0.5 px-1.5 rounded-md text-xs font-medium bg-sky-100 text-sky-800 dark:bg-sky-800/30 dark:text-sky-500">Active</span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- End Card -->--}}

{{--            <!-- Card -->--}}
{{--            <div class="p-4 flex flex-col bg-white border border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">--}}
{{--                <div class="space-y-1">--}}
{{--                    <h4 class="mb-2.5 font-medium text-sm text-gray-800 dark:text-neutral-300">--}}
{{--                        StratoSync Enterprises--}}
{{--                    </h4>--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Total hours:--}}
{{--              </span>--}}
{{--                        <span class="text-sm font-medium text-gray-800 dark:text-white">--}}
{{--                9h 12m--}}
{{--              </span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Days:--}}
{{--              </span>--}}
{{--                        <span class="text-sm font-medium text-gray-800 dark:text-white">--}}
{{--                5--}}
{{--              </span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Status:--}}
{{--              </span>--}}

{{--                        <span class="inline-flex items-center gap-x-1.5 py-0.5 px-1.5 rounded-md text-xs font-medium bg-sky-100 text-sky-800 dark:bg-sky-800/30 dark:text-sky-500">Active</span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- End Card -->--}}

{{--            <!-- Card -->--}}
{{--            <div class="p-4 flex flex-col bg-white border border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">--}}
{{--                <div class="space-y-1">--}}
{{--                    <h4 class="mb-2.5 font-medium text-sm text-gray-800 dark:text-neutral-300">--}}
{{--                        TerraNova Dynamics--}}
{{--                    </h4>--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Total hours:--}}
{{--              </span>--}}
{{--                        <span class="text-sm font-medium text-gray-800 dark:text-white">--}}
{{--                25h 11m--}}
{{--              </span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Days:--}}
{{--              </span>--}}
{{--                        <span class="text-sm font-medium text-gray-800 dark:text-white">--}}
{{--                9--}}
{{--              </span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Status:--}}
{{--              </span>--}}

{{--                        <span class="inline-flex items-center gap-x-1.5 py-0.5 px-1.5 rounded-md text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500">Completed</span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- End Card -->--}}

{{--            <!-- Card -->--}}
{{--            <div class="p-4 flex flex-col bg-white border border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">--}}
{{--                <div class="space-y-1">--}}
{{--                    <h4 class="mb-2.5 font-medium text-sm text-gray-800 dark:text-neutral-300">--}}
{{--                        EchoFlow Technologies--}}
{{--                    </h4>--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Total hours:--}}
{{--              </span>--}}
{{--                        <span class="text-sm font-medium text-gray-800 dark:text-white">--}}
{{--                26m--}}
{{--              </span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Days:--}}
{{--              </span>--}}
{{--                        <span class="text-sm font-medium text-gray-800 dark:text-white">--}}
{{--                1--}}
{{--              </span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}

{{--                    <!-- Item -->--}}
{{--                    <div class="flex justify-between items-center gap-x-2">--}}
{{--              <span class="text-xs text-gray-600 dark:text-neutral-400">--}}
{{--                Status:--}}
{{--              </span>--}}

{{--                        <span class="inline-flex items-center gap-x-1.5 py-0.5 px-1.5 rounded-md text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-800/30 dark:text-yellow-500">On hold</span>--}}
{{--                    </div>--}}
{{--                    <!-- End Item -->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- End Card -->--}}
{{--        </div>--}}
{{--        <!-- End Card Grid Group -->--}}
{{--    </div>--}}
    <!-- End Content -->
</div>
