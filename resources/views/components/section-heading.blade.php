@props(['eyebrow' => null, 'title', 'align' => 'left', 'light' => false])

@php
    $alignClass = $align === 'center' ? 'items-center text-center mx-auto' : 'items-start text-left';
@endphp

<div {{ $attributes->merge(['class' => "flex flex-col $alignClass"]) }}>
    @if ($eyebrow)
        <span class="text-xs font-semibold uppercase tracking-[0.2em] {{ $light ? 'text-accent' : 'text-[#831518]' }} mb-2">
            {{ $eyebrow }}
        </span>
    @endif
    <h2 class="text-xl md:text-2xl font-bold uppercase leading-tight tracking-tight {{ $light ? 'text-slate-100' : 'text-gray-800' }}">
        {{ $title }}
    </h2>
    <span class="section-heading-bar block w-16 h-[3px] rounded-full bg-gradient-to-r from-[#831518] to-accent mt-4"></span>
</div>
