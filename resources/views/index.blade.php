<x-layout :title="$title" :activePage="$activePage" :indexData="$indexData">
    @section('page')
        <img src="{{ asset('images/hero-pattern.webp') }}" alt=""
            class="fixed inset-0 w-full h-full object-cover opacity-25 pointer-events-none select-none -z-10" />

        <main class="bg-main min-h-screen relative font-ubuntu flex flex-col items-center justify-center overflow-hidden py-28 rounded-b-[2.5rem] md:rounded-b-[3rem] shadow-2xl">
            @if (!empty($indexData->main_video))
                <video autoplay muted loop playsinline
                    class="absolute inset-0 w-full h-full object-cover">
                    <source src="{{ \App\Models\Index::resolveMedia($indexData->main_video) }}" type="video/mp4">
                </video>
            @endif
            <x-flowing-blobs variant="dark" />
            <div class="absolute inset-0 bg-black bg-opacity-10"></div>

            {{-- Social icons, floating on the right edge --}}
            <div class="hidden lg:flex absolute right-6 top-1/2 -translate-y-1/2 z-10 flex-col gap-3">
                <a href="https://www.facebook.com/profile.php?id=61550548845158" target="_blank" rel="noreferrer"
                    class="cursor-hover w-10 h-10 rounded-full bg-white text-[#831518] hover:bg-[var(--color-accent)] flex items-center justify-center hover:-translate-y-0.5 hover:shadow-lg transition-all">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="https://www.instagram.com/uvsoyolofficial" target="_blank" rel="noreferrer"
                    class="cursor-hover w-10 h-10 rounded-full bg-white text-[#831518] hover:bg-[var(--color-accent)] flex items-center justify-center hover:-translate-y-0.5 hover:shadow-lg transition-all">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="#" target="_blank" rel="noreferrer"
                    class="cursor-hover w-10 h-10 rounded-full bg-white text-[#831518] hover:bg-[var(--color-accent)] flex items-center justify-center hover:-translate-y-0.5 hover:shadow-lg transition-all">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M21.582 7.186a2.51 2.51 0 00-1.768-1.778C18.254 5 12 5 12 5s-6.254 0-7.814.408a2.51 2.51 0 00-1.768 1.778C2 8.756 2 12 2 12s0 3.244.418 4.814a2.51 2.51 0 001.768 1.778C5.746 19 12 19 12 19s6.254 0 7.814-.408a2.51 2.51 0 001.768-1.778C22 15.244 22 12 22 12s0-3.244-.418-4.814zM10 15.5v-7l6 3.5-6 3.5z" />
                    </svg>
                </a>
            </div>

            <div class="relative z-10 text-slate-100 px-6 space-y-6 text-center max-w-3xl mx-auto">
                @if (!empty($indexData->main_h2))
                    <h2 class="text-sm md:text-base font-semibold uppercase tracking-[0.3em] text-accent animate-fade-in-up" style="animation-delay: 0ms">{{ $indexData->main_h2 }}</h2>
                @endif
                <h1 class="text-4xl md:text-6xl font-extrabold uppercase leading-tight animate-fade-in-up" style="animation-delay: 150ms">{{ $indexData->main_h1 }}
                </h1>

                <p class="text-base font-medium max-w-xl mx-auto animate-fade-in-up" style="animation-delay: 300ms">{{ $indexData->main_p }}</p>

                {{-- Vision / Mission / Values cards --}}
                @if (!empty($indexData->sec8_cards))
                    <div data-stagger="120" class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-8 text-left">
                        @foreach ($indexData->sec8_cards as $card)
                            <div class="card-interactive reveal-scale bg-[#831518]/80 backdrop-blur-md border border-white/10 rounded-xl p-5 space-y-2">
                                <span class="block w-8 h-[3px] bg-accent rounded-full"></span>
                                <h3 class="text-accent font-bold uppercase text-sm tracking-wide">{{ $card['title'] }}</h3>
                                <p class="text-slate-100/90 text-xs leading-relaxed">{{ $card['description'] }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </main>

        {{-- Products carousel --}}
        @if ($homeProducts->isNotEmpty())
            <section class="bg-[#fbf6ef] font-ubuntu rounded-[2.5rem] md:rounded-[3rem] mx-5 md:mx-12 lg:mx-20 my-4 overflow-hidden">
                <div class="py-20 px-6 lg:px-20 space-y-10">
                    <div class="flex items-end justify-between flex-wrap gap-4 reveal">
                        <x-section-heading eyebrow="{{ $homeProducts->count() }}+ бүтээгдэхүүн" title="Онцлох бүтээгдэхүүн" />
                        <div class="hidden md:flex items-center gap-3">
                            <button type="button" data-carousel-prev aria-label="Өмнөх" class="carousel-arrow cursor-hover">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                            </button>
                            <button type="button" data-carousel-next aria-label="Дараах" class="carousel-arrow cursor-hover">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                            </button>
                        </div>
                    </div>

                    <div data-carousel>
                        <div class="carousel-track no-scrollbar flex gap-6 overflow-x-auto pb-4">
                            @foreach ($homeProducts as $i => $product)
                                <a href="/products/{{ $i }}"
                                    class="product-card cursor-hover group relative shrink-0 w-[52%] sm:w-[32%] lg:w-[calc(33.333%-1rem)] aspect-[3/4] rounded-3xl overflow-hidden shadow-lg reveal-scale transition-transform duration-300 hover:scale-105 hover:shadow-2xl hover:z-10">
                                    <div class="img-zoom absolute inset-0 w-full h-full">
                                        @if (!empty($product['image']))
                                            <img src="{{ \App\Models\ProductsPage::resolveMedia($product['image']) }}" alt="{{ $product['name'] ?? '' }}"
                                                loading="lazy" class="w-full h-full object-cover">
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
                                        <span class="inline-flex items-center gap-1 text-xs font-bold uppercase text-accent pt-1 group-hover:gap-2 transition-all">
                                            Дэлгэрэнгүй үзэх
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div data-carousel-dots class="flex items-center justify-center gap-2 mt-6"></div>
                    </div>
                </div>
            </section>
        @endif

        {{-- МЭДЭЭ МЭДЭЭЛЭЛ --}}
        @if ($homeNews->isNotEmpty())
            <section class="bg-white font-ubuntu rounded-[2.5rem] md:rounded-[3rem] mx-5 md:mx-12 lg:mx-20 my-4 overflow-hidden">
                <div class="py-20 px-6 lg:px-20 space-y-10">
                    <x-section-heading eyebrow="Сүүлд нэмэгдсэн" title="Онцлох мэдээлэл" align="center" class="mx-auto max-w-2xl reveal" />

                    {{-- Hover-expand panel gallery: hovering one panel grows it, the rest shrink --}}
                    <div data-stagger="120" class="news-hover-gallery flex flex-col md:flex-row gap-3 md:h-[440px]">
                        @foreach ($homeNews as $i => $item)
                            <a href="/news/{{ $i }}"
                                class="news-panel reveal-scale group relative flex-1 rounded-2xl overflow-hidden h-64 md:h-full shadow-md transition-[flex-grow,box-shadow] duration-500 ease-in-out hover:shadow-2xl cursor-hover">
                                <div class="absolute inset-0 w-full h-full overflow-hidden">
                                    @if (!empty($item['image']))
                                        <img src="{{ \App\Models\NewsPage::resolveMedia($item['image']) }}" alt="{{ $item['title'] ?? '' }}"
                                            loading="lazy" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
                                    @endif
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/15 to-transparent transition-opacity duration-500 group-hover:from-black/75"></div>

                                <div class="absolute inset-x-0 bottom-0 p-6 space-y-2 transition-transform duration-500 ease-out group-hover:-translate-y-1">
                                    @if (!empty($item['date']))
                                        <span class="inline-block w-fit text-[11px] font-semibold uppercase tracking-wide text-slate-100 bg-white/15 backdrop-blur-sm px-3 py-1 rounded-full">
                                            {{ \Illuminate\Support\Carbon::parse($item['date'])->translatedFormat('Y оны M сарын d') }}
                                        </span>
                                    @endif
                                    <h3 class="text-slate-100 font-extrabold uppercase text-lg md:text-xl leading-snug">{{ $item['title'] ?? '' }}</h3>

                                    <div class="news-panel-reveal">
                                        <div>
                                            @if (!empty($item['description']))
                                                <p class="text-slate-200 text-sm pt-1 line-clamp-3">{{ $item['description'] }}</p>
                                            @endif
                                            <span class="inline-flex items-center gap-1 text-xs font-bold uppercase text-accent pt-3 group-hover:gap-2 transition-all">
                                                Дэлгэрэнгүй үзэх
                                                <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="text-center">
                        <a href="/news"
                            class="cursor-hover inline-flex items-center gap-2 bg-[#831518] text-slate-100 text-sm font-bold uppercase px-6 py-3 rounded-full hover:-translate-y-0.5 hover:shadow-lg transition-all">
                            Бүх мэдээ
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                        </a>
                    </div>
                </div>
            </section>
        @endif

        {{-- МЕДИА --}}
        @if ($homeVideos->isNotEmpty())
            <section class="bg-[#fbf6ef] font-ubuntu rounded-[2.5rem] md:rounded-[3rem] mx-5 md:mx-12 lg:mx-20 my-4 overflow-hidden">
                <div class="py-20 px-6 lg:px-20 space-y-10">
                    <x-section-heading eyebrow="Видео" title="{{ $mediaH2 }}" align="center" class="mx-auto max-w-2xl reveal" />

                    <div data-stagger="110" class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($homeVideos as $item)
                            <button type="button"
                                class="media-item cursor-hover reveal-scale group relative block w-full text-left rounded-2xl overflow-hidden shadow-md bg-gray-900 h-56"
                                data-video="{{ \App\Models\MediaPage::resolveMedia($item['video']) }}">
                                @if (!empty($item['video']))
                                    <video autoplay muted loop playsinline
                                        @if (!empty($item['poster'])) poster="{{ \App\Models\MediaPage::resolveMedia($item['poster']) }}" @endif
                                        class="w-full h-full object-cover opacity-90 group-hover:opacity-70 group-hover:scale-105 transition-all duration-500">
                                        <source src="{{ \App\Models\MediaPage::resolveMedia($item['video']) }}" type="video/mp4">
                                    </video>
                                @elseif (!empty($item['poster']))
                                    <img src="{{ \App\Models\MediaPage::resolveMedia($item['poster']) }}" alt="{{ $item['title'] ?? '' }}"
                                        loading="lazy" class="w-full h-full object-cover opacity-80 group-hover:opacity-60 transition">
                                @endif
                                @if (!empty($item['video']))
                                    <span class="absolute inset-0 flex items-center justify-center">
                                        <span class="w-14 h-14 rounded-full bg-accent/90 flex items-center justify-center group-hover:scale-110 transition-transform">
                                            <svg class="w-6 h-6 text-[#831518] ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        </span>
                                    </span>
                                @endif
                                <span class="absolute inset-x-0 bottom-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                                    <span class="block text-slate-100 font-semibold">{{ $item['title'] ?? '' }}</span>
                                    @if (!empty($item['description']))
                                        <span class="block text-slate-200 text-xs mt-1">{{ $item['description'] }}</span>
                                    @endif
                                </span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Video modal --}}
            <div id="media-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 p-6">
                <button type="button" id="media-modal-close" class="absolute top-6 right-6 text-slate-100 text-3xl leading-none">&times;</button>
                <video id="media-modal-video" class="max-w-3xl w-full rounded-lg" controls></video>
            </div>
        @endif

    @endsection
</x-layout>
