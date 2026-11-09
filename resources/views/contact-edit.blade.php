<x-app-layout :contactData="$contactData" :title="$title">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard &raquo; Edit {{ $title }}
        </h2>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form method="POST" action="{{ route('contact.update') }}" enctype="multipart/form-data" class="space-y-6">
                            @csrf

                            {{-- FLASH MESSAGE --}}
                            @if (session('success'))
                                <div class="p-3 bg-green-100 text-green-700 border border-green-300 rounded">
                                    {{ session('success') }}
                                </div>
                            @endif

                            {{-- contact --}}
                            <div class="border rounded-xl bg-gray-50 p-5 space-y-5 shadow-sm">

                                <h3 class="text-xl font-semibold">📞 Contact</h3>

                                <div>
                                    <label class="block mb-1 font-medium">WhatsApp</label>
                                    <input type="text" name="whatsapp" class="w-full border p-3 rounded-lg"
                                        placeholder="0815-2155-0913"
                                        value="{{ old('whatsapp', $contactData->whatsapp ?? '') }}">
                                </div>

                                <div>
                                    <label class="block mb-1 font-medium">Email</label>
                                    <input type="email" name="email" class="w-full border p-3 rounded-lg"
                                        placeholder="email@example.com"
                                        value="{{ old('email', $contactData->email ?? '') }}">
                                </div>

                                <div>
                                    <label class="block mb-1 font-medium">Address</label>
                                    <textarea name="address" rows="3" class="w-full border p-3 rounded-lg"
                                        placeholder="Example: 123 Main Street">{{ old('address', $contactData->address ?? '') }}</textarea>
                                </div>

                                <div>
                                    <label class="block mb-1 font-medium">Working Hours</label>
                                    <input type="text" name="working_hours" class="w-full border p-3 rounded-lg"
                                        placeholder="08:00 - 20:00 WIB"
                                        value="{{ old('working_hours', $contactData->working_hours ?? '') }}">
                                </div>

                                <div>
                                    <label class="block mb-1 font-medium">Footer дэвсгэр зураг (дүүрэн)</label>
                                    @if (!empty($contactData->footer_background))
                                        <img src="{{ \App\Models\Contact::resolveMedia($contactData->footer_background) }}" class="h-24 w-full object-cover mb-2 rounded border">
                                    @endif
                                    <input type="file" name="footer_background" accept="image/*" class="w-full border p-2 rounded-lg">
                                    <small class="text-gray-500">Footer-ийн бүх дэвсгэрийг бүрхэх зураг. Хоосон орхивол одоогийн загвар хэвээр үлдэнэ.</small>
                                </div>

                            </div>

                            {{-- BUTTON --}}
                            <div class="pt-2 text-right">
                                <button type="submit"
                                    class="bg-blue-600 text-white px-5 py-2.5 rounded-lg shadow hover:bg-blue-700 transition">
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
