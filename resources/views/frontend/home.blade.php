@extends('layouts.app')

@section('title', ($profile->name ?? 'Developer') . ' — Portfolio')

@section('content')
<!-- Hero Section -->
<section class="relative py-20 lg:py-32 overflow-hidden border-b border-slate-100 dark:border-slate-900">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl">
      @if($profile->availability_status)
      <div
        class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-400 mb-6 border border-emerald-300 dark:border-emerald-800">
        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
        <span>{{ $profile->availability_status }}</span>
      </div>
      @endif

      <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-slate-900 dark:text-white mb-4 leading-tight">
        Halo, saya <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-teal-400">{{
          $profile->name ?? 'Software Engineer' }}</span>.
      </h1>
      <p class="text-xl sm:text-2xl font-medium text-slate-600 dark:text-slate-300 mb-6">
        {{ $profile->headline ?? 'Full-Stack Developer' }}
      </p>
      <p class="text-base sm:text-lg text-slate-500 dark:text-slate-400 leading-relaxed mb-8">
        {{ $profile->short_bio }}
      </p>

      <div class="flex flex-wrap items-center gap-4">
        <a href="#projects"
          class="px-6 py-3 rounded-xl bg-slate-900 text-white dark:bg-brand-600 dark:hover:bg-brand-700 font-semibold text-sm hover:bg-slate-800 transition shadow-lg shadow-emerald-500/10">
          Lihat Proyek
        </a>
        <a href="#contact"
          class="px-6 py-3 rounded-xl border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-200 font-semibold text-sm hover:bg-slate-100 dark:hover:bg-slate-800 transition">
          Hubungi Saya
        </a>
      </div>

      <!-- Social Links -->
      @if($socialLinks->count() > 0)
      <div class="flex items-center gap-5 mt-10 text-slate-500 dark:text-slate-400 text-sm">
        <span class="font-medium text-slate-400 dark:text-slate-500">Temukan saya di:</span>
        @foreach($socialLinks as $social)
        <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer"
          class="hover:text-emerald-500 transition font-medium underline underline-offset-4">
          {{ $social->platform }}
        </a>
        @endforeach
      </div>
      @endif
    </div>
  </div>
</section>

<!-- About Section -->
<section id="about" class="py-20 bg-white dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-900">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
      <div class="lg:col-span-4">
        <div class="aspect-square rounded-2xl bg-gradient-to-tr from-emerald-500 to-teal-400 p-1 shadow-2xl">
          <div
            class="w-full h-full bg-slate-100 dark:bg-slate-900 rounded-2xl flex items-center justify-center overflow-hidden">
            @if($profile->profile_image)
            <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="{{ $profile->name }}"
              class="w-full h-full object-cover">
            @else
            <span class="text-6xl font-extrabold text-slate-300 dark:text-slate-700">DEV</span>
            @endif
          </div>
        </div>
      </div>
      <div class="lg:col-span-8 space-y-6">
        <h2 class="text-xs uppercase tracking-widest font-bold text-emerald-500">Tentang Saya</h2>
        <h3 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Menghubungkan Solusi Bisnis
          dengan Rekayasa Kode yang Bersih.</h3>
        <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
          {{ $profile->bio }}
        </p>
        <div class="grid grid-cols-2 gap-4 pt-4 border-t border-slate-200 dark:border-slate-800 text-sm">
          <div>
            <span class="block text-slate-400 dark:text-slate-500">Domisili:</span>
            <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $profile->location }}</span>
          </div>
          <div>
            <span class="block text-slate-400 dark:text-slate-500">Email:</span>
            <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $profile->email }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Skills Section -->
<section id="skills" class="py-20 border-b border-slate-100 dark:border-slate-900">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-14">
      <h2 class="text-xs uppercase tracking-widest font-bold text-emerald-500 mb-2">Tech Stack</h2>
      <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white">Kemampuan & Teknologi</h3>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      @foreach($skillCategories as $cat)
      <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
        <h4 class="font-bold text-lg text-slate-900 dark:text-white mb-6">{{ $cat->name }}</h4>
        <div class="space-y-5">
          @foreach($cat->skills as $skill)
          <div>
            <div class="flex justify-between text-sm mb-1">
              <span class="font-medium text-slate-700 dark:text-slate-300">{{ $skill->name }}</span>
              <span class="text-slate-400">{{ $skill->percentage }}%</span>
            </div>
            <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-2">
              <div class="bg-emerald-500 h-2 rounded-full transition-all duration-500"
                style="width: {{ $skill->percentage }}%"></div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Featured Projects Section -->
