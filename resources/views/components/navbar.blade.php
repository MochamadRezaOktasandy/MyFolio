<header x-data="{ mobileMenuOpen: false }"
    class="sticky top-0 z-50 backdrop-blur-md bg-white/80 dark:bg-slate-900/80 border-b border-slate-200 dark:border-slate-800 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

        <!-- Logo / Brand -->
        <a href="{{ route('home') }}"
            class="font-extrabold text-xl tracking-tight text-slate-900 dark:text-white flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-brand-500 inline-block animate-pulse"></span>
            <span>Dev<span class="text-brand-500">Portfolio</span></span>
        </a>

        <!-- Desktop Navigation Links -->
        <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600 dark:text-slate-300">
            <a href="{{ route('home') }}#about" class="hover:text-brand-500 transition">Tentang</a>
            <a href="{{ route('home') }}#skills" class="hover:text-brand-500 transition">Keahlian</a>
            <a href="{{ route('projects.index') }}" class="hover:text-brand-500 transition">Project</a>
            <a href="{{ route('certificates.index') }}" class="hover:text-brand-500 transition">Sertifikat</a>
            <a href="{{ route('home') }}#experience" class="hover:text-brand-500 transition">Pengalaman</a>
            <a href="{{ route('home') }}#contact" class="hover:text-brand-500 transition">Kontak</a>
        </nav>

        <!-- Right Side: Dark Mode Toggle & CTA -->
        <div class="flex items-center gap-3">
            <!-- Theme Toggle Button -->
            <button x-data="{
                    darkMode: localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
                    toggleTheme() {
                        this.darkMode = !this.darkMode;
                        if (this.darkMode) {
                            document.documentElement.classList.add('dark');
                            localStorage.setItem('color-theme', 'dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                            localStorage.setItem('color-theme', 'light');
                        }
                    }
                }" @click="toggleTheme()"
                class="p-2 rounded-lg text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none transition"
                title="Ganti Tema">
                <svg x-show="darkMode" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" />
                </svg>
                <svg x-show="!darkMode" class="w-5 h-5 text-slate-700" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
            </button>

            <a href="#contact"
                class="hidden sm:inline-flex items-center justify-center px-4 py-2 text-xs font-semibold uppercase tracking-wider text-white bg-slate-900 dark:bg-brand-600 rounded-lg hover:bg-slate-800 dark:hover:bg-brand-700 transition shadow-sm">
                Hubungi Saya
            </a>

            <!-- Mobile Menu Toggle Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="md:hidden p-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Drawer -->
    <div x-show="mobileMenuOpen" x-transition
        class="md:hidden border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-4 pt-2 pb-4 space-y-2">
        <a @click="mobileMenuOpen = false" href="{{ route('home') }}#about"
            class="block px-3 py-2 rounded-md text-base font-medium hover:bg-slate-100 dark:hover:bg-slate-800">Tentang</a>
        <a @click="mobileMenuOpen = false" href="{{ route('home') }}#skills"
            class="block px-3 py-2 rounded-md text-base font-medium hover:bg-slate-100 dark:hover:bg-slate-800">Keahlian</a>
        <a @click="mobileMenuOpen = false" href="{{ route('projects.index') }}"
            class="block px-3 py-2 rounded-md text-base font-medium hover:bg-slate-100 dark:hover:bg-slate-800">Project</a>
        <a @click="mobileMenuOpen = false" href="{{ route('home') }}#experience"
            class="block px-3 py-2 rounded-md text-base font-medium hover:bg-slate-100 dark:hover:bg-slate-800">Pengalaman</a>
        <a @click="mobileMenuOpen = false" href="{{ route('home') }}#contact"
            class="block px-3 py-2 rounded-md text-base font-medium hover:bg-slate-100 dark:hover:bg-slate-800">Kontak</a>

        <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600 dark:text-slate-300">
            <a href="{{ route('home') }}#about" class="hover:text-brand-500 transition">Tentang</a>
            <a href="{{ route('home') }}#skills" class="hover:text-brand-500 transition">Keahlian</a>
            <a href="{{ route('projects.index') }}" class="hover:text-brand-500 transition">Project</a>
            <a href="{{ route('certificates.index') }}" class="hover:text-brand-500 transition">Sertifikat</a>
            <a href="{{ route('home') }}#experience" class="hover:text-brand-500 transition">Pengalaman</a>
            <a href="{{ route('home') }}#contact" class="hover:text-brand-500 transition">Kontak</a>
        </nav>
    </div>
</header>