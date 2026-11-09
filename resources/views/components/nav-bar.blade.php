<nav class="site-nav group fixed top-3 md:top-4 inset-x-0 mx-auto w-[95%] max-w-6xl z-50 font-ubuntu rounded-[2rem] md:rounded-full bg-[#fbeaea]">
    <div class="flex flex-wrap items-center justify-between mx-auto px-4 py-2.5 md:px-6 gap-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse shrink-0">
            <img src="{{ asset('images/uvsoyol.jpg') }}" class="nav-logo-img h-10 rounded-full" alt="Өв Соёл ХХК лого" />
            <span class="notranslate brand-name self-center text-2xl font-semibold whitespace-nowrap text-[#831518] transition-colors duration-500"
                translate="no" data-mn="Өв Соёл ХХК" data-en="UvSoyol LLC">Өв Соёл ХХК</span>
        </a>

        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-[#831518] rounded-lg md:hidden hover:bg-black/5 transition-colors duration-500 focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <div class="hidden w-full md:flex md:items-center md:w-auto md:flex-1 md:justify-end" id="navbar-default">
            <ul
                class="flex flex-col text-xl font-medium p-4 md:p-0 mt-4 border border-gray-200 rounded-lg bg-slate-200 text-gray-900 md:space-x-1 rtl:space-x-reverse md:flex-row md:items-center md:mt-0 md:border-0 md:bg-transparent md:text-[#831518] md:transition-colors md:duration-500">
                <li>
                    <a href="/about"
                        class="nav-underline block py-2 px-3 md:p-2 rounded {{ $activePage === 'about' ? 'bg-[#831518]/80 text-slate-100 is-active' : 'hover:text-slate-100 hover:bg-[#831518]/80' }} md:transition-colors md:duration-500 md:ease-in-out md:text-base md:bg-transparent {{ $activePage === 'about' ? 'is-active' : '' }}">
                        Бидний тухай
                    </a>
                </li>
                {{-- БҮТЭЭГДЭХҮҮН dropdown --}}
                <li class="nav-dropdown relative">
                    <a href="/products"
                        class="nav-underline flex items-center gap-1 py-2 px-3 md:p-2 rounded {{ $activePage === 'products' ? 'bg-[#831518]/80 text-slate-100 is-active' : 'hover:text-slate-100 hover:bg-[#831518]/80' }} md:transition-colors md:duration-500 md:ease-in-out md:text-base md:bg-transparent {{ $activePage === 'products' ? 'is-active' : '' }}">
                        Бүтээгдэхүүн
                        <svg class="w-3.5 h-3.5 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    <ul class="nav-dropdown-menu md:absolute md:left-0 md:top-full md:mt-2 md:w-56 md:bg-white md:rounded-lg md:shadow-xl md:border md:border-gray-100 md:py-2 pl-4 md:pl-0">
                        <li><a href="/products" class="block px-4 py-2 text-base md:text-sm text-gray-900 hover:bg-[#831518]/10 hover:text-[#831518] transition">Бүх бүтээгдэхүүн</a></li>
                        <li><a href="/products?category=Нарийн+боов" class="block px-4 py-2 text-base md:text-sm text-gray-900 hover:bg-[#831518]/10 hover:text-[#831518] transition">Нарийн боов</a></li>
                        <li><a href="/products?category=Талх" class="block px-4 py-2 text-base md:text-sm text-gray-900 hover:bg-[#831518]/10 hover:text-[#831518] transition">Талх</a></li>
                        <li><a href="/products?category=Хэвийн+боов" class="block px-4 py-2 text-base md:text-sm text-gray-900 hover:bg-[#831518]/10 hover:text-[#831518] transition">Хэвийн боов</a></li>
                    </ul>
                </li>

                {{-- МЭДЭЭ МЭДЭЭЛЭЛ dropdown --}}
                <li class="nav-dropdown relative">
                    <a href="/news"
                        class="nav-underline flex items-center gap-1 py-2 px-3 md:p-2 rounded {{ $activePage === 'news' ? 'bg-[#831518]/80 text-slate-100 is-active' : 'hover:text-slate-100 hover:bg-[#831518]/80' }} md:transition-colors md:duration-500 md:ease-in-out md:text-base md:bg-transparent {{ $activePage === 'news' ? 'is-active' : '' }}">
                        Мэдээ мэдээлэл
                        <svg class="w-3.5 h-3.5 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    <ul class="nav-dropdown-menu md:absolute md:left-0 md:top-full md:mt-2 md:w-56 md:bg-white md:rounded-lg md:shadow-xl md:border md:border-gray-100 md:py-2 pl-4 md:pl-0">
                        <li><a href="/news" class="block px-4 py-2 text-base md:text-sm text-gray-900 hover:bg-[#831518]/10 hover:text-[#831518] transition">Бүх мэдээ</a></li>
                    </ul>
                </li>

                <li>
                    <a href="/contact"
                        class="nav-underline block py-2 px-3 md:p-2 rounded {{ $activePage === 'contact' ? 'bg-[#831518]/80 text-slate-100 is-active' : 'hover:text-slate-100 hover:bg-[#831518]/80' }} md:transition-colors md:duration-500 md:ease-in-out md:text-base md:bg-transparent {{ $activePage === 'contact' ? 'is-active' : '' }}">
                        Холбоо барих
                    </a>
                </li>
            </ul>

            <div class="flex items-center gap-3 mt-4 md:mt-0 md:ml-4">
                {{-- Search --}}
                <div class="nav-search relative">
                    <button type="button" id="nav-search-toggle"
                        class="cursor-hover p-2 rounded-full text-[#831518] hover:bg-black/10 transition-colors duration-500" aria-label="Хайх">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10.5A6.5 6.5 0 114 10.5a6.5 6.5 0 0113 0z" />
                        </svg>
                    </button>
                    <form id="nav-search-form" action="/products" method="GET"
                        class="hidden absolute right-0 top-full mt-2 w-64 bg-white rounded-lg shadow-xl border border-gray-100 p-2">
                        <input type="text" name="q" placeholder="Бүтээгдэхүүн хайх..."
                            class="w-full border-0 focus:ring-0 text-sm text-gray-900 px-2 py-1">
                    </form>
                </div>

                <x-language-switcher />
            </div>
        </div>
    </div>
</nav>
