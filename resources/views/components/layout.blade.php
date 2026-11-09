<!doctype html>
<html lang="mn">
@props([
    'title' => '',
    'activePage' => '',
    'indexData' => null,
])

<x-head :title="$title"></x-head>

<body class="bg-white">
    <x-nav-bar 
        :activePage="$activePage" 
        :indexData="$indexData">
    </x-nav-bar>

    @yield('page')

    <x-end-body></x-end-body>

    <x-footer :activePage="$activePage"></x-footer>
</body>

</html>
