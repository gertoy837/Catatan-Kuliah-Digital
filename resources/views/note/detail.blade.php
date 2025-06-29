@extends('layouts.simple.master')

@section('title', 'Detail Catatan')

@section('main_content')
    {{-- Tombol Utama untuk Menambah Mata Kuliah Baru --}}
    <div class="row mb-3">
        <div class="col-lg-12">
            <a href="{{ route('subjects.show', $subject) }}" class="btn btn-primary float-end">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            {{-- @forelse ($subject->topics as $topic) --}}
            <div class="card mb-3">
                <div class="card-body rounded-3 shadow bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Topik: {{ $topic->name }}</h5>
                    <div class="d-flex gap-2">
                        <form action="{{ route('topics.destroy', [$subject, $topic]) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus topik ini beserta semua catatannya?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-xs mb-0">Hapus Topik</button>
                        </form>
                        <a href="{{ route('catatan.create', $topic->id) }}" class="btn btn-success btn-xs mb-0">Buat
                            Catatan
                            Baru</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body shadow">
                    <ul class="list-group list-group-flush">
                        @forelse ($topic->notes as $note)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="{{ route('catatan.show', $note) }}"
                                        class="text-decoration-none fs-6">{{ $note->title }}</a>
                                    <br>
                                    <small class="text-muted">Diperbarui:
                                        {{ $note->updated_at->format('d M Y, H:i') }}</small>
                                    <div class="tags-container mt-2">
                                            @forelse($note->tags as $tag)
                                                <a href="{{ route('catatan.tag', $tag->name) }}" class="badge bg-info text-decoration-none">
                                                    #{{ $tag->name }}
                                                </a>
                                            @empty
                                                {{-- Tidak perlu menampilkan apa-apa jika tidak ada tag --}}
                                            @endforelse
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('catatan.show', $note) }}" class="btn btn-info btn-xs">Lihat</a>
                                    <a href="{{ route('catatan.edit', $note) }}" class="btn btn-warning btn-xs">Edit</a>
                                    <form action="{{ route('catatan.destroy', $note) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-xs">Hapus</button>
                                    </form>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted">Belum ada catatan di topik ini.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            {{-- @empty
                <div class="card">
                    <div class="card-body text-center">
                        <p class="text-muted">Belum ada topik di mata kuliah ini. Silakan tambahkan topik baru di atas.</p>
                    </div>
                </div>
            @endforelse --}}
        </div>
    </div>
@endsection
