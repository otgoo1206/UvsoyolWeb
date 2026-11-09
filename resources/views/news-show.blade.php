<x-layout :title="$title" :activePage="$activePage">
    @section('page')
        {{-- Hero --}}
        <header class="relative h-[35vh] min-h-[220px] overflow-hidden font-ubuntu mx-3 md:mx-6 mt-3 md:mt-4 rounded-[2.5rem] md:rounded-[3rem]">
            @if (!empty($item['image']))
                <img src="{{ \App\Models\NewsPage::resolveMedia($item['image']) }}" alt="{{ $item['title'] ?? '' }}"
                    class="absolute inset-0 w-full h-full object-cover animate-ken-burns">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/15 to-transparent"></div>
            <x-flowing-blobs variant="dark" />

            <div class="relative h-full flex flex-col justify-end pb-10 pl-6 md:pl-16 space-y-2 text-slate-100 max-w-3xl">
                <span class="inline-block w-fit uppercase tracking-[0.3em] text-xs md:text-sm text-[#e0a9a9] font-semibold">
                    Мэдээ мэдээлэл
                </span>
                <hr class="w-1/4 border-2 border-[#831518]">
            </div>
        </header>

        {{-- Article + sidebar --}}
        <section class="bg-white font-ubuntu rounded-[2.5rem] md:rounded-[3rem] mx-3 md:mx-6 my-4 overflow-hidden">
            <div class="py-16 px-6 lg:px-20">
                <a href="/news" class="cursor-hover inline-flex items-center gap-1 text-sm font-bold uppercase text-[#831518] mb-8">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                    Бүх мэдээ рүү буцах
                </a>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start max-w-6xl mx-auto">
                    {{-- Main article --}}
                    <div class="lg:col-span-2 reveal space-y-6">
                        <h1 class="text-2xl md:text-4xl font-extrabold text-gray-900 leading-snug">{{ $item['title'] ?? '' }}</h1>

                        <div class="flex flex-wrap items-center gap-x-6 gap-y-3 text-sm text-gray-500 border-b border-gray-100 pb-6">
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                Үзсэн {{ number_format((int) ($item['views'] ?? 0)) }}
                            </span>
                            @if (!empty($item['date']))
                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0V11.25A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                                    {{ \Illuminate\Support\Carbon::parse($item['date'])->translatedFormat('Y оны M сарын d') }}
                                </span>
                            @endif

                            <span class="inline-flex items-center gap-2 ml-auto">
                                <span class="text-xs font-semibold uppercase text-gray-400">Түгээх</span>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noreferrer"
                                    class="cursor-hover w-8 h-8 rounded-full bg-gray-100 hover:bg-[#831518] hover:text-white flex items-center justify-center transition-colors" aria-label="Facebook-т хуваалцах">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($item['title'] ?? '') }}" target="_blank" rel="noreferrer"
                                    class="cursor-hover w-8 h-8 rounded-full bg-gray-100 hover:bg-[#831518] hover:text-white flex items-center justify-center transition-colors" aria-label="Twitter-т хуваалцах">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" /></svg>
                                </a>
                                <button type="button" data-copy-link
                                    class="cursor-hover w-8 h-8 rounded-full bg-gray-100 hover:bg-[#831518] hover:text-white flex items-center justify-center transition-colors" aria-label="Холбоос хуулах">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" /></svg>
                                </button>
                            </span>
                        </div>

                        @if (!empty($item['description']))
                            <p class="text-lg text-gray-700 font-medium leading-relaxed">{{ $item['description'] }}</p>
                        @endif

                        @if (!empty($item['image']))
                            <div class="rounded-2xl overflow-hidden shadow-md">
                                <img src="{{ \App\Models\NewsPage::resolveMedia($item['image']) }}" alt="{{ $item['title'] ?? '' }}" class="w-full h-auto">
                            </div>
                        @endif

                        @if (!empty($item['content']))
                            <div class="prose max-w-none text-gray-700 leading-relaxed whitespace-pre-line">{{ $item['content'] }}</div>
                        @endif
                    </div>

                    {{-- Sidebar: other news --}}
                    @if (!empty($others))
                        <aside class="space-y-4">
                            <h2 class="text-sm font-bold uppercase tracking-wide text-gray-900 border-b border-gray-100 pb-3">Бусад мэдээ</h2>
                            <div class="space-y-3">
                                @foreach ($others as $i => $n)
                                    <a href="/news/{{ $i }}" class="card-interactive cursor-hover group flex items-center gap-3 bg-[#fbf6ef] hover:bg-[#831518]/5 rounded-xl p-3 transition-colors">
                                        <div class="img-zoom w-16 h-16 shrink-0 rounded-lg overflow-hidden">
                                            @if (!empty($n['image']))
                                                <img src="{{ \App\Models\NewsPage::resolveMedia($n['image']) }}" alt="{{ $n['title'] ?? '' }}"
                                                    loading="lazy" class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="text-sm font-semibold text-gray-900 line-clamp-2 group-hover:text-[#831518] transition-colors">{{ $n['title'] ?? '' }}</h4>
                                            @if (!empty($n['date']))
                                                <span class="text-xs text-gray-500">{{ \Illuminate\Support\Carbon::parse($n['date'])->translatedFormat('Y.MM.dd') }}</span>
                                            @endif
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </aside>
                    @endif
                </div>
            </div>
        </section>
    @endsection
</x-layout>
