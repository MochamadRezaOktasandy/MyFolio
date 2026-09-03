<footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 py-12 transition-colors">
    <div
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6 text-sm text-slate-500 dark:text-slate-400">

        <div>
            <p>&copy; {{ date('Y') }} Personal Portfolio CMS. Dikembangkan dengan Laravel 11 & Tailwind CSS.</p>
        </div>

        <!-- Tautan Sosial Dinamis dari Database -->
        <div class="flex flex-wrap items-center gap-6 text-xs font-semibold">
            @if(isset($globalSocialLinks) && $globalSocialLinks->count() > 0)
            @foreach($globalSocialLinks as $social)
            <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer"
                class="hover:text-emerald-500 transition">
                {{ $social->platform }} &#8599;
            </a>
            @endforeach
            @endif

            <span class="text-slate-300 dark:text-slate-700">|</span>
            <a href="/login" class="uppercase tracking-wider text-slate-400 hover:text-emerald-500 transition">
                Admin Portal
            </a>
        </div>

    </div>
</footer>