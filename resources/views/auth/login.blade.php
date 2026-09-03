<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin — Portfolio CMS</title>

  <script>
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
  </script>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
  <script>
    tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                        }
                    }
                }
            }
        }
  </script>
</head>

<body
  class="h-full bg-slate-100 dark:bg-slate-950 text-slate-800 dark:text-slate-100 flex items-center justify-center p-4 transition-colors">

  <div class="w-full max-w-md">
    <!-- Logo Header -->
    <div class="text-center mb-8">
      <a href="{{ route('home') }}"
        class="inline-flex items-center gap-2 font-extrabold text-2xl tracking-tight text-slate-900 dark:text-white">
        <span class="w-3.5 h-3.5 rounded-full bg-brand-500"></span>
        <span>Dev<span class="text-brand-500">Portfolio</span> <span
            class="text-xs uppercase bg-slate-200 dark:bg-slate-800 px-2 py-0.5 rounded text-slate-600 dark:text-slate-400">CMS</span></span>
      </a>
      <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">Masuk untuk mengelola seluruh portofolio Anda</p>
    </div>

    @if(session('success'))
    <div
      class="mb-4 p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 dark:bg-emerald-950/50 dark:border-emerald-800 dark:text-emerald-300 text-xs">
      {{ session('success') }}
    </div>
    @endif

    <!-- Card Login -->
    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl p-8">
      <form action="{{ url('/login') }}" method="POST" class="space-y-5">
        @csrf
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Email
            Address</label>
          <input type="email" name="email" required autofocus value="{{ old('email', 'admin@example.com') }}"
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
          @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Password</label>
          <input type="password" name="password" required value="password"
            class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500 focus:outline-none dark:text-white">
          @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-between text-xs">
          <label class="flex items-center gap-2 text-slate-600 dark:text-slate-400 cursor-pointer">
            <input type="checkbox" name="remember" class="rounded border-slate-300 text-brand-500 focus:ring-brand-500">
            <span>Ingat saya di perangkat ini</span>
          </label>
        </div>

        <button type="submit"
          class="w-full py-3 px-4 rounded-xl bg-slate-900 hover:bg-slate-800 dark:bg-brand-600 dark:hover:bg-brand-700 text-white font-semibold text-sm transition shadow-md">
          Masuk ke Admin Panel
        </button>
      </form>
    </div>

    <div class="text-center mt-6">
      <a href="{{ route('home') }}"
        class="text-xs text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition">
        &larr; Kembali ke Halaman Utama
      </a>
    </div>
  </div>

</body>

</html>