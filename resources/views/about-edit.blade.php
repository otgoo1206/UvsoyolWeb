<x-app-layout :title="$title" :tentangData="$tentangData">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard &raquo; Edit {{ $title }}
        </h2>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form method="POST" action="{{ route('about.update') }}" enctype="multipart/form-data" class="space-y-6">
                            @csrf

                            {{-- Flash Message --}}
                            @if (session('success'))
                                <div class="mb-4 p-3 rounded bg-green-100 text-green-700 border border-green-300">
                                    ✅ {{ session('success') }}
                                </div>
                            @endif

                            @php
                                $hero = $tentangData['hero_section']->value ?? [];
                                $videoSection = $tentangData['video_section']->value ?? [];
                                $pageBackground = $tentangData['page_background']->value ?? [];
                            @endphp

                            <div x-data="{ openSection: 1 }" class="space-y-5">

                                {{-- HERO SECTION --}}
                                <div class="border rounded-xl p-5 bg-gray-50">
                                    <button type="button"
                                        @click="openSection === 1 ? openSection = null : openSection = 1"
                                        class="flex justify-between items-center w-full text-left font-semibold text-gray-800 text-lg">
                                        <span>🏠 Hero Section</span>
                                        <span x-text="openSection === 1 ? '−' : '+'"></span>
                                    </button>

                                    <div x-show="openSection === 1" x-transition class="mt-4 space-y-4">

                                        <div>
                                            <label class="block font-medium mb-1">Гарчиг (Title)</label>
                                            <input type="text" name="hero_title"
                                                class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400"
                                                value="{{ old('hero_title', $hero['title'] ?? '') }}">
                                        </div>

                                        <div>
                                            <label class="block font-medium mb-1">Дэд гарчиг (Subtitle)</label>
                                            <input type="text" name="hero_subtitle"
                                                class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400"
                                                value="{{ old('hero_subtitle', $hero['subtitle'] ?? '') }}">
                                        </div>

                                        <div>
                                            <label class="block font-medium mb-1">Тайлбар</label>
                                            <textarea name="hero_description" rows="3" class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400">{{ old('hero_description', $hero['description'] ?? '') }}</textarea>
                                        </div>

                                        <div class="grid md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block font-medium mb-1">Дэвсгэр зураг</label>
                                                @if (!empty($hero['image']))
                                                    <img src="{{ \App\Models\About::resolveMedia($hero['image']) }}" class="h-20 mb-2 rounded border object-cover">
                                                @endif
                                                <input type="file" name="hero_image" accept="image/*" class="w-full border p-2 rounded">
                                                <small class="text-gray-500">Хоосон орхивол одоогийн зураг хэвээр үлдэнэ.</small>
                                            </div>
                                            <div>
                                                <label class="block font-medium mb-1">Дэвсгэр видео (заавал биш)</label>
                                                @if (!empty($hero['video']))
                                                    <video src="{{ \App\Models\About::resolveMedia($hero['video']) }}" class="h-20 mb-2 rounded border" muted></video>
                                                @endif
                                                <input type="file" name="hero_video" accept="video/*" class="w-full border p-2 rounded">
                                                <small class="text-gray-500">Оруулбал зурган дэвсгэрийн оронд видео тоглоно.</small>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                {{-- STRENGTHS / SKILLS SECTION --}}
                                <div class="border rounded-xl p-5 bg-gray-50" x-data="aboutRepeater()"
                                    x-init="init(@js(old('skills', $tentangData['skills']->value ?? [])))">

                                    <button type="button"
                                        @click="openSection === 2 ? openSection = null : openSection = 2"
                                        class="flex justify-between items-center w-full text-left font-semibold text-gray-800 text-lg">
                                        <span>💪 Бидний давуу тал</span>
                                        <span x-text="openSection === 2 ? '−' : '+'"></span>
                                    </button>

                                    <div x-show="openSection === 2" x-transition class="mt-4 space-y-4">

                                        <div class="flex justify-between items-center mb-3">
                                            <h4 class="font-semibold">Жагсаалт</h4>
                                            <button type="button" @click="add({name:'',percentage:''})"
                                                class="bg-blue-600 text-white text-sm px-3 py-1.5 rounded">
                                                + Нэмэх
                                            </button>
                                        </div>

                                        <template x-if="cards.length === 0">
                                            <p class="text-sm text-gray-500">Одоогоор хоосон байна.</p>
                                        </template>

                                        <template x-for="(skill,i) in cards" :key="i">
                                            <div class="border rounded-xl bg-white p-4 space-y-3">
                                                <div class="grid md:grid-cols-2 gap-4">
                                                    <div>
                                                        <label class="block font-medium mb-1">Нэр</label>
                                                        <input type="text" class="w-full border p-2 rounded"
                                                            :name="`skills[${i}][name]`" x-model="skill.name">
                                                    </div>
                                                    <div>
                                                        <label class="block font-medium mb-1">Хувь (%)</label>
                                                        <input type="number" class="w-full border p-2 rounded"
                                                            :name="`skills[${i}][percentage]`"
                                                            x-model="skill.percentage" min="0" max="100">
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="button" @click="remove(i)"
                                                        class="text-red-600 text-sm">Устгах</button>
                                                </div>
                                            </div>
                                        </template>

                                    </div>
                                </div>

                                {{-- COUNTERS SECTION --}}
                                <div class="border rounded-xl p-5 bg-gray-50" x-data="aboutRepeater()"
                                    x-init="init(@js(old('counters', $tentangData['counters']->value ?? [])))">

                                    <button type="button"
                                        @click="openSection === 3 ? openSection = null : openSection = 3"
                                        class="flex justify-between items-center w-full text-left font-semibold text-gray-800 text-lg">
                                        <span>🔢 Тоон үзүүлэлт</span>
                                        <span x-text="openSection === 3 ? '−' : '+'"></span>
                                    </button>

                                    <div x-show="openSection === 3" x-transition class="mt-4 space-y-4">

                                        <div class="flex justify-between items-center mb-3">
                                            <h4 class="font-semibold">Тоолуур</h4>
                                            <button type="button" @click="add({title:'',value:''})"
                                                class="bg-blue-600 text-white text-sm px-3 py-1.5 rounded">
                                                + Нэмэх
                                            </button>
                                        </div>

                                        <template x-for="(counter,i) in cards" :key="i">
                                            <div class="border rounded-xl p-4 bg-white space-y-3">
                                                <div class="grid md:grid-cols-2 gap-4">
                                                    <div>
                                                        <label class="block mb-1 font-medium">Гарчиг</label>
                                                        <input type="text" class="w-full border p-2 rounded"
                                                            :name="`counters[${i}][title]`" x-model="counter.title">
                                                    </div>
                                                    <div>
                                                        <label class="block mb-1 font-medium">Утга</label>
                                                        <input type="number" class="w-full border p-2 rounded"
                                                            :name="`counters[${i}][value]`" x-model="counter.value">
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="button" @click="remove(i)"
                                                        class="text-red-600 text-sm">Устгах</button>
                                                </div>
                                            </div>
                                        </template>

                                    </div>
                                </div>

                                {{-- TIMELINE SECTION --}}
                                <div class="border rounded-xl p-5 bg-gray-50" x-data="aboutRepeater()"
                                    x-init="init(@js(old('timeline', $tentangData['timeline']->value ?? [])))">

                                    <button type="button"
                                        @click="openSection === 4 ? openSection = null : openSection = 4"
                                        class="flex justify-between items-center w-full text-left font-semibold text-gray-800 text-lg">
                                        <span>🕰️ Түүхэн замнал (Timeline)</span>
                                        <span x-text="openSection === 4 ? '−' : '+'"></span>
                                    </button>

                                    <div x-show="openSection === 4" x-transition class="mt-4 space-y-4">

                                        <div class="flex justify-between items-center mb-3">
                                            <h4 class="font-semibold">Үе шат</h4>
                                            <button type="button" @click="add({year:'',title:'',description:'',image:''})"
                                                class="bg-blue-600 text-white text-sm px-3 py-1.5 rounded">
                                                + Үе шат нэмэх
                                            </button>
                                        </div>

                                        <template x-if="cards.length === 0">
                                            <p class="text-sm text-gray-500">Одоогоор хоосон байна.</p>
                                        </template>

                                        <template x-for="(item,i) in cards" :key="i">
                                            <div class="border rounded-xl p-4 bg-white space-y-3">
                                                <div class="grid md:grid-cols-3 gap-4">
                                                    <div>
                                                        <label class="block font-medium mb-1">Он</label>
                                                        <input type="text" class="w-full border p-2 rounded"
                                                            :name="`timeline[${i}][year]`" x-model="item.year">
                                                    </div>
                                                    <div class="md:col-span-2">
                                                        <label class="block font-medium mb-1">Гарчиг</label>
                                                        <input type="text" class="w-full border p-2 rounded"
                                                            :name="`timeline[${i}][title]`" x-model="item.title">
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block font-medium mb-1">Тайлбар</label>
                                                    <textarea class="w-full border p-2 rounded" rows="2"
                                                        :name="`timeline[${i}][description]`" x-model="item.description"></textarea>
                                                </div>
                                                <div>
                                                    <label class="block font-medium mb-1">Зураг</label>
                                                    <template x-if="item.image">
                                                        <img :src="resolveMedia(item.image)" class="h-16 mb-2 rounded border object-cover">
                                                    </template>
                                                    <input type="file" accept="image/*" class="w-full border p-2 rounded"
                                                        :name="`timeline[${i}][image]`">
                                                </div>
                                                <div class="text-right">
                                                    <button type="button" @click="remove(i)"
                                                        class="text-red-600 text-sm">Устгах</button>
                                                </div>
                                            </div>
                                        </template>

                                    </div>
                                </div>

                                {{-- GALLERY SECTION --}}
                                <div class="border rounded-xl p-5 bg-gray-50" x-data="aboutRepeater()"
                                    x-init="init(@js(old('gallery', $tentangData['gallery']->value ?? [])))">

                                    <button type="button"
                                        @click="openSection === 5 ? openSection = null : openSection = 5"
                                        class="flex justify-between items-center w-full text-left font-semibold text-gray-800 text-lg">
                                        <span>🖼️ Зургийн цомог (Gallery)</span>
                                        <span x-text="openSection === 5 ? '−' : '+'"></span>
                                    </button>

                                    <div x-show="openSection === 5" x-transition class="mt-4 space-y-4">

                                        <div class="flex justify-between items-center mb-3">
                                            <h4 class="font-semibold">Зураг</h4>
                                            <button type="button" @click="add({image:'',caption:''})"
                                                class="bg-blue-600 text-white text-sm px-3 py-1.5 rounded">
                                                + Зураг нэмэх
                                            </button>
                                        </div>

                                        <div class="grid md:grid-cols-2 gap-4">
                                            <template x-for="(item,i) in cards" :key="i">
                                                <div class="border rounded-xl p-4 bg-white space-y-3">
                                                    <template x-if="item.image">
                                                        <img :src="resolveMedia(item.image)" class="h-20 mb-2 rounded border object-cover w-full">
                                                    </template>
                                                    <input type="file" accept="image/*" class="w-full border p-2 rounded"
                                                        :name="`gallery[${i}][image]`">
                                                    <input type="text" placeholder="Тайлбар (caption)" class="w-full border p-2 rounded"
                                                        :name="`gallery[${i}][caption]`" x-model="item.caption">
                                                    <div class="text-right">
                                                        <button type="button" @click="remove(i)"
                                                            class="text-red-600 text-sm">Устгах</button>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>

                                    </div>
                                </div>

                                {{-- VIDEO SECTION --}}
                                <div class="border rounded-xl p-5 bg-gray-50">
                                    <button type="button"
                                        @click="openSection === 6 ? openSection = null : openSection = 6"
                                        class="flex justify-between items-center w-full text-left font-semibold text-gray-800 text-lg">
                                        <span>🎬 Үйлдвэрлэлийн видео</span>
                                        <span x-text="openSection === 6 ? '−' : '+'"></span>
                                    </button>

                                    <div x-show="openSection === 6" x-transition class="mt-4 space-y-4">

                                        <div>
                                            <label class="block font-medium mb-1">Гарчиг</label>
                                            <input type="text" name="video_title"
                                                class="w-full border p-2 rounded"
                                                value="{{ old('video_title', $videoSection['title'] ?? '') }}">
                                        </div>

                                        <div>
                                            <label class="block font-medium mb-1">Тайлбар</label>
                                            <textarea name="video_description" rows="2" class="w-full border p-2 rounded">{{ old('video_description', $videoSection['description'] ?? '') }}</textarea>
                                        </div>

                                        <div class="grid md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block font-medium mb-1">Видео файл</label>
                                                @if (!empty($videoSection['video']))
                                                    <video src="{{ \App\Models\About::resolveMedia($videoSection['video']) }}" class="h-20 mb-2 rounded border" controls></video>
                                                @endif
                                                <input type="file" name="video_file" accept="video/*" class="w-full border p-2 rounded">
                                            </div>
                                            <div>
                                                <label class="block font-medium mb-1">Тавцан зураг (poster)</label>
                                                @if (!empty($videoSection['poster']))
                                                    <img src="{{ \App\Models\About::resolveMedia($videoSection['poster']) }}" class="h-20 mb-2 rounded border object-cover">
                                                @endif
                                                <input type="file" name="video_poster" accept="image/*" class="w-full border p-2 rounded">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="border rounded-xl p-5 bg-gray-50">
                                    <button type="button"
                                        @click="openSection === 7 ? openSection = null : openSection = 7"
                                        class="flex justify-between items-center w-full text-left font-semibold text-gray-800 text-lg">
                                        <span>🖼️ Хуудасны дэвсгэр зураг</span>
                                        <span x-text="openSection === 7 ? '−' : '+'"></span>
                                    </button>

                                    <div x-show="openSection === 7" x-transition class="mt-4 space-y-4">
                                        <div>
                                            <label class="block font-medium mb-1">Дэвсгэр зураг (бүх хуудасны цаана)</label>
                                            @if (!empty($pageBackground['image']))
                                                <img src="{{ \App\Models\About::resolveMedia($pageBackground['image']) }}" class="h-24 w-full object-cover mb-2 rounded border">
                                            @endif
                                            <input type="file" name="page_background" accept="image/*" class="w-full border p-2 rounded">
                                            <small class="text-gray-500">Хэсгүүдийн хоорондох зайд харагдана. Хоосон орхивол одоогийн загвар хэвээр үлдэнэ.</small>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            {{-- Save Button --}}
                            <div class="text-right">
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-lg shadow">
                                    💾 Save Changes
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>

<script>
    function aboutRepeater() {
        return {
            cards: [],
            init(data) {
                this.cards = Array.isArray(data) ? data : [];
            },
            add(newItem) {
                this.cards.push(newItem);
            },
            remove(index) {
                this.cards.splice(index, 1);
            },
            resolveMedia(path) {
                if (!path) return '';
                if (path.startsWith('http')) {
                    return path;
                }
                // Uploads are stored under about/* on the public disk;
                // anything else is a plain filename seeded under public/images.
                return path.startsWith('about/') ? `/storage/${path}` : `/images/${path}`;
            }
        }
    }
</script>