<section id="projects" class="py-20 bg-white dark:bg-slate-900/40 border-b border-slate-100 dark:border-slate-900">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-14 gap-4">
      <div>
        <h2 class="text-xs uppercase tracking-widest font-bold text-emerald-500 mb-2">Portofolio Pilihan</h2>
        <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white">Proyek Terbaru</h3>
      </div>
      <a href="{{ route('projects.index') }}"
        class="text-sm font-semibold text-emerald-500 hover:text-emerald-600 transition flex items-center gap-1">
        Lihat Semua Proyek &rarr;
      </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      @foreach($featuredProjects as $project)
      <div
        class="group rounded-2xl overflow-hidden bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex flex-col shadow-sm hover:shadow-xl transition-all duration-300">
        <div class="aspect-video w-full overflow-hidden bg-slate-100 dark:bg-slate-800 relative">
          <img src="{{ $project->thumbnail }}" alt="{{ $project->title }}"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          <span
            class="absolute top-4 left-4 px-3 py-1 bg-slate-900/80 backdrop-blur-md text-white text-xs font-semibold rounded-full">
            {{ $project->category->name }}
          </span>
        </div>
        <div class="p-6 flex flex-col flex-grow">
          <h4 class="font-bold text-xl text-slate-900 dark:text-white mb-2 group-hover:text-emerald-500 transition">
            <a href="{{ route('projects.show', $project->slug) }}">
              {{ $project->title }}
            </a>
          </h4>
          <p class="text-slate-600 dark:text-slate-400 text-sm mb-6 flex-grow line-clamp-2">
            {{ $project->short_description }}
          </p>

          <div class="flex flex-wrap gap-2 mb-6">
            @foreach($project->technologies as $tech)
            <span
              class="px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300">
              {{ $tech->name }}
            </span>
            @endforeach
          </div>

          <div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <a href="{{ route('projects.show', $project->slug) }}"
              class="text-sm font-semibold text-emerald-500 hover:underline">
              Detail Studi Kasus &rarr;
            </a>
            @if($project->live_url)
            <a href="{{ $project->live_url }}" target="_blank"
              class="text-xs font-medium text-slate-400 hover:text-slate-600 dark:hover:text-white">
              Live Demo &#8599;
            </a>
            @endif
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Experience & Education -->
<section id="experience" class="py-20 border-b border-slate-100 dark:border-slate-900">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
      <!-- Experience -->
      <div>
        <h3 class="text-2xl font-extrabold text-slate-900 dark:text-white mb-8 flex items-center gap-3">
          <span class="p-2 rounded-lg bg-emerald-500/10 text-emerald-500">💼</span> Pengalaman Kerja
        </h3>
        <div class="space-y-8 border-l-2 border-slate-200 dark:border-slate-800 pl-6 ml-3">
          @foreach($experiences as $exp)
          <div class="relative">
            <div
              class="absolute -left-[31px] top-1.5 w-3 h-3 rounded-full bg-emerald-500 ring-4 ring-white dark:ring-slate-950">
            </div>
            <span class="text-xs font-semibold text-emerald-500 uppercase tracking-wider">
              {{ \Carbon\Carbon::parse($exp->start_date)->format('M Y') }} — {{ $exp->is_current ? 'Sekarang' :
              \Carbon\Carbon::parse($exp->end_date)->format('M Y') }}
            </span>
            <h4 class="font-bold text-lg text-slate-900 dark:text-white mt-1">{{ $exp->position }}</h4>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-2">{{ $exp->company }} &bull; {{
              $exp->location }}</p>
            <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">{{ $exp->description }}</p>
          </div>
          @endforeach
        </div>
      </div>

      <!-- Education -->
      <div>
        <h3 class="text-2xl font-extrabold text-slate-900 dark:text-white mb-8 flex items-center gap-3">
          <span class="p-2 rounded-lg bg-emerald-500/10 text-emerald-500">🎓</span> Pendidikan
        </h3>
        <div class="space-y-8 border-l-2 border-slate-200 dark:border-slate-800 pl-6 ml-3">
          @foreach($educations as $edu)
          <div class="relative">
            <div
              class="absolute -left-[31px] top-1.5 w-3 h-3 rounded-full bg-teal-500 ring-4 ring-white dark:ring-slate-950">
            </div>
            <span class="text-xs font-semibold text-teal-500 uppercase tracking-wider">
              {{ \Carbon\Carbon::parse($edu->start_date)->format('Y') }} — {{ $edu->is_current ? 'Sekarang' :
              \Carbon\Carbon::parse($edu->end_date)->format('Y') }}
            </span>
            <h4 class="font-bold text-lg text-slate-900 dark:text-white mt-1">{{ $edu->degree }}</h4>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-2">{{ $edu->institution }} &bull; {{
              $edu->field_of_study }}</p>
            <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">{{ $edu->description }}</p>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-20 bg-white dark:bg-slate-900/30" x-data="contactForm()">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h2 class="text-xs uppercase tracking-widest font-bold text-emerald-500 mb-2">Kontak</h2>
      <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white">Mari Bekerja Sama</h3>
      <p class="text-slate-500 dark:text-slate-400 mt-2">Kirim pesan untuk tawaran proyek, rekrutmen, atau sekadar
        berdiskusi.</p>
    </div>

    <!-- Alert Sukses (Muncul instan tanpa reload) -->
    <div x-show="successMessage" x-transition
      class="mb-8 p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-800 dark:bg-emerald-950/60 dark:border-emerald-700 dark:text-emerald-300 flex items-center gap-3 shadow-md"
      style="display: none;">
      <svg class="w-6 h-6 flex-shrink-0 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd"
          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
          clip-rule="evenodd"></path>
      </svg>
      <span class="font-medium text-sm" x-text="successMessage"></span>
    </div>

    <!-- Alert Error Validasi (Muncul instan tanpa reload) -->
    <div x-show="Object.keys(errors).length > 0" x-transition
      class="mb-8 p-4 rounded-xl bg-rose-50 border border-rose-300 text-rose-800 dark:bg-rose-950/60 dark:border-rose-700 dark:text-rose-300 shadow-md"
      style="display: none;">
      <div class="flex items-center gap-2 font-semibold text-sm mb-2">
        <svg class="w-5 h-5 text-rose-500" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd"
            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
            clip-rule="evenodd"></path>
        </svg>
        <span>Mohon periksa kembali formulir Anda:</span>
      </div>
      <ul class="list-disc list-inside text-xs space-y-1">
        <template x-for="(errMessages, field) in errors" :key="field">
          <li x-text="errMessages[0]"></li>
        </template>
      </ul>
    </div>

    <!-- Form Menggunakan Event Submit Prevent -->
    <form @submit.prevent="submitForm"
      class="p-8 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-xl space-y-6">
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Nama
            Lengkap</label>
          <input type="text" x-model="formData.name"
            :class="errors.name ? 'border-rose-500 focus:ring-rose-500' : 'border-slate-300 dark:border-slate-700 focus:ring-emerald-500'"
            class="w-full rounded-xl border bg-slate-50 dark:bg-slate-800 px-4 py-3 text-sm focus:ring-2 focus:outline-none dark:text-white transition">
          <span x-show="errors.name" class="text-rose-500 text-xs mt-1 block"
            x-text="errors.name ? errors.name[0] : ''"></span>
        </div>
        <div>
          <label
            class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Alamat
            Email</label>
          <input type="email" x-model="formData.email"
            :class="errors.email ? 'border-rose-500 focus:ring-rose-500' : 'border-slate-300 dark:border-slate-700 focus:ring-emerald-500'"
            class="w-full rounded-xl border bg-slate-50 dark:bg-slate-800 px-4 py-3 text-sm focus:ring-2 focus:outline-none dark:text-white transition">
          <span x-show="errors.email" class="text-rose-500 text-xs mt-1 block"
            x-text="errors.email ? errors.email[0] : ''"></span>
        </div>
      </div>

      <div>
        <label
          class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Subjek
          Pesan</label>
        <input type="text" x-model="formData.subject"
          :class="errors.subject ? 'border-rose-500 focus:ring-rose-500' : 'border-slate-300 dark:border-slate-700 focus:ring-emerald-500'"
          class="w-full rounded-xl border bg-slate-50 dark:bg-slate-800 px-4 py-3 text-sm focus:ring-2 focus:outline-none dark:text-white transition">
        <span x-show="errors.subject" class="text-rose-500 text-xs mt-1 block"
          x-text="errors.subject ? errors.subject[0] : ''"></span>
      </div>

      <div>
        <label
          class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2">Pesan</label>
        <textarea x-model="formData.message" rows="5"
          :class="errors.message ? 'border-rose-500 focus:ring-rose-500' : 'border-slate-300 dark:border-slate-700 focus:ring-emerald-500'"
          class="w-full rounded-xl border bg-slate-50 dark:bg-slate-800 px-4 py-3 text-sm focus:ring-2 focus:outline-none dark:text-white transition"></textarea>
        <span x-show="errors.message" class="text-rose-500 text-xs mt-1 block"
          x-text="errors.message ? errors.message[0] : ''"></span>
      </div>

      <button type="submit" :disabled="loading"
        class="w-full py-3.5 px-6 rounded-xl bg-slate-900 dark:bg-brand-600 text-white font-semibold text-sm hover:bg-slate-800 dark:hover:bg-brand-700 transition shadow-lg flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
        <!-- Spinner saat loading -->
        <svg x-show="loading" class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
          style="display: none;">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
        </svg>
        <span x-text="loading ? 'Mengirim pesan...' : 'Kirim Pesan Sekarang'"></span>
      </button>
    </form>
  </div>
</section>
@endsection

<!-- Script Handler Alpine.js -->
<script>
  function contactForm() {
        return {
            loading: false,
            successMessage: '',
            errors: {},
            formData: {
                name: '',
                email: '',
                subject: '',
                message: ''
            },
            async submitForm() {
                this.loading = true;
                this.successMessage = '';
                this.errors = {};

                try {
                    const response = await fetch("{{ route('contact.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify(this.formData)
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        if (response.status === 422) {
                            // Validasi Laravel gagal
                            this.errors = data.errors || {};
                        } else {
                            alert("Terjadi kesalahan pada server. Silakan coba lagi.");
                        }
                    } else {
                        // Sukses
                        this.successMessage = data.message;
                        // Reset form
                        this.formData = { name: '', email: '', subject: '', message: '' };
                    }
                } catch (err) {
                    console.error("Error submit form:", err);
                    alert("Gagal terhubung ke server. Periksa koneksi internet Anda.");
                } finally {
                    this.loading = false;
                }
            }
        }
    }
</script>