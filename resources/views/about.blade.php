<x-layout :title="$title" :activePage="$activePage">
    @section('page')

        @if (!empty($pageBackground['image']))
            <div class="fixed inset-0 -z-10 bg-cover bg-center bg-fixed"
                style="background-image: url('{{ \App\Models\About::resolveMedia($pageBackground['image']) }}');"></div>
        @endif

        {{-- HERO SECTION --}}
        @if (!empty($heroData))
            <header class="relative h-[75vh] min-h-[480px] overflow-hidden font-ubuntu mx-3 md:mx-6 mt-3 md:mt-4 rounded-[2.5rem] md:rounded-[3rem] shadow-2xl ring-1 ring-black/10">
                @if (!empty($heroData['video']))
                    <video autoplay muted loop playsinline
                        class="absolute inset-0 w-full h-full object-cover">
                        <source src="{{ \App\Models\About::resolveMedia($heroData['video']) }}" type="video/mp4">
                    </video>
                @elseif (!empty($heroData['image']))
                    <img src="{{ \App\Models\About::resolveMedia($heroData['image']) }}" alt="{{ $heroData['title'] ?? '' }}"
                        class="absolute inset-0 w-full h-full object-cover animate-ken-burns">
                @endif

                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                <x-flowing-blobs variant="dark" />

                <div class="relative h-full flex flex-col justify-end pb-20 pl-6 md:pl-16 space-y-4 text-slate-100 max-w-3xl">
                    @if (!empty($heroData['subtitle']))
                        <span class="inline-flex items-center gap-2 w-fit uppercase tracking-[0.3em] text-xs md:text-sm text-[#f3d9d9] font-semibold bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-4 py-1.5 animate-fade-in-up"
                            style="animation-delay: 0ms">
                            <span class="w-1.5 h-1.5 rounded-full bg-accent"></span>
                            {{ $heroData['subtitle'] }}
                        </span>
                    @endif
                    <h1 class="font-script notranslate brand-name text-3xl md:text-5xl leading-tight animate-fade-in-up" translate="no"
                        data-mn="{{ $heroData['title'] }}" data-en="UvSoyol LLC" style="animation-delay: 150ms">
                        {{ $heroData['title'] }}
                    </h1>
                    <hr class="w-1/3 border-2 border-[#831518] animate-fade-in-up" style="animation-delay: 300ms">
                    @if (!empty($heroData['description']))
                        <p class="text-slate-200 text-base md:text-lg max-w-xl animate-fade-in-up" style="animation-delay: 450ms">
                            {{ $heroData['description'] }}
                        </p>
                    @endif
                </div>

                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 animate-bounce text-slate-100/80">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </div>
            </header>
        @endif

        {{-- TIMELINE SECTION --}}
        @if (!empty($timelineData))
            <section class="bg-white font-ubuntu rounded-[2.5rem] md:rounded-[3rem] mx-3 md:mx-6 my-4 overflow-hidden">
                <div class="py-20 px-6 md:px-14">
                    <x-section-heading eyebrow="Манай замнал" title="Бидний түүхэн замнал" align="center" class="mx-auto max-w-2xl mb-16 reveal" />

                    <div class="relative max-w-4xl mx-auto">
                        <div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-0.5 bg-gradient-to-b from-[#831518] via-[#831518]/40 to-transparent md:-translate-x-1/2"></div>

                        <div data-stagger="150" class="space-y-12">
                            @foreach ($timelineData as $i => $item)
                                <div class="relative flex flex-col md:flex-row items-start md:items-center gap-6 {{ $i % 2 === 1 ? 'md:flex-row-reverse' : '' }}">

                                    <div class="absolute left-4 md:left-1/2 w-4 h-4 rounded-full bg-[#831518] ring-4 ring-white -translate-x-1/2 z-10 group-hover:scale-125 transition-transform"></div>

                                    <div class="w-full md:w-1/2 pl-12 md:pl-0 {{ $i % 2 === 1 ? 'md:pl-12' : 'md:pr-12 md:text-right' }} reveal">
                                        <span class="inline-block text-[#831518] font-bold text-xl">{{ $item['year'] }}</span>
                                        <h3 class="text-lg font-semibold text-gray-900 mt-1">{{ $item['title'] }}</h3>
                                        <p class="text-gray-600 mt-2">{{ $item['description'] }}</p>
                                    </div>

                                    <div class="w-full md:w-1/2 pl-12 md:pl-0 {{ $i % 2 === 1 ? 'md:pr-12' : 'md:pl-12' }} reveal-scale">
                                        @if (!empty($item['image']))
                                            <div class="card-interactive img-zoom rounded-xl shadow-lg border border-gray-100">
                                                <img src="{{ \App\Models\About::resolveMedia($item['image']) }}" alt="{{ $item['title'] }}"
                                                    loading="lazy"
                                                    class="w-full h-48 object-cover">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- COUNTERS SECTION --}}
        @if (!empty($countersData))
            <section class="bg-[#fbf6ef] font-ubuntu rounded-[2.5rem] md:rounded-[3rem] mx-3 md:mx-6 my-4 overflow-hidden">
                <div data-stagger="100" class="grid grid-cols-2 md:grid-cols-4 gap-6 py-16 px-6 md:px-14">
                    @foreach ($countersData as $counter)
                        <div class="card-interactive reveal-scale text-center space-y-1 bg-white border border-gray-100 rounded-2xl py-8 shadow-sm">
                            <h3 class="text-4xl md:text-5xl font-extrabold text-[#831518] counter" data-target="{{ $counter['value'] }}">0</h3>
                            <p class="text-gray-600 font-medium text-sm uppercase tracking-wide">{{ $counter['title'] }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- VIDEO SECTION --}}
        @if (!empty($videoSection) && (!empty($videoSection['video']) || !empty($videoSection['poster'])))
            <section class="bg-[#fbf6ef] font-ubuntu rounded-[2.5rem] md:rounded-[3rem] mx-3 md:mx-6 my-4 overflow-hidden">
                <div class="py-20 px-6 md:px-14">
                    <div class="max-w-5xl mx-auto grid md:grid-cols-2 gap-10 items-center">
                        <div class="reveal-left space-y-4">
                            <span class="text-xs font-semibold uppercase tracking-[0.2em] text-[#831518]">Бидний үйл явц</span>
                            <h2 class="text-2xl md:text-3xl font-extrabold uppercase text-gray-900 leading-tight">{{ $videoSection['title'] ?? '' }}</h2>
                            <span class="block w-16 h-[3px] rounded-full bg-[#831518]"></span>
                            <p class="text-gray-600">{{ $videoSection['description'] ?? '' }}</p>
                        </div>
                        <div class="reveal-right relative">
                            <span class="absolute -top-3 -right-3 w-10 h-10 rounded-tr-2xl border-t-4 border-r-4 border-accent hidden sm:block"></span>
                            @if (!empty($videoSection['video']))
                                <video controls
                                    @if (!empty($videoSection['poster'])) poster="{{ \App\Models\About::resolveMedia($videoSection['poster']) }}" @endif
                                    class="w-full rounded-2xl shadow-2xl ring-4 ring-white">
                                    <source src="{{ \App\Models\About::resolveMedia($videoSection['video']) }}" type="video/mp4">
                                </video>
                            @elseif (!empty($videoSection['poster']))
                                <img src="{{ \App\Models\About::resolveMedia($videoSection['poster']) }}" alt="{{ $videoSection['title'] ?? '' }}"
                                    loading="lazy"
                                    class="w-full rounded-2xl shadow-2xl ring-4 ring-white object-cover">
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- PRODUCTION / SERVICE SECTIONS --}}
        @if (!empty($serviceData))
            <div id="production">
                {{-- Equipment capacity --}}
                @if (!empty($serviceData->sec2_cards))
                    <section class="bg-[#fbf6ef] font-ubuntu rounded-[2.5rem] md:rounded-[3rem] mx-3 md:mx-6 my-4 overflow-hidden">
                        <div class="py-20 px-8 space-y-14 lg:px-20">
                            <x-section-heading eyebrow="Манай чадавхи" :title="$serviceData->sec2_h2" align="center" class="mx-auto max-w-2xl reveal" />
                            <p class="text-gray-600 text-center max-w-2xl mx-auto -mt-8 reveal">{{ $serviceData->sec2_p }}</p>

                            <div data-stagger="120" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 max-w-6xl mx-auto">
                                @foreach ($serviceData->sec2_cards as $item)
                                    <div class="card-interactive reveal-scale bg-white border border-gray-100 rounded-2xl shadow-sm p-6 text-center">
                                        <div class="mx-auto mb-3 w-12 h-12 rounded-full bg-[#831518]/10 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-[#831518]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-2xl font-extrabold text-[#831518]">{{ $item['step'] }}</h3>
                                        <h5 class="mt-2 font-semibold text-gray-900">{{ $item['title'] }}</h5>
                                        <p class="mt-1 text-sm text-gray-500">{{ $item['description'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif

                {{-- Equipment information --}}
                @if (!empty($serviceData->sec3_equipment))
                    <section class="bg-white font-ubuntu rounded-[2.5rem] md:rounded-[3rem] mx-3 md:mx-6 my-4 overflow-hidden">
                        <div class="py-20 px-6 lg:px-20 space-y-12">
                            <x-section-heading eyebrow="Тоног төхөөрөмж" :title="$serviceData->sec3_h2" align="center" class="mx-auto max-w-2xl reveal" />
                            <p class="text-gray-600 text-center max-w-2xl mx-auto -mt-8 reveal">{{ $serviceData->sec3_p }}</p>

                            <div data-stagger="110" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                                @foreach ($serviceData->sec3_equipment as $equip)
                                    <div class="card-interactive group reveal-scale bg-white border border-gray-100 rounded-2xl shadow-md overflow-hidden">
                                        @if (!empty($equip['image']))
                                            <div class="img-zoom h-48">
                                                <img src="{{ \App\Models\ServicesPage::resolveMedia($equip['image']) }}" alt="{{ $equip['name'] ?? '' }}"
                                                    loading="lazy" class="w-full h-full object-cover">
                                            </div>
                                        @endif
                                        <div class="p-6 text-center">
                                            <h5 class="text-lg font-bold text-gray-900 group-hover:text-[#831518] transition-colors">{{ $equip['name'] ?? '' }}</h5>
                                            @if (!empty($equip['description']))
                                                <p class="mt-2 text-sm text-gray-600">{{ $equip['description'] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif
            </div>
        @endif

        {{-- Манай баг --}}
        @if (!empty($teamData) && !empty($teamData->sec6_cards))
            <section class="bg-[#fbf6ef] font-ubuntu rounded-[2.5rem] md:rounded-[3rem] mx-3 md:mx-6 my-4 overflow-hidden">
                <div class="py-20 px-6 space-y-12 lg:px-20">
                    <x-section-heading eyebrow="Манай хамт олон" :title="$teamData->sec6_h2" align="center" class="mx-auto max-w-2xl reveal" />
                    @if (!empty($teamData->sec6_p))
                        <p class="text-sm text-gray-600 text-center max-w-xl mx-auto -mt-6 reveal">{{ $teamData->sec6_p }}</p>
                    @endif

                    <div data-stagger="110" class="grid grid-cols-1 text-center gap-y-8 sm:grid-cols-2 lg:grid-cols-4 lg:gap-x-6">
                        @foreach ($teamData->sec6_cards as $card)
                            <div class="card-interactive group reveal-scale bg-white border border-gray-100 rounded-2xl shadow-md overflow-hidden">
                                <div class="img-zoom relative h-56">
                                    <img class="w-full h-full object-cover" src="{{ asset('storage/' . $card['img']) }}" alt="{{ $card['h3'] }}" loading="lazy" />
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#831518]/80 via-[#831518]/0 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    <span class="absolute left-1/2 bottom-4 -translate-x-1/2 w-10 h-[3px] bg-accent rounded-full scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                                </div>
                                <div class="p-6">
                                    <h3 class="mb-1 text-lg font-bold tracking-tight text-gray-900 group-hover:text-[#831518] transition-colors">{{ $card['h3'] }}</h3>
                                    <p class="text-sm text-gray-500">{{ $card['p'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

    @endsection
</x-layout>
