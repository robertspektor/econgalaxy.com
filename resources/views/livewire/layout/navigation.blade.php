<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

    <!-- ========== MAIN SIDEBAR ========== -->
<aside id="hs-pro-sidebar" class="hs-overlay [--auto-close:lg]
                hs-overlay-open:translate-x-0
                -translate-x-full transition-all duration-300 transform
{{--                w-[20.5rem]--}}
                h-full
                hidden
                fixed inset-y-0 start-0 z-[60]
                bg-white
                lg:block lg:translate-x-0 lg:end-auto lg:bottom-0
                dark:bg-neutral-800" tabindex="-1" aria-label="Sidebar">

    <div class="h-full flex">
        <!-- Nav Sidebar -->
        <div class="w-16 flex flex-col h-full max-h-full">
            <div class="p-4 flex flex-col items-center">
                <!-- Logo -->
                <a class="flex-none rounded-md text-xl inline-block font-semibold focus:outline-none focus:opacity-80" href="../../pro/analytics/index.html" aria-label="Preline">

                    <svg class="w-7 h-auto fill-neutral-300" fill="currentColor" width="36" height="36" viewBox="0 0 170 170" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" clip-rule="evenodd">
                                    <path fill-opacity=".25" d="M17.576 72.414C23.291 40.646 51.1 16.507 84.5 16.507c33.4 0 61.228 24.14 66.923 55.907-12.383-19.518-37.707-32.909-66.923-32.909-29.217 0-54.54 13.39-66.923 32.909Z" class="fill-indigo-600 dark:fill-indigo-500"/>
                        <path d="M84.503.006C37.868.006-.002 37.877-.002 84.512s37.87 84.506 84.505 84.506 84.506-37.871 84.506-84.506S131.138.006 84.503.006Zm0 7.012c42.77 0 77.495 34.723 77.495 77.494 0 42.77-34.724 77.495-77.495 77.495-42.77 0-77.494-34.724-77.494-77.495 0-42.77 34.724-77.494 77.494-77.494Z"/>
                        <path d="M84.496 159.508Z"/>
                        <path d="M9.497 84.508Z"/>
                        <path d="M43.79 138.96c11.617-1.558 25.635-2.454 40.709-2.454 15.074 0 29.092.896 40.708 2.453A67.652 67.652 0 0 1 84.5 152.505 67.652 67.652 0 0 1 43.79 138.96Z"/>
                        <path d="M25.797 118.814a59.448 59.448 0 0 1 1.532-.876c12.9-7.031 33.73-11.432 57.17-11.432 23.44 0 44.29 4.4 57.17 11.432.538.288 1.035.58 1.532.876a68.01 68.01 0 0 1-10.974 14.122c-12.983-2.143-29.61-3.429-47.728-3.429-18.118 0-34.745 1.286-47.707 3.429a67.413 67.413 0 0 1-10.995-14.122Z"/>
                        <path fill-opacity=".75" d="M19.316 103.904c2.07-3.82 5.197-7.36 9.09-10.55 12.651-10.34 33.109-16.849 56.093-16.849s43.442 6.508 56.093 16.849c3.893 3.19 7.02 6.73 9.09 10.55a66.1 66.1 0 0 1-3.25 8.688c-13.501-7.9-36.216-13.086-61.933-13.086s-48.411 5.187-61.932 13.086a66.21 66.21 0 0 1-3.251-8.688Z"/>
                        <path fill-opacity=".5" d="M17.017 92.905C21.18 66.409 50.147 46.506 84.5 46.506s63.32 19.903 67.482 46.399a44.835 44.835 0 0 1-.228 1.679c-12.258-14.857-37.789-25.078-67.254-25.078-29.465 0-54.996 10.221-67.254 25.078-.083-.56-.166-1.118-.228-1.68Z" class="fill-indigo-600 dark:fill-indigo-500"/>
                                </svg>

                </a>
                <!-- End Logo -->
            </div>

            <!-- Content -->
            <div class="h-full px-4 overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
                <!-- Nav -->
                <ul class="flex flex-col items-center space-y-1">
                    <!-- Item -->
                    <li class="hs-tooltip [--placement:right] inline-block">
                        <x-responsive-nav-link :href="route('os')" :active="request()->routeIs('os')" wire:navigate>
                            <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                <polyline points="9 22 9 12 15 12 15 22" />
                            </svg>
                            <span class="sr-only">Nebula OS</span>
                        </x-responsive-nav-link>
                    </li>
                    <!-- End Item -->

                    <!-- Item -->
                    <li class="hs-tooltip [--placement:right] inline-block">
{{--                        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('markets')" wire:navigate>--}}
{{--                            <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                                <path d="M12 16v5"/><path d="M16 14v7"/><path d="M20 10v11"/><path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15"/><path d="M4 18v3"/><path d="M8 14v7"/>--}}
{{--                            </svg>--}}
{{--                            <span class="sr-only">Markets</span>--}}
{{--                        </x-responsive-nav-link>--}}
                    </li>
                    <!-- End Item -->

                    <!-- Item -->
                    <li class="hs-tooltip [--placement:right] inline-block">
                        <a class="hs-tooltip-toggle flex justify-center items-center gap-x-3 size-10 text-sm text-gray-800 rounded-lg hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                            <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 9 5 12 1.8-5.2L21 14Z" />
                                <path d="M7.2 2.2 8 5.1" />
                                <path d="m5.1 8-2.9-.8" />
                                <path d="M14 4.1 12 6" />
                                <path d="m6 12-1.9 2" />
                            </svg>
                            <span class="sr-only">Events</span>
                        </a>
                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-20 py-1.5 px-2.5 bg-gray-900 text-xs text-white rounded-lg whitespace-nowrap dark:bg-neutral-700" role="tooltip">
                Events
              </span>
                    </li>
                    <!-- End Item -->

                    <!-- Item -->
                    <li class="hs-tooltip [--placement:right] inline-block">
                        <a class="hs-tooltip-toggle flex justify-center items-center gap-x-3 size-10 text-sm text-gray-800 rounded-lg hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                            <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 18a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2" />
                                <rect width="18" height="18" x="3" y="4" rx="2" />
                                <circle cx="12" cy="10" r="2" />
                                <line x1="8" x2="8" y1="2" y2="4" />
                                <line x1="16" x2="16" y1="2" y2="4" />
                            </svg>
                            <span class="sr-only">Attributes</span>
                        </a>
                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-20 py-1.5 px-2.5 bg-gray-900 text-xs text-white rounded-lg whitespace-nowrap dark:bg-neutral-700" role="tooltip">
                Attributes
              </span>
                    </li>
                    <!-- End Item -->

                    <!-- Item -->
                    <li class="hs-tooltip [--placement:right] inline-block">
                        <a class="hs-tooltip-toggle flex justify-center items-center gap-x-3 size-10 text-sm text-gray-800 rounded-lg hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                            <svg class="shrink-0 mt-0.5 size-4 text-indigo-600 dark:text-indigo-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <path d="m16 12-4-4-4 4" />
                                <path d="M12 16V8" />
                            </svg>
                            <span class="sr-only">Upgrade</span>
                        </a>
                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-20 py-1.5 px-2.5 bg-gray-900 text-xs text-white rounded-lg whitespace-nowrap dark:bg-neutral-700" role="tooltip">
                Upgrade
              </span>
                    </li>
                    <!-- End Item -->

                    <!-- Item -->
                    <li class="hs-tooltip [--placement:right] inline-block">
                        <a class="hs-tooltip-toggle flex justify-center items-center gap-x-3 size-10 text-sm text-gray-800 rounded-lg hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                            <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22v-5" />
                                <path d="M9 8V2" />
                                <path d="M15 8V2" />
                                <path d="M18 8v5a4 4 0 0 1-4 4h-4a4 4 0 0 1-4-4V8Z" />
                            </svg>
                            <span class="sr-only">Integrations</span>
                        </a>
                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 inline-block absolute invisible z-20 py-1.5 px-2.5 bg-gray-900 text-xs text-white rounded-lg whitespace-nowrap dark:bg-neutral-700" role="tooltip">
                Integrations
              </span>
                    </li>
                    <!-- End Item -->
                </ul>
                <!-- End Nav -->
            </div>
            <!-- End Content -->

            <footer class="hidden lg:block text-center border-t border-gray-200 dark:border-neutral-700">
                <!-- Account Dropdown -->
                <div class="hs-dropdown  inline-flex  [--strategy:absolute] [--auto-close:inside] [--placement:bottom-right] relative text-start">
                    <button id="hs-pro-dsad" type="button" class="w-full flex items-center gap-x-3 text-start py-4 disabled:opacity-50 disabled:pointer-events-none focus:outline-none" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        <img class="shrink-0 size-[38px] rounded-full" src="https://images.unsplash.com/photo-1659482633369-9fe69af50bfb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=3&w=320&h=320&q=80" alt="Avatar">
                    </button>

                    <!-- Account Dropdown -->
                    <div class="hs-dropdown-menu hs-dropdown-open:opacity-100 w-60 transition-[opacity,margin] duration opacity-0 hidden z-20 bg-white rounded-xl shadow-[0_10px_40px_10px_rgba(0,0,0,0.08)] dark:shadow-[0_10px_40px_10px_rgba(0,0,0,0.2)] dark:bg-neutral-900" role="menu" aria-orientation="vertical" aria-labelledby="hs-pro-dsad">
                        <div class="p-1 border-b border-gray-200 dark:border-neutral-800">
                            <a class="py-2 px-3 flex items-center gap-x-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="../../pro/dashboard/user-profile-my-profile.html">
                                <img class="shrink-0 size-8 rounded-full" src="https://images.unsplash.com/photo-1659482633369-9fe69af50bfb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=3&w=320&h=320&q=80" alt="Avatar">

                                <div class="grow">
                    <span class="text-sm font-semibold text-gray-800 dark:text-neutral-300">
                      James Collison
                    </span>
                                    <p class="text-xs text-gray-500 dark:text-neutral-500">
                                        Preline@HS
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="p-1">
                            <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#">
                                <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="20" height="14" x="2" y="5" rx="2" />
                                    <line x1="2" x2="22" y1="10" y2="10" />
                                </svg>
                                Billing
                            </a>
                            <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                Settings
                            </a>
                            <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#">
                                <svg class="shrink-0 mt-0.5 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>
                                My account
                            </a>
                        </div>
                        <div class="px-4 py-3.5 border-y border-gray-200 dark:border-neutral-800">
                            <!-- Switch/Toggle -->
                            <div class="flex justify-between items-center">
                                <label for="hs-pro-dsaddm" class="text-sm text-gray-800 dark:text-neutral-300">Dark mode</label>
                                <div class="relative inline-block">
                                    <input data-hs-theme-switch type="checkbox" id="hs-pro-dsaddm" class="relative w-11 h-6 p-px bg-gray-100 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-neutral-900

                    before:inline-block before:size-5 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-white">
                                </div>
                            </div>
                            <!-- End Switch/Toggle -->
                        </div>
                        <div class="p-1">
                            <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#">
                                Customization
                                <div class="ms-auto">
                    <span class="ms-auto inline-flex items-center gap-1.5 py-px px-1.5 rounded text-[10px] leading-4 font-medium bg-gray-100 text-gray-800 dark:bg-neutral-700 dark:text-neutral-300">
                      New
                    </span>
                                </div>
                            </a>
                            <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#">
                                Manage team
                            </a>
                            <a class="flex items-center gap-x-3 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" href="#">
                                Sign out
                            </a>
                        </div>
                        <div class="p-1 border-t border-gray-200 dark:border-neutral-800">
                            <button type="button" class="flex mt-0.5 gap-x-3 py-2 px-3 w-full rounded-lg text-sm text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" data-hs-overlay="#hs-pro-dasadam">
                                <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M8 12h8" />
                                    <path d="M12 8v8" />
                                </svg>
                                Add team account
                            </button>
                        </div>
                    </div>
                    <!-- End Account Dropdown -->
                </div>
                <!-- End Account Dropdown -->
            </footer>

            <!-- Sidebar Close -->
            <div class="lg:hidden absolute top-4 -end-6 z-10">
                <button type="button" class="w-6 h-7 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-e-md border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-pro-sidebar">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="7 8 3 12 7 16" />
                        <line x1="21" x2="11" y1="12" y2="12" />
                        <line x1="21" x2="11" y1="6" y2="6" />
                        <line x1="21" x2="11" y1="18" y2="18" />
                    </svg>
                </button>
            </div>
            <!-- End Sidebar Close -->
        </div>
        <!-- End Nav Sidebar -->

    </div>
</aside>
<!-- ========== END MAIN SIDEBAR ========== -->

{{--<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">--}}
{{--    <!-- Primary Navigation Menu -->--}}
{{--    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">--}}
{{--        <div class="flex justify-between h-16">--}}
{{--            <div class="flex">--}}
{{--                <!-- Logo -->--}}
{{--                <div class="shrink-0 flex items-center">--}}
{{--                    <a href="{{ route('dashboard') }}" wire:navigate>--}}
{{--                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />--}}
{{--                    </a>--}}
{{--                </div>--}}

{{--                <!-- Navigation Links -->--}}
{{--                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">--}}
{{--                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>--}}
{{--                        {{ __('Dashboard') }}--}}
{{--                    </x-nav-link>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- Settings Dropdown -->--}}
{{--            <div class="hidden sm:flex sm:items-center sm:ms-6">--}}
{{--                <x-dropdown align="right" width="48">--}}
{{--                    <x-slot name="trigger">--}}
{{--                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">--}}
{{--                            <div x-data="{{ json_encode(['name' => auth()->user()->username]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>--}}

{{--                            <div class="ms-1">--}}
{{--                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">--}}
{{--                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </button>--}}
{{--                    </x-slot>--}}

{{--                    <x-slot name="content">--}}
{{--                        <x-dropdown-link :href="route('profile')" wire:navigate>--}}
{{--                            {{ __('Profile') }}--}}
{{--                        </x-dropdown-link>--}}

{{--                        <!-- Authentication -->--}}
{{--                        <button wire:click="logout" class="w-full text-start">--}}
{{--                            <x-dropdown-link>--}}
{{--                                {{ __('Log Out') }}--}}
{{--                            </x-dropdown-link>--}}
{{--                        </button>--}}
{{--                    </x-slot>--}}
{{--                </x-dropdown>--}}
{{--            </div>--}}

{{--            <!-- Hamburger -->--}}
{{--            <div class="-me-2 flex items-center sm:hidden">--}}
{{--                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">--}}
{{--                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">--}}
{{--                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />--}}
{{--                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />--}}
{{--                    </svg>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <!-- Responsive Navigation Menu -->--}}
{{--    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">--}}
{{--        <div class="pt-2 pb-3 space-y-1">--}}
{{--            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>--}}
{{--                {{ __('Dashboard') }}--}}
{{--            </x-responsive-nav-link>--}}
{{--        </div>--}}

{{--        <!-- Responsive Settings Options -->--}}
{{--        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">--}}
{{--            <div class="px-4">--}}
{{--                <div class="font-medium text-base text-gray-800 dark:text-gray-200" x-data="{{ json_encode(['name' => auth()->user()->username ]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>--}}
{{--                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>--}}
{{--            </div>--}}

{{--            <div class="mt-3 space-y-1">--}}
{{--                <x-responsive-nav-link :href="route('profile')" wire:navigate>--}}
{{--                    {{ __('Profile') }}--}}
{{--                </x-responsive-nav-link>--}}

{{--                <!-- Authentication -->--}}
{{--                <button wire:click="logout" class="w-full text-start">--}}
{{--                    <x-responsive-nav-link>--}}
{{--                        {{ __('Log Out') }}--}}
{{--                    </x-responsive-nav-link>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}
