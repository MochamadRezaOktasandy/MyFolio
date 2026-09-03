<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portfolio CMS - Software Engineer')</title>
    <meta name="description" content="@yield('meta_description', 'Personal Portfolio Software Engineer')">

    <!-- Open Graph / SEO Social Share -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Portfolio CMS - Software Engineer')">
    <meta property="og:description" content="@yield('meta_description', 'Personal Portfolio Software Engineer')">
    <meta property="og:image" content="@yield('og_image', asset('storage/' . ($profile->profile_image ?? '')))">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Portfolio CMS - Software Engineer')">
    <meta name="twitter:description" content="@yield('meta_description', 'Personal Portfolio Software Engineer')">
    <meta name="twitter:image" content="@yield('og_image', asset('storage/' . ($profile->profile_image ?? '')))">

    <!-- Anti-FOUC Dark Mode Script -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Tailwind CSS CDN dengan form & typography plugins -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#ecfdf5',
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

    <!-- Google Font: Plus Jakarta Sans -->
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
    class="bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100 min-h-screen flex flex-col antialiased transition-colors duration-200">

    @include('components.navbar')

    <!-- flex-1 memaksa elemen main meregang setinggi layar yang tersisa -->
    <main class="flex-1 w-full">
        @yield('content')
    </main>

    @include('components.footer')

    @stack('scripts')
</body>

</html>