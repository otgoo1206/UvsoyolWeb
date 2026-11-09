<x-layout :title="$title" :activePage="$activePage">
    @section('page')
        {{-- Hero --}}
        <header class="relative h-[60vh] min-h-[400px] overflow-hidden font-ubuntu mx-3 md:mx-6 mt-3 md:mt-4 rounded-[2.5rem] md:rounded-[3rem]">
            <img src="{{ asset('images/products.png') }}" alt="{{ $page->hero_h1 ?? 'Бүтээгдэхүүн' }}"
                class="absolute inset-0 w-full h-full object-cover animate-ken-burns">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/20 to-black/5"></div>
            <x-flowing-blobs variant="dark" />

            <div class="relative h-full flex flex-col justify-end pb-16 pl-6 md:pl-16 space-y-4 text-slate-100 max-w-3xl">
                @if (!empty($page->hero_h2))
                    <span class="inline-block w-fit uppercase tracking-[0.3em] text-xs md:text-sm text-[#e0a9a9] font-semibold animate-fade-in-up"
                        style="animation-delay: 0ms">
                        {{ $page->hero_h2 }}
                    </span>
                @endif
                <h1 class="font-script text-3xl md:text-5xl leading-tight animate-fade-in-up" style="animation-delay: 150ms">
                    {{ $page->hero_h1 ?? 'Бүтээгдэхүүн' }}
                </h1>
                <hr class="w-1/3 border-2 border-[#831518] animate-fade-in-up" style="animation-delay: 300ms">
                @if (!empty($page->hero_p))
                    <p class="text-slate-200 text-base md:text-lg max-w-xl animate-fade-in-up" style="animation-delay: 450ms">
                        {{ $page->hero_p }}
                    </p>
                @endif
            </div>
        </header>

        {{-- All products --}}
        <section id="catalog" class="bg-[#fbf6ef] font-ubuntu rounded-[2.5rem] md:rounded-[3rem] mx-3 md:mx-6 my-4 overflow-hidden">
            <div class="pt-10 pb-20 px-6 lg:px-20">
                <div class="text-center mb-10 reveal">
                    <h2 class="font-script text-3xl text-gray-900 lg:text-4xl">Бүх бүтээгдэхүүн</h2>
                    @if (!empty($searchQuery))
                        <p class="text-sm text-gray-500 mt-3">
                            "<span class="font-semibold">{{ $searchQuery }}</span>" хайлтын үр дүн
                            <a href="/products" class="text-[#831518] underline ml-2">Цэвэрлэх</a>
                        </p>
                    @endif
                </div>

                @if (!empty($categories))
                    <div class="flex flex-wrap justify-center gap-3 mb-12 reveal">
                        <button type="button" data-filter="ALL"
                            class="category-pill active px-5 py-2 rounded-full border border-[#831518] text-[#831518] text-sm font-medium uppercase tracking-wide transition">
                            Бүгд
                        </button>
                        @foreach ($categories as $category)
                            <button type="button" data-filter="{{ $category }}"
                                class="category-pill px-5 py-2 rounded-full border border-[#831518] text-[#831518] text-sm font-medium uppercase tracking-wide transition">
                                {{ $category }}
                            </button>
                        @endforeach
                    </div>
                @endif

                @if (!empty($products))
                    <div id="product-grid" data-stagger="90" class="grid grid-cols-2 gap-6 sm:grid-cols-3 lg:grid-cols-4 md:gap-10 max-w-6xl mx-auto">
                        @foreach ($products as $i => $product)
                            <a href="/products/{{ $i }}" class="product-card cursor-hover group relative block aspect-[3/4] rounded-2xl overflow-hidden shadow-md hover:shadow-2xl hover:scale-105 transition-all duration-300 reveal-scale"
                                data-category="{{ $product['category'] ?? '' }}">
                                <div class="absolute inset-0 w-full h-full overflow-hidden">
                                    @if (!empty($product['image']))
                                        <img src="{{ \App\Models\ProductsPage::resolveMedia($product['image']) }}" alt="{{ $product['name'] ?? '' }}"
                                            loading="lazy"
                                            class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
                                    @endif
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                                <div class="absolute inset-x-0 bottom-0 p-6 space-y-2">
                                    @if (!empty($product['category']))
                                        <span class="inline-block w-fit text-[11px] font-semibold uppercase tracking-wide text-slate-100 bg-white/15 backdrop-blur-sm px-3 py-1 rounded-full">
                                            {{ $product['category'] }}
                                        </span>
                                    @endif
                                    <h3 class="text-lg font-bold text-slate-100">{{ $product['name'] ?? '' }}</h3>
                                    @if (!empty($product['price']))
                                        <p class="text-base font-bold text-accent">{{ number_format((float) $product['price']) }}₮</p>
                                    @endif
                                    <span class="inline-flex items-center gap-1 text-xs font-bold uppercase text-accent pt-1 group-hover:gap-2 transition-all">
                                        Дэлгэрэнгүй үзэх
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <p id="product-empty" class="hidden text-center text-gray-500 mt-10">Энэ ангилалд одоогоор бүтээгдэхүүн алга байна.</p>
                @else
                    <p class="text-center text-gray-500">Одоогоор бүтээгдэхүүн нэмэгдээгүй байна.</p>
                @endif
            </div>
        </section>
    @endsection
</x-layout>
