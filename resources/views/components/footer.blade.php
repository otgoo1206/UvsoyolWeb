@php
    $footerContact = \App\Models\Contact::first();
    $footerWaDigits = preg_replace('/\D/', '', $footerContact->whatsapp ?? '');
    $footerWaIntl = $footerWaDigits ? (strlen($footerWaDigits) > 8 ? $footerWaDigits : '976' . $footerWaDigits) : null;
    if (!empty($footerContact->footer_background)) {
        $footerPatternUrl = \App\Models\Contact::resolveMedia($footerContact->footer_background);
    } else {
        $footerPatternPath = public_path('images/footer-pattern.png');
        $footerPatternUrl = file_exists($footerPatternPath) ? asset('images/footer-pattern.png') : null;
    }
@endphp
<footer class="relative overflow-hidden font-ubuntu rounded-[2.5rem] md:rounded-[3.5rem] mx-3 md:mx-6 mt-3 md:mt-6 mb-3 md:mb-6" style="background-color: #831518;">
    @if ($footerPatternUrl)
        <img src="{{ $footerPatternUrl }}" alt="" aria-hidden="true"
            class="pointer-events-none select-none absolute inset-0 w-full h-full object-cover opacity-70">
    @endif

    <div class="relative mx-auto max-w-screen-xl space-y-10 px-4 pt-16 pb-7 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-10 lg:grid-cols-4">
            {{-- Brand + social --}}
            <div>
                <div class="text-slate-100 font-poppins flex items-center gap-x-4">
                    <img src="{{ asset('images/uvsoyol.jpg') }}" alt="" class="h-16 rounded-full ring-2 ring-accent" />
                    <h1 class="notranslate brand-name font-semibold text-2xl" translate="no" data-mn="Өв Соёл ХХК" data-en="UvSoyol LLC">Өв Соёл ХХК</h1>
                </div>
                <p class="mt-4 max-w-xs text-slate-100/90 text-sm"><span class="notranslate brand-name" translate="no" data-mn="Өв Соёл ХХК" data-en="UvSoyol LLC">Өв Соёл ХХК</span> -д тавтай морилно уу.</p>

                <ul class="mt-6 flex gap-3">
                    <li>
                        <a href="https://www.facebook.com/profile.php?id=61550548845158" rel="noreferrer" target="_blank"
                            class="cursor-hover w-9 h-9 rounded-full bg-white text-[#831518] hover:bg-[var(--color-accent)] flex items-center justify-center hover:-translate-y-0.5 transition-all">
                            <span class="sr-only">Facebook</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/uvsoyolofficial" rel="noreferrer" target="_blank"
                            class="cursor-hover w-9 h-9 rounded-full bg-white text-[#831518] hover:bg-[var(--color-accent)] flex items-center justify-center hover:-translate-y-0.5 transition-all">
                            <span class="sr-only">Instagram</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" rel="noreferrer" target="_blank"
                            class="cursor-hover w-9 h-9 rounded-full bg-white text-[#831518] hover:bg-[var(--color-accent)] flex items-center justify-center hover:-translate-y-0.5 transition-all">
                            <span class="sr-only">YouTube</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M21.582 7.186a2.51 2.51 0 00-1.768-1.778C18.254 5 12 5 12 5s-6.254 0-7.814.408a2.51 2.51 0 00-1.768 1.778C2 8.756 2 12 2 12s0 3.244.418 4.814a2.51 2.51 0 001.768 1.778C5.746 19 12 19 12 19s6.254 0 7.814-.408a2.51 2.51 0 001.768-1.778C22 15.244 22 12 22 12s0-3.244-.418-4.814zM10 15.5v-7l6 3.5-6 3.5z" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- БИДНИЙ ТУХАЙ --}}
            <div>
                <p class="font-semibold text-slate-100 text-lg uppercase tracking-wide">Бидний тухай</p>
                <ul class="mt-4 space-y-1 text-sm font-poppins">
                    <li><a href="/about" class="block py-1.5 text-slate-100/90 hover:text-accent transition">Компанийн танилцуулга</a></li>
                    <li><a href="/about#production" class="block py-1.5 text-slate-100/90 hover:text-accent transition">Үйлдвэрлэлийн үйл явц</a></li>
                    <li><a href="/products" class="block py-1.5 text-slate-100/90 hover:text-accent transition">Бүтээгдэхүүн</a></li>
                    <li><a href="/news" class="block py-1.5 text-slate-100/90 hover:text-accent transition">Мэдээ мэдээлэл</a></li>
                    <li><a href="/contact" class="block py-1.5 text-slate-100/90 hover:text-accent transition">Холбоо барих</a></li>
                </ul>
            </div>

            {{-- ТҮРГЭН ХОЛБООС --}}
            <div>
                <p class="font-semibold text-slate-100 text-lg uppercase tracking-wide">Түргэн холбоос</p>
                <ul class="mt-4 space-y-1 text-sm font-poppins">
                    <li><a href="/news" class="block py-1.5 text-slate-100/90 hover:text-accent transition">Мэдээ мэдээлэл</a></li>
                    <li><a href="/products" class="block py-1.5 text-slate-100/90 hover:text-accent transition">Бүтээгдэхүүн</a></li>
                    <li><a href="/about#production" class="block py-1.5 text-slate-100/90 hover:text-accent transition">Үйлдвэрлэл</a></li>
                </ul>
            </div>

            {{-- ХОЛБОО БАРИХ --}}
            <div>
                <p class="font-semibold text-slate-100 text-lg uppercase tracking-wide">Холбоо барих</p>
                <ul class="mt-4 space-y-3 text-sm font-poppins">
                    <li class="flex items-start gap-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="h-5 w-5 shrink-0 mt-0.5 text-accent">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        <span class="text-slate-100/90">{{ $footerContact->address ?? 'Монгол улс, Улаанбаатар хот, СонгиноХайрхан дүүрэг' }}</span>
                    </li>

                    <li class="flex items-center gap-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="h-5 w-5 shrink-0 text-accent">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.125 1.125 0 00-1.173.417l-.97 1.293c-2.331-1.157-4.226-3.052-5.383-5.383l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102A1.125 1.125 0 005.872 2.25H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                        </svg>
                        <a href="{{ $footerWaIntl ? 'https://wa.me/' . $footerWaIntl : '#' }}" target="_blank"
                            class="text-slate-100/90 hover:text-accent transition">{{ $footerContact->whatsapp ?? '-' }}</a>
                    </li>

                    @if (!empty($footerContact->email))
                        <li class="flex items-center gap-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="h-5 w-5 shrink-0 text-accent">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            <a href="mailto:{{ $footerContact->email }}" class="text-slate-100/90 hover:text-accent transition">{{ $footerContact->email }}</a>
                        </li>
                    @endif
                </ul>

                {{-- Newsletter signup --}}
                <form class="mt-5" name="newsletter-signup">
                    <label for="footer-email" class="text-xs uppercase tracking-wide text-slate-100/70">Мэдээлэл авах</label>
                    <div class="mt-2 flex gap-2">
                        <input type="email" id="footer-email" name="email" placeholder="Имэйл хаяг"
                            class="w-full rounded-md border-0 px-3 py-2 text-sm text-gray-900 focus:ring-2 focus:ring-accent" required />
                        <button type="submit"
                            class="cursor-hover shrink-0 bg-accent text-[#831518] text-sm font-bold uppercase px-4 py-2 rounded-md hover:brightness-95 transition">
                            Илгээх
                        </button>
                    </div>
                    <div id="success-message"
                        class="hidden items-center gap-2 mt-3 text-xs text-slate-100 bg-white/10 rounded-md p-3"
                        role="alert">
                        <span>✅ Амжилттай бүртгэгдлээ!</span>
                    </div>
                </form>
            </div>
        </div>

        <p class="text-sm text-slate-100/80 font-poppins border-t border-white/10 pt-6">&copy; 2026. <span class="notranslate brand-name" translate="no" data-mn="Өв Соёл ХХК" data-en="UvSoyol LLC">Өв Соёл ХХК</span>. Бүх эрх хуулиар хамгаалагдсан.</p>
    </div>
</footer>
