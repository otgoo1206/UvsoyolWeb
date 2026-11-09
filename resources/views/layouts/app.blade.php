<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://unpkg.com/alpinejs" defer></script>


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @if ($errors->any())
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                        <div class="p-4 bg-red-100 text-red-700 border border-red-300 rounded-lg">
                            <p class="font-semibold mb-1">⚠️ Хадгалахад алдаа гарлаа:</p>
                            <ul class="list-disc list-inside text-sm space-y-0.5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                {{ $slot }}
            </main>
        </div>



        {{-- Alpine helper --}}
        <script>
            function cardsEditor() {
                return {
                    cards: [],
                    init(initial) {
                        // Jika ada data lama/DB, pakai itu, kalau kosong, mulai 1 card kosong (opsional)
                        this.cards = Array.isArray(initial) && initial.length ? initial : [];
                    },
                    add(newCard) {
                        this.cards.push(newCard ?? { title: '', description: '' });
                    },
                    remove(i) {
                        this.cards.splice(i, 1);
                    },
                    resolveMedia(path) {
                        if (!path) return '';
                        if (path.startsWith('http')) return path;
                        return path.includes('/') ? `/storage/${path}` : `/images/${path}`;
                    }
                }
            }
        </script>
    </body>

</html>
