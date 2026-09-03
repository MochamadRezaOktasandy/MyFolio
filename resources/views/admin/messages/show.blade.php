@extends('layouts.admin')

@section('title', 'Detail Pesan — ' . $message->subject)
@section('page_title', 'Detail Pesan Masuk')

@section('content')
<div class="max-w-3xl">
  <a href="{{ route('admin.messages.index') }}"
    class="inline-flex items-center gap-2 text-xs font-semibold text-brand-500 hover:underline mb-6">
    &larr; Kembali ke Semua Pesan
  </a>

  <div
    class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm p-6 sm:p-8 space-y-6">
    <div
      class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 dark:border-slate-800 pb-6">
      <div>
        <h1 class="text-xl font-bold text-slate-900 dark:text-white">{{ $message->subject }}</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
          Dari: <strong class="text-slate-800 dark:text-slate-200">{{ $message->name }}</strong> ({{ $message->email }})
        </p>
      </div>
      <span class="text-xs text-slate-400 font-medium">
        {{ $message->created_at->format('d M Y, H:i') }}
      </span>
    </div>

    <div
      class="prose dark:prose-invert max-w-none text-slate-700 dark:text-slate-300 leading-relaxed text-sm bg-slate-50 dark:bg-slate-800/50 p-6 rounded-xl border border-slate-100 dark:border-slate-800">
      {!! nl2br(e($message->message)) !!}
    </div>

    <div class="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-slate-800">
      <!-- Tombol Langsung Buka Gmail Web Compose -->
      <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $message->email }}&su={{ urlencode('Re: ' . $message->subject) }}"
        target="_blank" rel="noopener noreferrer"
        class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold text-xs transition inline-flex items-center gap-2 shadow-sm">
        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
          <path
            d="M24 5.457v13.909c0 .904-.732 1.636-1.636 1.636h-3.819V11.73L12 16.64l-6.545-4.91v9.272H1.636A1.636 1.636 0 0 1 0 19.366V5.457c0-2.023 2.309-3.178 3.927-1.964L5.455 4.64 12 9.548l6.545-4.91 1.528-1.145C21.69 2.28 24 3.434 24 5.457z" />
        </svg>
        <span>Balas via Gmail &#8599;</span>
      </a>

      <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST"
        onsubmit="return confirm('Hapus pesan ini?')">
        @csrf
        @method('DELETE')
        <button type="submit"
          class="px-4 py-2 text-xs font-semibold text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-950/50 rounded-xl transition">
          Hapus Pesan
        </button>
      </form>
    </div>
  </div>
</div>
@endsection