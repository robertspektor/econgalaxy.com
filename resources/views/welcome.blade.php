<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        <div class="flex flex-col min-h-screen overflow-hidden font-inter antialiased bg-dark text-slate-100 tracking-tight">

            <!-- Site header -->
            <header class="absolute w-full z-30 sm:fixed sm:top-0 sm:right-0">
                <div class="max-w-6xl mx-auto px-4 sm:px-6">
                    <div class="flex items-center justify-between h-16 md:h-20 ">

                        <!-- Site branding -->
                        <div class="shrink-0 mr-4">
                            <!-- Logo -->
                            <a class="block" href="/" aria-label="Cruip">
                                <div class="flex">
                                    <img src="/images/logo.svg" width="38" height="38" alt="ECON Galaxy">
                                    <span class="mt-1 ml-2 font-bold text-xl">ECON Galaxy</span>
                                </div>
                            </a>
                        </div>

                        @if (Route::has('login'))
                            <livewire:welcome.navigation />
                        @endif
                    </div>
                </div>
            </header>

            <!-- Page content -->
            <main class="grow">

                <!-- Hero -->
                <section class="bg-[url('/public/images/hero.jpeg')] bg-cover bg-center ">
                    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 ">
                        <div class="pt-32 pb-16 md:pt-32 md:pb-52">

                            <!-- Hero content -->
                            <div class="max-w-3xl mx-auto text-center">
                                <h1 class="text-5xl uppercase whitespace-nowrap font-bold bg-clip-text text-transparent bg-gradient-to-r from-slate-100/60 via-slate-100 to-slate-200/60 pb-4" data-aos="fade-down">
                                    Build Your Galactic Empire!
                                </h1>
                                <p class="text-2xl text-slate-300 mb-8" data-aos="fade-down" data-aos-delay="200">
                                    Shape the economy, command alliances, and dominate the stars in a player-driven universe.
                                </p>
                                <a href="{{ route('register') }}" class="btn text-slate-100 font-bold bg-primary hover:bg-purple-800 hover:shadow-xl hover:shadow-purple-500/50 w-full max-w-xs mx-auto rounded-lg p-4" data-aos="fade-down" data-aos-delay="400">
                                    Start Building Your Empire Today!
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Features -->
                <section class="bg-gradient-to-b from-darkPrimary to-transparent to-80%">
                    <div class="relative max-w-6xl mx-auto px-4 py-20 sm:px-6">

                        <!-- Features list -->
                        <div class="grid md:grid-cols-3 gap-8 md:gap-12">
                            <!-- Feature -->
                            <div>
                                <div class="flex items-center space-x-2 mb-2">
                                    <svg class="size-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5v4"/><rect width="4" height="6" x="7" y="9" rx="1"/><path d="M9 15v2"/><path d="M17 3v2"/><rect width="4" height="8" x="15" y="5" rx="1"/><path d="M17 13v3"/><path d="M3 3v16a2 2 0 0 0 2 2h16"/></svg>
                                    <h4 class="text-xl font-bold text-textLight">Player-Driven Galactic Economy</h4>
                                </div>
                                <p class="text-xl text-slate-400">
                                    Thrive in a player-controlled galaxy, maximizing profits through resource extraction, optimized trade routes, and a vast interstellar financial empire.
                                </p>
                            </div>
                            <!-- Feature -->
                            <div>
                                <div class="flex items-center space-x-2 mb-1">
                                    <svg class="shrink-0 fill-slate-300" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                        <path d="M11 0c1.3 0 2.6.5 3.5 1.5 1 .9 1.5 2.2 1.5 3.5 0 1.3-.5 2.6-1.4 3.5l-1.2 1.2c-.2.2-.5.3-.7.3-.2 0-.5-.1-.7-.3-.4-.4-.4-1 0-1.4l1.1-1.2c.6-.5.9-1.3.9-2.1s-.3-1.6-.9-2.2C12 1.7 10 1.7 8.9 2.8L7.7 4c-.4.4-1 .4-1.4 0-.4-.4-.4-1 0-1.4l1.2-1.1C8.4.5 9.7 0 11 0ZM8.3 12c.4-.4 1-.5 1.4-.1.4.4.4 1 0 1.4l-1.2 1.2C7.6 15.5 6.3 16 5 16c-1.3 0-2.6-.5-3.5-1.5C.5 13.6 0 12.3 0 11c0-1.3.5-2.6 1.5-3.5l1.1-1.2c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4L2.9 8.9c-.6.5-.9 1.3-.9 2.1s.3 1.6.9 2.2c1.1 1.1 3.1 1.1 4.2 0L8.3 12Zm1.1-6.8c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4l-4.2 4.2c-.2.2-.5.3-.7.3-.2 0-.5-.1-.7-.3-.4-.4-.4-1 0-1.4l4.2-4.2Z" />
                                    </svg>
                                    <h4 class="font-medium text-slate-50">Complex Goods & Production Chains</h4>
                                </div>
                                <p class="text-sm text-slate-400">
                                    Master intricate production chains and manage a sophisticated market of goods. From raw materials to high-tech products, every step in the process matters.
                                </p>
                            </div>
                            <!-- Feature -->
                            <div>
                                <div class="flex items-center space-x-2 mb-1">
                                    <svg class="shrink-0 fill-slate-300" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                        <path d="M14 0a2 2 0 0 1 2 2v4a1 1 0 0 1-2 0V2H2v12h4a1 1 0 0 1 0 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12Zm-1.957 10.629 3.664 3.664a1 1 0 0 1-1.414 1.414l-3.664-3.664-.644 2.578a.5.5 0 0 1-.476.379H9.5a.5.5 0 0 1-.48-.362l-2-7a.5.5 0 0 1 .618-.618l7 2a.5.5 0 0 1-.017.965l-2.578.644Z" />
                                    </svg>
                                    <h4 class="font-medium text-slate-50">Dynamic AI Civilizations</h4>

                                </div>
                                <p class="text-sm text-slate-400">
                                    Observe AI-controlled civilizations forming alliances, trading, and waging wars across the galaxy, while leveraging your economic power to influence the balance of power.
                                </p>
                            </div>
                            <!-- Feature -->
                            <div>
                                <div class="flex items-center space-x-2 mb-1">
                                    <svg class="shrink-0 fill-slate-300" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                        <path d="M14.3.3c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4l-8 8c-.2.2-.4.3-.7.3-.3 0-.5-.1-.7-.3-.4-.4-.4-1 0-1.4l8-8ZM15 7c.6 0 1 .4 1 1 0 4.4-3.6 8-8 8s-8-3.6-8-8 3.6-8 8-8c.6 0 1 .4 1 1s-.4 1-1 1C4.7 2 2 4.7 2 8s2.7 6 6 6 6-2.7 6-6c0-.6.4-1 1-1Z" />
                                    </svg>
                                    <h4 class="font-medium text-slate-50">Limitless Exploration</h4>

                                </div>
                                <p class="text-sm text-slate-400">
                                    Venture into the unknown reaches of space, discover new planets, resources, and opportunities to expand your influence across the galaxy.
                                </p>
                            </div>
                            <!-- Feature -->
                            <div>
                                <div class="flex items-center space-x-2 mb-1">
                                    <svg class="shrink-0 fill-slate-300" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                        <path d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12Zm0 14V2H2v12h12Zm-3-7H5a1 1 0 1 1 0-2h6a1 1 0 0 1 0 2Zm0 4H5a1 1 0 0 1 0-2h6a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    <h4 class="font-medium text-slate-50">Real-Time Economy Simulation</h4>

                                </div>
                                <p class="text-sm text-slate-400">
                                    Stay ahead in an ever-evolving economy, respond to shifts in supply and demand, and continually adapt your strategy to outmaneuver the competition.
                                </p>
                            </div>
                            <!-- Feature -->
                            <div>
                                <div class="flex items-center space-x-2 mb-1">
                                    <svg class="shrink-0 fill-slate-300" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                        <path d="M14.574 5.67a13.292 13.292 0 0 1 1.298 1.842 1 1 0 0 1 0 .98C15.743 8.716 12.706 14 8 14a6.391 6.391 0 0 1-1.557-.2l1.815-1.815C10.97 11.82 13.06 9.13 13.82 8c-.163-.243-.39-.56-.669-.907l1.424-1.424ZM.294 15.706a.999.999 0 0 1-.002-1.413l2.53-2.529C1.171 10.291.197 8.615.127 8.49a.998.998 0 0 1-.002-.975C.251 7.29 3.246 2 8 2c1.331 0 2.515.431 3.548 1.038L14.293.293a.999.999 0 1 1 1.414 1.414l-14 14a.997.997 0 0 1-1.414 0ZM2.18 8a12.603 12.603 0 0 0 2.06 2.347l1.833-1.834A1.925 1.925 0 0 1 6 8a2 2 0 0 1 2-2c.178 0 .348.03.512.074l1.566-1.566C9.438 4.201 8.742 4 8 4 5.146 4 2.958 6.835 2.181 8Z" />
                                    </svg>
                                    <h4 class="font-medium text-slate-50">Strategic Decision-Making with Long-Term Impact</h4>

                                </div>
                                <p class="text-sm text-slate-400">
                                    Make high-stakes decisions, form alliances, and adapt to the challenges of a dynamic galaxy – every choice has lasting consequences in your journey to dominance.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Features #2 -->
                <section class="relative">

                    <div class="max-w-6xl mx-auto px-4 sm:px-6">
                        <div class="pt-16 md:pt-32">

                            <!-- Highlighted boxes -->
                            <div class="relative pb-12 md:pb-20">
                                <!-- Blurred shape -->
                                <div class="absolute bottom-0 -mb-20 left-1/2 -translate-x-1/2 blur-2xl opacity-50 pointer-events-none" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="434" height="427">
                                        <defs>
                                            <linearGradient id="bs2-a" x1="19.609%" x2="50%" y1="14.544%" y2="100%">
                                                <stop offset="0%" stop-color="#6366F1" />
                                                <stop offset="100%" stop-color="#6366F1" stop-opacity="0" />
                                            </linearGradient>
                                        </defs>
                                        <path fill="url(#bs2-a)" fill-rule="evenodd" d="m346 898 461 369-284 58z" transform="translate(-346 -898)" />
                                    </svg>
                                </div>
                                <!-- Grid -->
                                <div class="grid md:grid-cols-12 gap-6 group" data-highlighter>
                                    <!-- Box #1 -->
                                    <div class="md:col-span-12" data-aos="fade-down">
                                        <div class="relative bg-slate-800 rounded-3xl p-px before:absolute before:w-96 before:h-96 before:-left-48 before:-top-48 before:bg-purple-500 before:rounded-full before:opacity-0 before:pointer-events-none before:transition-opacity before:duration-500 before:translate-x-[var(--mouse-x)] before:translate-y-[var(--mouse-y)] before:hover:opacity-20 before:z-30 before:blur-[100px] after:absolute after:inset-0 after:rounded-[inherit] after:opacity-0 after:transition-opacity after:duration-500 after:[background:_radial-gradient(250px_circle_at_var(--mouse-x)_var(--mouse-y),theme(colors.slate.400),transparent)] after:group-hover:opacity-100 after:z-10 overflow-hidden">
                                            <div class="relative h-full bg-slate-900 rounded-[inherit] z-20 overflow-hidden">
                                                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                                    <!-- Blurred shape -->
                                                    <div class="absolute right-0 top-0 blur-2xl" aria-hidden="true">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="342" height="393">
                                                            <defs>
                                                                <linearGradient id="bs-a" x1="19.609%" x2="50%" y1="14.544%" y2="100%">
                                                                    <stop offset="0%" stop-color="#6366F1" />
                                                                    <stop offset="100%" stop-color="#6366F1" stop-opacity="0" />
                                                                </linearGradient>
                                                            </defs>
                                                            <path fill="url(#bs-a)" fill-rule="evenodd" d="m104 .827 461 369-284 58z" transform="translate(0 -112.827)" opacity=".7" />
                                                        </svg>
                                                    </div>
                                                    <!-- Radial gradient -->
                                                    <div class="absolute flex items-center justify-center bottom-0 translate-y-1/2 left-1/2 -translate-x-1/2 pointer-events-none -z-10 h-full aspect-square" aria-hidden="true">
                                                        <div class="absolute inset-0 translate-z-0 bg-purple-500 rounded-full blur-[120px] opacity-70"></div>
                                                        <div class="absolute w-1/4 h-1/4 translate-z-0 bg-purple-400 rounded-full blur-[40px]"></div>
                                                    </div>


                                                    <!-- Text -->
                                                    <div class="md:max-w-[480px] shrink-0 order-1 md:order-none p-6 pt-0 md:p-8 md:pr-0">
                                                        <div class="mb-5">
                                                            <div>
                                                                <h3 class="inline-flex text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-slate-200/60 via-slate-200 to-slate-200/60 pb-1">Build Your Galactic Empire</h3>
                                                                <p class="text-slate-400">Start from scratch and build your own intergalactic empire, expand your territory, and become the ultimate ruler of the galaxy.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Image -->
                                                    <div class="relative w-full h-64 md:h-auto overflow-hidden">
                                                        <img class="absolute bottom-0 left-1/2 -translate-x-1/2 mx-auto max-w-none md:relative md:left-0 md:translate-x-0" src="/images/feature-image-01.png" width="504" height="400" alt="Feature 01">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Box #2 -->
                                    <div class="md:col-span-7" data-aos="fade-down">
                                        <div class="relative bg-slate-800 rounded-3xl p-px before:absolute before:w-96 before:h-96 before:-left-48 before:-top-48 before:bg-purple-500 before:rounded-full before:opacity-0 before:pointer-events-none before:transition-opacity before:duration-500 before:translate-x-[var(--mouse-x)] before:translate-y-[var(--mouse-y)] before:hover:opacity-20 before:z-30 before:blur-[100px] after:absolute after:inset-0 after:rounded-[inherit] after:opacity-0 after:transition-opacity after:duration-500 after:[background:_radial-gradient(250px_circle_at_var(--mouse-x)_var(--mouse-y),theme(colors.slate.400),transparent)] after:group-hover:opacity-100 after:z-10 overflow-hidden">
                                            <div class="relative h-full bg-slate-900 rounded-[inherit] z-20 overflow-hidden">
                                                <div class="flex flex-col">
                                                    <!-- Radial gradient -->
                                                    <div class="absolute bottom-0 translate-y-1/2 left-1/2 -translate-x-1/2 pointer-events-none -z-10 w-1/2 aspect-square" aria-hidden="true">
                                                        <div class="absolute inset-0 translate-z-0 bg-slate-800 rounded-full blur-[80px]"></div>
                                                    </div>
                                                    <!-- Text -->
                                                    <div class="md:max-w-[480px] shrink-0 order-1 md:order-none p-6 pt-0 md:p-8 md:pr-0">
                                                        <div>
                                                            <h3 class="inline-flex text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-slate-200/60 via-slate-200 to-slate-200/60 pb-1">Control the Future of Your Corporation</h3>
                                                            <p class="text-slate-400">Take the reins of your corporation, make tough decisions, and watch as your choices shape the future of your company.</p>
                                                        </div>
                                                    </div>
                                                    <!-- Image -->
                                                    <div class="relative w-full h-64 md:h-auto overflow-hidden md:pb-8">
                                                        <img class="absolute bottom-0 left-1/2 -translate-x-1/2 mx-auto max-w-none md:max-w-full md:relative md:left-0 md:translate-x-0" src="/images/feature-image-02.png" width="536" height="230" alt="Feature 02">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Box #3 -->
                                    <div class="md:col-span-5" data-aos="fade-down">
                                        <div class="relative bg-slate-800 rounded-3xl p-px before:absolute before:w-96 before:h-96 before:-left-48 before:-top-48 before:bg-purple-500 before:rounded-full before:opacity-0 before:pointer-events-none before:transition-opacity before:duration-500 before:translate-x-[var(--mouse-x)] before:translate-y-[var(--mouse-y)] before:hover:opacity-20 before:z-30 before:blur-[100px] after:absolute after:inset-0 after:rounded-[inherit] after:opacity-0 after:transition-opacity after:duration-500 after:[background:_radial-gradient(250px_circle_at_var(--mouse-x)_var(--mouse-y),theme(colors.slate.400),transparent)] after:group-hover:opacity-100 after:z-10 overflow-hidden">
                                            <div class="relative h-full bg-slate-900 rounded-[inherit] z-20 overflow-hidden">
                                                <div class="flex flex-col">
                                                    <!-- Radial gradient -->
                                                    <div class="absolute bottom-0 translate-y-1/2 left-1/2 -translate-x-1/2 pointer-events-none -z-10 w-1/2 aspect-square" aria-hidden="true">
                                                        <div class="absolute inset-0 translate-z-0 bg-slate-800 rounded-full blur-[80px]"></div>
                                                    </div>
                                                    <!-- Text -->
                                                    <div class="md:max-w-[480px] shrink-0 order-1 md:order-none p-6 pt-0 md:p-8 md:pr-0">
                                                        <div>
                                                            <h3 class="inline-flex text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-slate-200/60 via-slate-200 to-slate-200/60 pb-1">Explore New Worlds</h3>
                                                            <p class="text-slate-400">Venture into the unknown and discover new planets, encounter new species, and uncover the secrets of the universe.</p>
                                                        </div>
                                                    </div>
                                                    <!-- Image -->
                                                    <div class="relative w-full h-64 md:h-auto overflow-hidden md:pb-8">
                                                        <img class="absolute bottom-0 left-1/2 -translate-x-1/2 mx-auto max-w-none md:max-w-full md:relative md:left-0 md:translate-x-0" src="/images/feature-image-03.png" width="230" height="230" alt="Feature 03">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Features #3 -->
                <section class="relative">

                    <!-- Blurred shape -->
                    <div class="absolute top-0 -translate-y-1/4 left-1/2 -translate-x-1/2 blur-2xl opacity-50 pointer-events-none -z-10" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="434" height="427">
                            <defs>
                                <linearGradient id="bs3-a" x1="19.609%" x2="50%" y1="14.544%" y2="100%">
                                    <stop offset="0%" stop-color="#6366F1" />
                                    <stop offset="100%" stop-color="#6366F1" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                            <path fill="url(#bs3-a)" fill-rule="evenodd" d="m410 0 461 369-284 58z" transform="matrix(1 0 0 -1 -410 427)" />
                        </svg>
                    </div>

                </section>

            </main>

            <!-- Site footer -->
            <footer>
                <div class="max-w-6xl mx-auto px-4 sm:px-6 mt-16 ">

                    <div class="sm:col-span-12 md:col-span-4 mx-auto text-center">
                        <div class="mb-2">
                            <!-- Logo -->
                            <a href="/" class="inline-block" aria-label="ECON Galaxy">
                                <img src="/images/logo.svg" width="38" height="38" alt="ECON Galaxy">
                            </a>
                        </div>
                        <p class="text-sm text-slate-500">The ultimate sci-fi sandbox experience! ECON Galaxy, a game by Robert Spektor Websolutions.</p>
                        <div class="mt-6">
                            <a href="/" class="text-gray-400 hover:text-gray-500 transition duration-150 ease-in-out">Terms</a>
                            <span class="text-gray-400 mx-3">•</span>
                            <a href="/" class="text-gray-400 hover:text-gray-500 transition duration-150 ease-in-out">Privacy</a>
                        </div>
                    </div>
                </div>

            </footer>

        </div>
    </body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const header = document.querySelector("header");

        window.addEventListener("scroll", function () {
            if (window.scrollY > 50) { // Hintergrund ab 50px Scroll
                header.classList.add("bg-darkPrimary", "shadow-md", "backdrop-blur-md");
            } else {
                header.classList.remove("bg-darkPrimary", "shadow-md", "backdrop-blur-md");
            }
        });
    });
</script>
