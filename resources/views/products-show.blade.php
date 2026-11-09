<x-layout :title="$title" :activePage="$activePage">
    @section('page')
        {{-- Detail --}}
        <section class="bg-white font-ubuntu rounded-[2.5rem] md:rounded-[3rem] mx-3 md:mx-6 mt-3 md:mt-4 my-4 overflow-hidden">
            <div class="py-16 px-6 lg:px-20">
                <a href="/products" class="cursor-hover inline-flex items-center gap-1 text-sm font-bold uppercase text-[#831518] mb-8">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                    Бүх бүтээгдэхүүн рүү буцах
                </a>

                <div class="bg-[#fbf6ef] rounded-[2rem] p-6 md:p-10 max-w-5xl mx-auto reveal">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                        <div class="rounded-2xl overflow-hidden shadow-lg bg-white aspect-square">
                            @if (!empty($product['image']))
                                <img src="{{ \App\Models\ProductsPage::resolveMedia($product['image']) }}" alt="{{ $product['name'] ?? '' }}"
                                    class="w-full h-full object-cover">
                            @endif
                        </div>

                        <div class="space-y-5">
                            @if (!empty($product['category']))
                                <span class="inline-block text-xs font-semibold uppercase tracking-wide text-[#831518] bg-[#831518]/10 px-3 py-1 rounded-full">
                                    {{ $product['category'] }}
                                </span>
                            @endif
                            <h1 class="text-2xl md:text-3xl font-extrabold uppercase text-gray-900">{{ $product['name'] ?? '' }}</h1>
                            <span class="block w-16 h-[3px] rounded-full bg-gradient-to-r from-[#831518] to-accent"></span>

                            @if (!empty($product['description']))
                                <p class="text-gray-600 leading-relaxed">{{ $product['description'] }}</p>
                            @endif

                            <dl class="space-y-3 text-sm">
                                @if (!empty($product['weight']))
                                    <div class="flex gap-2">
                                        <dt class="font-semibold text-gray-900 shrink-0">Бүтээгдэхүүний жин:</dt>
                                        <dd class="text-gray-600">{{ $product['weight'] }}</dd>
                                    </div>
                                @endif

                                @if (!empty($product['ingredients']))
                                    <div class="flex gap-2">
                                        <dt class="font-semibold text-gray-900 shrink-0">Орц найрлага:</dt>
                                        <dd class="text-gray-600">{{ $product['ingredients'] }}</dd>
                                    </div>
                                @endif

                                @if (!empty($product['calories']) || !empty($product['protein']) || !empty($product['fat']) || !empty($product['carbs']))
                                    <div>
                                        <dt class="font-semibold text-gray-900 mb-1">Тэжээллэг чанар /100 гр-д/:</dt>
                                        <dd class="text-gray-600 pl-4 space-y-0.5">
                                            @if (!empty($product['calories']))
                                                <div>Илчлэг - {{ $product['calories'] }} ккал</div>
                                            @endif
                                            @if (!empty($product['protein']))
                                                <div>Уураг - {{ $product['protein'] }} гр</div>
                                            @endif
                                            @if (!empty($product['fat']))
                                                <div>Тослог - {{ $product['fat'] }} гр</div>
                                            @endif
                                            @if (!empty($product['carbs']))
                                                <div>Нүүрс ус - {{ $product['carbs'] }} гр</div>
                                            @endif
                                        </dd>
                                    </div>
                                @endif

                                @if (!empty($product['shelf_life']))
                                    <div class="flex gap-2">
                                        <dt class="font-semibold text-gray-900 shrink-0">Хадгалах хугацаа:</dt>
                                        <dd class="text-gray-600">{{ $product['shelf_life'] }}</dd>
                                    </div>
                                @endif
                            </dl>

                            @if (!empty($product['price']))
                                <p class="text-3xl font-bold text-[#831518]">{{ number_format((float) $product['price']) }}₮</p>
                            @endif

                            <a href="/contact"
                                class="cursor-hover inline-flex items-center gap-2 bg-[#831518] text-slate-100 text-sm font-bold uppercase px-6 py-3 rounded-full hover:-translate-y-0.5 hover:shadow-lg transition-all">
                                Захиалга өгөх
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Related products --}}
        @if (!empty($related))
            <section class="bg-[#fbf6ef] font-ubuntu rounded-[2.5rem] md:rounded-[3rem] mx-3 md:mx-6 my-4 overflow-hidden">
                <div class="py-16 px-6 lg:px-20 space-y-10">
                    <x-section-heading eyebrow="Санал болгох" title="Ижил төстэй бүтээгдэхүүн" align="center" class="mx-auto max-w-2xl reveal" />

                    <div data-stagger="90" class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4 max-w-6xl mx-auto">
                        @foreach ($related as $i => $item)
                            <a href="/products/{{ $i }}"
                                class="product-card cursor-hover group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 reveal-scale">
                                @if (!empty($item['image']))
                                    <div class="img-zoom h-40">
                                        <img src="{{ \App\Models\ProductsPage::resolveMedia($item['image']) }}" alt="{{ $item['name'] ?? '' }}"
                                            loading="lazy" class="w-full h-full object-cover">
                                    </div>
                                @endif
                                <div class="p-5 space-y-1">
                                    <h3 class="text-base font-semibold text-gray-900">{{ $item['name'] ?? '' }}</h3>
                                    @if (!empty($item['price']))
                                        <p class="text-sm font-bold text-[#831518]">{{ number_format((float) $item['price']) }}₮</p>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endsection
</x-layout>
