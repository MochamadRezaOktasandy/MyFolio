<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard') — Portfolio CMS</title>

  <script>
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
  </script>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
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
  <!-- Alpine.js CDN -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">
  <style>
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }
  </style>
</head>

<body
  class="h-full bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100 flex flex-col antialiased transition-colors"
  x-data="{ sidebarOpen: false }">

  <div class="flex h-full overflow-hidden">

    <!-- Sidebar Navigation -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
      class="fixed md:static inset-y-0 left-0 z-50 w-64 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 flex flex-col transition-transform duration-300 ease-in-out">

      <!-- Brand Logo -->
      <div class="h-16 flex items-center justify-between px-6 border-b border-slate-200 dark:border-slate-800">
        <a href="{{ route('admin.dashboard') }}"
          class="font-extrabold text-lg text-slate-900 dark:text-white flex items-center gap-2">
          <span class="w-3 h-3 rounded-full bg-brand-500"></span>
          <span>Admin<span class="text-brand-500">Panel</span></span>
        </a>
        <button @click="sidebarOpen = false" class="md:hidden text-slate-500 hover:text-slate-700">
          ✕
        </button>
      </div>

      <!-- Navigation Links -->
      <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1 text-sm font-medium">
        <a href="{{ route('admin.dashboard') }}"
          class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-brand-500/10 text-brand-600 dark:text-brand-400 font-bold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
          📊 Dashboard
        </a>

        <div class="pt-4 pb-2 text-[10px] font-bold uppercase tracking-wider text-slate-400 px-3">Konten CMS</div>

        <a href="{{ route('admin.profile.edit') }}"
          class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.profile.*') ? 'bg-brand-500/10 text-brand-600 dark:text-brand-400 font-bold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
          👤 Profil & Biodata
        </a>
        <a href="{{ route('admin.projects.index') }}"
          class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.projects.*') ? 'bg-brand-500/10 text-brand-600 dark:text-brand-400 font-bold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
          🚀 Manajemen Proyek
        </a>
        <a href="{{ route('admin.skills.index') }}"
          class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.skills.*') ? 'bg-brand-500/10 text-brand-600 dark:text-brand-400 font-bold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
          ⚡ Keahlian (Skills)
        </a>
        <a href="{{ route('admin.experiences.index') }}"
          class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.experiences.*') ? 'bg-brand-500/10 text-brand-600 dark:text-brand-400 font-bold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
          💼 Pengalaman Kerja
        </a>
        <a href="{{ route('admin.educations.index') }}"
          class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.educations.*') ? 'bg-brand-500/10 text-brand-600 dark:text-brand-400 font-bold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
          🎓 Pendidikan
        </a>
        <a href="{{ route('admin.certificates.index') }}"
          class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.certificates.*') ? 'bg-brand-500/10 text-brand-600 dark:text-brand-400 font-bold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
          📜 Sertifikat
        </a>
        <a href="{{ route('admin.messages.index') }}"
          class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.messages.*') ? 'bg-brand-500/10 text-brand-600 dark:text-brand-400 font-bold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
          ✉️ Pesan Masuk
        </a>
        <a href="{{ route('admin.social-links.index') }}"
          class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.social-links.*') ? 'bg-brand-500/10 text-brand-600 dark:text-brand-400 font-bold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
          🌐 Tautan Sosial
        </a>
      </nav>

      <!-- Bottom User & Logout -->
      <div class="p-4 border-t border-slate-200 dark:border-slate-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-xs font-bold text-slate-800 dark:text-slate-200">{{ Auth::user()->name }}</p>
            <p class="text-[11px] text-slate-400 truncate max-w-[130px]">{{ Auth::user()->email }}</p>
          </div>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
              class="p-2 text-slate-400 hover:text-rose-500 rounded-lg hover:bg-rose-50 dark:hover:bg-rose-950/40 transition"
              title="Logout">
              🚪
            </button>
          </form>
        </div>
      </div>
    </aside>

    <!-- Main Wrapper -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

      <!-- Top Navbar Header -->
      <header
        class="h-16 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between px-4 sm:px-8">
        <div class="flex items-center gap-4">
          <button @click="sidebarOpen = !sidebarOpen"
            class="md:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800">
            ☰
          </button>
          <h1 class="text-lg font-bold text-slate-900 dark:text-white">@yield('page_title', 'Dashboard')</h1>
        </div>

        <div class="flex items-center gap-3">
          <a href="{{ route('home') }}" target="_blank"
            class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 text-xs font-semibold hover:bg-slate-100 dark:hover:bg-slate-800 transition flex items-center gap-1.5">
            Lihat Web &#8599;
          </a>

          <!-- Theme Toggle -->
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
            class="p-2 rounded-lg text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
            <span x-show="darkMode">☀️</span>
            <span x-show="!darkMode">🌙</span>
          </button>
        </div>
      </header>

      <!-- Main Page Content -->
      <main class="flex-1 overflow-y-auto p-4 sm:p-8">
        @if(session('success'))
        <div
          class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 dark:bg-emerald-950/50 dark:border-emerald-800 dark:text-emerald-300 text-sm flex items-center gap-2">
          <span>✓</span>
          <span>{{ session('success') }}</span>
        </div>
        @endif

        @yield('content')
      </main>

    </div>

  </div>

</body>

</html>