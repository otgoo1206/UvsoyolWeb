@props(['variant' => 'dark'])

<div class="blob-field parallax" data-parallax-speed="0.08" aria-hidden="true">
    <div class="blob blob-a {{ $variant === 'light' ? 'blob-maroon' : 'blob-cream' }}"
        style="width: 22rem; height: 22rem; top: -6rem; left: -4rem;"></div>
    <div class="blob blob-b {{ $variant === 'light' ? 'blob-cream' : 'blob-maroon' }}"
        style="width: 18rem; height: 18rem; bottom: -5rem; right: -3rem;"></div>
</div>
