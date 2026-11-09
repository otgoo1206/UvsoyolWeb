<x-app-layout :mediaData="$mediaData" :title="$title">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard &raquo; Edit {{ $title }}
        </h2>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form method="POST" action="{{ route('media.update') }}" enctype="multipart/form-data" class="space-y-6">
                            @csrf

                            @if (session('success'))
                                <div class="mb-4 p-3 rounded bg-green-100 text-green-700 border border-green-300">
                                    ✅ {{ session('success') }}
                                </div>
                            @endif

                            <div>
                                <label class="block font-medium mb-1">Хэсгийн гарчиг</label>
                                <input type="text" name="hero_h2" class="w-full border p-2 rounded"
                                    value="{{ old('hero_h2', $mediaData->hero_h2) }}">
                            </div>

                            <div class="border rounded-xl p-5 bg-gray-50" x-data="repeaterEditor()"
                                x-init="init(@js(old('videos', $mediaData->videos ?? [])))">

                                <div class="flex justify-between items-center mb-3">
                                    <h4 class="font-semibold">🎬 Видео жагсаалт</h4>
                                    <button type="button" @click="add({title:'',description:'',video:'',poster:''})"
                                        class="bg-blue-600 text-white text-sm px-3 py-1.5 rounded">
                                        + Видео нэмэх
                                    </button>
                                </div>

                                <template x-if="items.length === 0">
                                    <p class="text-sm text-gray-500">Одоогоор хоосон байна.</p>
                                </template>

                                <div class="space-y-4">
                                    <template x-for="(item, i) in items" :key="i">
                                        <div class="border rounded-xl bg-white p-4 space-y-3">
                                            <div>
                                                <label class="block mb-1 font-medium">Гарчиг</label>
                                                <input type="text" class="w-full border p-2 rounded"
                                                    :name="`videos[${i}][title]`" x-model="item.title">
                                            </div>

                                            <div>
                                                <label class="block mb-1 font-medium">Тайлбар</label>
                                                <textarea class="w-full border p-2 rounded" rows="2"
                                                    :name="`videos[${i}][description]`" x-model="item.description"></textarea>
                                            </div>

                                            <div class="grid md:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block mb-1 font-medium">Видео файл</label>
                                                    <template x-if="item.video">
                                                        <video :src="resolveMedia(item.video)" class="h-16 mb-2 rounded border" controls></video>
                                                    </template>
                                                    <input type="file" accept="video/*" class="w-full border p-2 rounded"
                                                        :name="`videos[${i}][video]`">
                                                </div>
                                                <div>
                                                    <label class="block mb-1 font-medium">Тавцан зураг (poster)</label>
                                                    <template x-if="item.poster">
                                                        <img :src="resolveMedia(item.poster)" class="h-16 mb-2 rounded border object-cover">
                                                    </template>
                                                    <input type="file" accept="image/*" class="w-full border p-2 rounded"
                                                        :name="`videos[${i}][poster]`">
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
    function repeaterEditor() {
        return {
            items: [],
            init(data) {
                this.items = Array.isArray(data) ? data : [];
            },
            add(newItem) {
                this.items.push(newItem);
            },
            remove(index) {
                this.items.splice(index, 1);
            },
            resolveMedia(path) {
                if (!path) return '';
                if (path.startsWith('http')) return path;
                return path.includes('/') ? `/storage/${path}` : `/images/${path}`;
            }
        }
    }
</script>
