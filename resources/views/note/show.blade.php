@extends('layouts.simple.master')

@section('title', 'Detail Catatan')

@section('main_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">

                        {{-- Judul Catatan dan Tombol Aksi --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">{{ $note->title }}</h4>
                            <div class="d-flex gap-2">
                                <a href="{{ route('catatan.edit', $note) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-pencil"></i> Edit Catatan
                                </a>
                                <a href="{{ route('catatan.detail', [$note->topic->subject_id, $note->topic_id]) }}"
                                    class="btn btn-secondary btn-sm">
                                    <i class="fa fa-arrow-left"></i> Kembali ke Daftar
                                </a>
                            </div>
                        </div>
                        <small class="text-muted">Dibuat oleh: {{ $note->user->name }} | Terakhir diperbarui:
                            {{ $note->updated_at->diffForHumans() }}</small>
                    </div>

                    @if ($note->lampiran)
                        @php
                            $filePath = public_path('uploads/' . $note->lampiran);
                            $extension = strtolower(pathinfo($note->lampiran, PATHINFO_EXTENSION));
                            $publicUrl = asset('uploads/' . $note->lampiran);
                        @endphp

                        <div class="lampiran-container mt-4 p-3 border rounded">
                            <h6 class="mb-3">Lampiran:</h6>

                            {{-- 1. Jika file adalah GAMBAR --}}
                            @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp']))
                                <a href="{{ $publicUrl }}" target="_blank" title="Lihat gambar penuh">
                                    <img src="{{ $publicUrl }}" alt="Lampiran Gambar"
                                        style="max-width: 400px; height: auto; border-radius: 8px;">
                                </a>

                                {{-- 2. Jika file adalah PDF --}}
                            @elseif ($extension == 'pdf')
                                <iframe src="{{ $publicUrl }}" width="100%" height="500px"
                                    style="border: 1px solid #ccc; border-radius: 8px;"></iframe>

                                {{-- 3. Jika file adalah VIDEO --}}
                            @elseif (in_array($extension, ['mp4', 'webm', 'ogg']))
                                <video width="100%" style="max-width: 500px;" controls>
                                    <source src="{{ $publicUrl }}" type="video/{{ $extension }}">
                                    Browser Anda tidak mendukung tag video.
                                </video>

                                {{-- 4. Jika file adalah AUDIO --}}
                            @elseif (in_array($extension, ['mp3', 'wav', 'ogg']))
                                <audio controls>
                                    <source src="{{ $publicUrl }}" type="audio/{{ $extension }}">
                                    Browser Anda tidak mendukung tag audio.
                                </audio>

                                {{-- 5. Default untuk file lainnya (Dokumen, Zip, dll) --}}
                            @else
                                <div class="flex items-center p-2 bg-gray-100 rounded-lg">
                                    {{-- Anda bisa menggunakan library ikon seperti Font Awesome untuk ini --}}
                                    {{-- <i class="fa fa-file-alt mr-2"></i> --}}
                                    <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>

                                    <a href="{{ $publicUrl }}" target="_blank" download
                                        class="text-blue-600 hover:underline">
                                        Download: {{ $note->lampiran }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="note-content rounded" style="margin: 0; padding: 0;">
                        <div class="card-body">
                            <div class="trix-content bg-white text-black">
                                {!! $note->body !!}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Placeholder untuk Fitur Komentar di Masa Depan --}}
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Komentar</h5>
                    </div>
                    <div class="card-body">
                        {{-- Anda bisa menambahkan logika untuk menampilkan dan menambah komentar di sini --}}
                        <p class="text-muted">Fitur komentar akan tersedia di sini.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
