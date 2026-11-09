<x-layout :title="$title" :activePage="$activePage">
    @section('page')
        {{-- Hero --}}
        <header class="relative h-[60vh] min-h-[400px] overflow-hidden font-ubuntu mx-3 md:mx-6 mt-3 md:mt-4 rounded-[2.5rem] md:rounded-[3rem]">
            <img src="{{ !empty($page->hero_image) ? \App\Models\NewsPage::resolveMedia($page->hero_image) : asset('images/mainbackground.jpg') }}" alt="{{ $page->hero_h1 ?? 'Мэдээ мэдээлэл' }}"
                class="absolute inset-0 w-full h-full object-cover animate-ken-burns">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/20 to-black/5"></div>
            <x-flowing-blobs variant="dark" />

            <div class="relative h-full flex flex-col justify-end pb-16 pl-6 md:pl-16 space-y-4 text-slate-100 max-w-3xl">
                @if (!empty($page->hero_h2))
                    <span class="inline-block w-fit uppercase tracking-[0.3em] text-xs md:text-sm text-accent font-semibold animate-fade-in-up"
                        style="animation-delay: 0ms">
                        {{ $page->hero_h2 }}
                    </span>
                @endif
                <h1 class="font-script text-3xl md:text-5xl leading-tight animate-fade-in-up" style="animation-delay: 150ms">
                    {{ $page->hero_h1 ?? 'Мэдээ мэдээлэл' }}
                </h1>
                <hr class="w-1/3 border-2 border-[#831518] animate-fade-in-up" style="animation-delay: 300ms">
                @if (!empty($page->hero_p))
                    <p class="text-slate-200 text-base md:text-lg max-w-xl animate-fade-in-up" style="animation-delay: 450ms">
                        {{ $page->hero_p }}
                    </p>
                @endif
            </div>
        </header>

        {{-- News grid --}}
        <section class="bg-white font-ubuntu rounded-[2.5rem] md:rounded-[3rem] mx-3 md:mx-6 my-4 overflow-hidden">
            <div class="py-20 px-6 lg:px-20">
                @if (!empty($news))
                    @php
                        $featuredKey = array_key_first($news);
                        $featured = $news[$featuredKey];
                        $restNews = collect($news)->except([$featuredKey]);
                    @endphp

                    {{-- Featured (latest) news --}}
                    <a href="/news/{{ $featuredKey }}"
                        class="card-interactive cursor-hover reveal-scale group block bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 mb-10 md:grid md:grid-cols-2 md:items-stretch max-w-6xl mx-auto">
                        @if (!empty($featured['image']))
                            <div class="img-zoom h-64 md:h-full">
                                <img src="{{ \App\Models\NewsPage::resolveMedia($featured['image']) }}" alt="{{ $featured['title'] ?? '' }}"
                                    loading="lazy" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="p-8 md:p-12 flex flex-col justify-center space-y-3">
                            <span class="inline-block w-fit text-xs font-semibold uppercase tracking-wide text-slate-100 bg-[#831518] px-3 py-1 rounded-full">
                                Онцлох мэдээ
                            </span>
                            @if (!empty($featured['date']))
                                <span class="text-xs text-gray-500 uppercase tracking-wide">
                                    {{ \Illuminate\Support\Carbon::parse($featured['date'])->translatedFormat('Y оны M сарын d') }}
                                </span>
                            @endif
                            <h3 class="text-2xl md:text-3xl font-bold text-gray-900 leading-snug">{{ $featured['title'] ?? '' }}</h3>
                            @if (!empty($featured['description']))
                                <p class="text-gray-600">{{ $featured['description'] }}</p>
                            @endif
                            <span class="inline-flex items-center gap-1 text-sm font-bold uppercase text-[#831518] pt-2 group-hover:gap-2 transition-all">
                                Цааш унших
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                            </span>
                        </div>
                    </a>

                    <div data-stagger="110" class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 max-w-6xl mx-auto">
                        @foreach ($restNews as $i => $item)
                            <a href="/news/{{ $i }}" class="card-interactive cursor-hover reveal-scale block bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100">
                                @if (!empty($item['image']))
                                    <div class="img-zoom h-52">
                                        <img src="{{ \App\Models\NewsPage::resolveMedia($item['image']) }}" alt="{{ $item['title'] ?? '' }}"
                                            loading="lazy" class="w-full h-full object-cover">
                                    </div>
                                @endif
                                <div class="p-6 space-y-2">
                                    @if (!empty($item['date']))
                                        <span class="inline-block text-xs font-semibold uppercase tracking-wide text-[#831518] bg-[#831518]/10 px-3 py-1 rounded-full">
                                            {{ \Illuminate\Support\Carbon::parse($item['date'])->translatedFormat('Y оны M сарын d') }}
                                        </span>
                                    @endif
                                    <h3 class="text-xl font-semibold text-gray-900">{{ $item['title'] ?? '' }}</h3>
                                    @if (!empty($item['description']))
                                        <p class="text-sm text-gray-600">{{ $item['description'] }}</p>
                                    @endif
                                    <span class="inline-flex items-center gap-1 text-xs font-bold uppercase text-[#831518] pt-1">
                                        Цааш унших
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-500">Одоогоор мэдээ нэмэгдээгүй байна.</p>
                @endif
            </div>
        </section>
    @endsection
</x-layout>
