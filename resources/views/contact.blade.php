<x-layout :title="$title" :activePage="$activePage">
    @section('page')
        @php
            $waDigits = preg_replace('/\D/', '', $contact->whatsapp ?? '');
            // Mongolian mobile numbers are 8 digits with no area code, so a
            // string-prefix check for "976" is unreliable — local numbers
            // starting with 976 (e.g. 9769-xxxx) would collide with the
            // country code. Length is the reliable signal instead.
            $waIntl = $waDigits ? (strlen($waDigits) > 8 ? $waDigits : '976' . $waDigits) : null;
            $waHref = $waDigits ? 'https://wa.me/' . $waIntl : null;
            $mapQuery = !empty($contact->address) ? 'https://www.google.com/maps/search/?api=1&query=' . urlencode($contact->address) : null;
        @endphp

        {{-- Compact header --}}
        <header class="relative h-[28vh] min-h-[200px] overflow-hidden font-ubuntu mx-3 md:mx-6 mt-3 md:mt-4 rounded-[2.5rem] md:rounded-[3rem]">
            <img src="{{ asset('images/contactBuild.jpeg') }}" alt="Холбоо барих"
                class="absolute inset-0 w-full h-full object-cover animate-ken-burns">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/20 to-black/5"></div>
            <x-flowing-blobs variant="dark" />

            <div class="relative h-full flex flex-col justify-center pl-6 md:pl-16 space-y-2 text-slate-100">
                <span class="inline-block w-fit uppercase tracking-[0.3em] text-xs md:text-sm text-[#e0a9a9] font-semibold">
                    Бидэнтэй холбогдоорой
                </span>
                <h1 class="text-2xl md:text-4xl font-extrabold uppercase leading-tight">Холбоо барих</h1>
                <span class="block w-16 h-[3px] rounded-full bg-gradient-to-r from-[#831518] to-accent"></span>
            </div>
        </header>

        {{-- Info + Form + Map --}}
        <section class="bg-white font-ubuntu rounded-[2.5rem] md:rounded-[3rem] mx-3 md:mx-6 my-4 overflow-hidden">
            <div class="py-16 px-6 lg:px-16">
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 max-w-6xl mx-auto">

                    {{-- Contact info + map --}}
                    <div class="lg:col-span-2 space-y-5 reveal">
                        <div data-stagger="90" class="grid grid-cols-2 gap-3">
                            <a href="{{ $waHref ?? '#' }}" target="_blank" rel="noopener"
                                class="card-interactive reveal-scale cursor-hover flex flex-col gap-2 p-4 bg-[#fbf6ef] rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    class="w-6 h-6 text-[#831518]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.125 1.125 0 00-1.173.417l-.97 1.293c-2.331-1.157-4.226-3.052-5.383-5.383l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102A1.125 1.125 0 005.872 2.25H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                                <div>
                                    <h5 class="font-semibold text-gray-900 text-xs uppercase tracking-wide">WhatsApp</h5>
                                    <p class="text-gray-600 text-sm mt-0.5 truncate">{{ $contact->whatsapp ?? '-' }}</p>
                                </div>
                            </a>

                            <a href="mailto:{{ $contact->email ?? '' }}"
                                class="card-interactive reveal-scale cursor-hover flex flex-col gap-2 p-4 bg-[#fbf6ef] rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    class="w-6 h-6 text-[#831518]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                                <div>
                                    <h5 class="font-semibold text-gray-900 text-xs uppercase tracking-wide">Имэйл</h5>
                                    <p class="text-gray-600 text-sm mt-0.5 truncate">{{ $contact->email ?? '-' }}</p>
                                </div>
                            </a>

                            <a href="{{ $mapQuery ?? '#' }}" target="_blank" rel="noopener"
                                class="card-interactive reveal-scale cursor-hover flex flex-col gap-2 p-4 bg-[#fbf6ef] rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    class="w-6 h-6 text-[#831518]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <div>
                                    <h5 class="font-semibold text-gray-900 text-xs uppercase tracking-wide">Хаяг</h5>
                                    <p class="text-gray-600 text-sm mt-0.5 line-clamp-2">{{ $contact->address ?? '-' }}</p>
                                </div>
                            </a>

                            <div class="reveal-scale flex flex-col gap-2 p-4 bg-[#fbf6ef] rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    class="w-6 h-6 text-[#831518]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 100-18 9 9 0 000 18z" />
                                </svg>
                                <div>
                                    <h5 class="font-semibold text-gray-900 text-xs uppercase tracking-wide">Ажлын цаг</h5>
                                    <p class="text-gray-600 text-sm mt-0.5 truncate">{{ $contact->working_hours ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="reveal-scale rounded-xl overflow-hidden shadow-md border border-gray-100">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2674.097133877803!2d106.80725371152461!3d47.91515796650002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5d96ed6c84102c13%3A0xb211d8731b274be6!2z06jQkiDQodCe0IHQmyDSrtCZ0JvQlNCS0K3QoCDQpdCl0Jo!5e0!3m2!1sen!2smn!4v1786517462055!5m2!1sen!2smn"
                                class="h-48 w-full block" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="strict-origin-when-cross-origin"></iframe>
                        </div>
                    </div>

                    {{-- Message form --}}
                    <div class="lg:col-span-3 reveal-scale">
                        <div class="bg-[#fbf6ef] border border-gray-100 rounded-2xl shadow-sm p-6 md:p-8 h-full">
                            <h2 class="text-lg font-extrabold uppercase text-gray-900 mb-1">Мессеж илгээх</h2>
                            <span class="block w-12 h-[3px] rounded-full bg-gradient-to-r from-[#831518] to-accent mb-6"></span>

                            <form class="w-full grid sm:grid-cols-2 gap-x-5" name="submit-to-google-sheet" data-whatsapp="{{ $waIntl }}">
                                <div class="relative z-0 w-full mb-6 group">
                                    <input type="text" name="nama" id="nama"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#831518] peer"
                                        placeholder=" " required />
                                    <label for="nama"
                                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[#831518] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Нэр</label>
                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <input type="email" name="email" id="email"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#831518] peer"
                                        placeholder=" " required />
                                    <label for="email"
                                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[#831518] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Имэйл</label>
                                </div>
                                <div class="relative z-0 w-full mb-6 group sm:col-span-2">
                                    <input type="text" name="judul" id="judul"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#831518] peer"
                                        placeholder=" " required />
                                    <label for="judul"
                                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[#831518] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Сэдэв</label>
                                </div>
                                <div class="relative z-0 w-full mb-8 group sm:col-span-2">
                                    <input type="text" name="pesan" id="pesan"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#831518] peer"
                                        placeholder=" " required />
                                    <label for="pesan"
                                        class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-[#831518] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Зурвас</label>
                                </div>
                                <button type="submit"
                                    class="cursor-hover sm:col-span-2 inline-flex items-center justify-center gap-2 bg-[#831518] text-slate-100 text-sm font-bold uppercase px-8 py-3 rounded-full hover:-translate-y-0.5 hover:shadow-lg transition-all">
                                    Илгээх
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
</x-layout>
