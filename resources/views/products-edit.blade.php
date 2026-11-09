<x-app-layout :productsData="$productsData" :title="$title">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard &raquo; Edit {{ $title }}
        </h2>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form method="POST" action="{{ route('products.update') }}" enctype="multipart/form-data" class="space-y-6">
                            @csrf

                            {{-- Flash Message --}}
                            @if (session('success'))
                                <div class="mb-4 p-3 rounded bg-green-100 text-green-700 border border-green-300">
                                    ✅ {{ session('success') }}
                                </div>
                            @endif

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
                                            <input type="text" name="hero_h1" class="w-full border p-2 rounded"
                                                value="{{ old('hero_h1', $productsData->hero_h1) }}">
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-1">Дэд гарчиг (Subtitle)</label>
                                            <input type="text" name="hero_h2" class="w-full border p-2 rounded"
                                                value="{{ old('hero_h2', $productsData->hero_h2) }}">
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-1">Тайлбар</label>
                                            <textarea name="hero_p" rows="3" class="w-full border p-2 rounded">{{ old('hero_p', $productsData->hero_p) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                {{-- PRODUCTS SECTION --}}
                                <div class="border rounded-xl p-5 bg-gray-50" x-data="productsRepeater()"
                                    x-init="init(@js(old('products', $productsData->products ?? [])))">

                                    <button type="button"
                                        @click="openSection === 2 ? openSection = null : openSection = 2"
                                        class="flex justify-between items-center w-full text-left font-semibold text-gray-800 text-lg">
                                        <span>🍰 Бүтээгдэхүүн</span>
                                        <span x-text="openSection === 2 ? '−' : '+'"></span>
                                    </button>

                                    <div x-show="openSection === 2" x-transition class="mt-4 space-y-4">

                                        <div class="flex justify-between items-center mb-3">
                                            <h4 class="font-semibold">Жагсаалт</h4>
                                            <button type="button" @click="add({name:'',category:'',description:'',price:'',image:'',weight:'',ingredients:'',calories:'',protein:'',fat:'',carbs:'',shelf_life:''})"
                                                class="bg-blue-600 text-white text-sm px-3 py-1.5 rounded">
                                                + Бүтээгдэхүүн нэмэх
                                            </button>
                                        </div>

                                        <template x-if="items.length === 0">
                                            <p class="text-sm text-gray-500">Одоогоор хоосон байна.</p>
                                        </template>

                                        <div class="space-y-4">
                                            <template x-for="(item, i) in items" :key="i">
                                                <div class="border rounded-xl bg-white p-4 space-y-3">
                                                    <div class="grid md:grid-cols-2 gap-4">
                                                        <div>
                                                            <label class="block mb-1 font-medium">Нэр</label>
                                                            <input type="text" class="w-full border p-2 rounded"
                                                                :name="`products[${i}][name]`" x-model="item.name">
                                                        </div>
                                                        <div>
                                                            <label class="block mb-1 font-medium">Ангилал</label>
                                                            <input type="text" class="w-full border p-2 rounded"
                                                                placeholder="Жишээ: Нарийн боов"
                                                                :name="`products[${i}][category]`" x-model="item.category">
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <label class="block mb-1 font-medium">Тайлбар</label>
                                                        <textarea class="w-full border p-2 rounded" rows="2"
                                                            :name="`products[${i}][description]`" x-model="item.description"></textarea>
                                                    </div>

                                                    <div class="grid md:grid-cols-2 gap-4">
                                                        <div>
                                                            <label class="block mb-1 font-medium">Үнэ (₮)</label>
                                                            <input type="number" class="w-full border p-2 rounded"
                                                                :name="`products[${i}][price]`" x-model="item.price">
                                                        </div>
                                                        <div>
                                                            <label class="block mb-1 font-medium">Зураг</label>
                                                            <template x-if="item.image">
                                                                <img :src="resolveMedia(item.image)" class="h-16 mb-2 rounded border object-cover">
                                                            </template>
                                                            <input type="file" accept="image/*" class="w-full border p-2 rounded"
                                                                :name="`products[${i}][image]`">
                                                        </div>
                                                    </div>

                                                    <div class="grid md:grid-cols-2 gap-4">
                                                        <div>
                                                            <label class="block mb-1 font-medium">Жин (жишээ: 0.5 кг)</label>
                                                            <input type="text" class="w-full border p-2 rounded"
                                                                :name="`products[${i}][weight]`" x-model="item.weight">
                                                        </div>
                                                        <div>
                                                            <label class="block mb-1 font-medium">Хадгалах хугацаа (жишээ: 30 хоног)</label>
                                                            <input type="text" class="w-full border p-2 rounded"
                                                                :name="`products[${i}][shelf_life]`" x-model="item.shelf_life">
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <label class="block mb-1 font-medium">Орц найрлага</label>
                                                        <textarea class="w-full border p-2 rounded" rows="2"
                                                            placeholder="Жишээ: Буудайн гурил, элсэн чихэр, шар тос, сийрэгжүүлэгч, цэвэр ус."
                                                            :name="`products[${i}][ingredients]`" x-model="item.ingredients"></textarea>
                                                    </div>

                                                    <div>
                                                        <label class="block mb-1 font-medium">Тэжээллэг чанар (100 гр-д)</label>
                                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                                            <div>
                                                                <label class="block mb-1 text-xs text-gray-500">Илчлэг (ккал)</label>
                                                                <input type="text" class="w-full border p-2 rounded"
                                                                    :name="`products[${i}][calories]`" x-model="item.calories">
                                                            </div>
                                                            <div>
                                                                <label class="block mb-1 text-xs text-gray-500">Уураг (гр)</label>
                                                                <input type="text" class="w-full border p-2 rounded"
                                                                    :name="`products[${i}][protein]`" x-model="item.protein">
                                                            </div>
                                                            <div>
                                                                <label class="block mb-1 text-xs text-gray-500">Тослог (гр)</label>
                                                                <input type="text" class="w-full border p-2 rounded"
                                                                    :name="`products[${i}][fat]`" x-model="item.fat">
                                                            </div>
                                                            <div>
                                                                <label class="block mb-1 text-xs text-gray-500">Нүүрс ус (гр)</label>
                                                                <input type="text" class="w-full border p-2 rounded"
                                                                    :name="`products[${i}][carbs]`" x-model="item.carbs">
                                                            </div>
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
    function productsRepeater() {
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
                return path.startsWith('products/') ? `/storage/${path}` : `/images/${path}`;
            }
        }
    }
</script>
