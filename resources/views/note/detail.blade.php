@extends('layouts.simple.master')

@section('title', 'Detail Topik')

@section('main_content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-8">
                <form action="{{ route('catatan.detail', [$subject, $topic]) }}" method="GET">
                    <div class="row gx-3 gy-2">
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="search"
                                placeholder="Cari judul catatan di topik ini..." value="{{ request('search') }}">
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-primary" style="padding: 11px 16px" type="submit"><i
                                    class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-4 text-end">
                <a href="{{ route('subjects.show', $subject) }}" class="btn btn-secondary float-end">
                    <i class="fa fa-arrow-left"></i> Kembali ke Daftar Topik
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card mb-3">
                    <div class="card-body rounded-3 shadow bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Topik: {{ $topic->name }}</h5>
                        <div class="d-flex gap-2">
                            <a href="{{ route('catatan.create', $topic->id) }}" class="btn btn-success btn-xs mb-0">Buat
                                Catatan Baru</a>
                        </div>
                    </div>
                </div>

                @if ($activeTag)
                    <div class="card shadow mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <span>Menampilkan catatan dengan tag: <strong>#{{ $activeTag->name }}</strong></span>
                            <a href="{{ route('catatan.detail', [$subject, $topic]) }}" class="btn-close btn-close-white"
                                aria-label="Close"></a>
                        </div>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body shadow">
                        <ul class="list-group list-group-flush">
                            @forelse ($notes as $note)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <a href="{{ route('catatan.show', $note) }}"
                                            class="text-decoration-none fs-6">{{ $note->title }}</a>
                                        <br>
                                        <small class="text-muted">Dibuat oleh: {{ $note->user->name }} | Diperbarui:
                                            {{ $note->updated_at->diffForHumans() }}</small>
                                        <br>
                                        <div class="tags-container mt-1">
                                            @foreach ($note->tags as $tag)
                                                <a href="{{ route('catatan.detail', [$subject, $topic, 'tag' => $tag->name]) }}"
                                                    class="text-decoration-none">
                                                    <span
                                                        class="badge rounded-1 bg-light text-dark">#{{ $tag->name }}</span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('catatan.show', $note) }}" class="btn btn-info btn-xs">Lihat</a>

                                        @if (auth()->id() === $note->user_id)
                                            <a href="{{ route('catatan.edit', $note) }}"
                                                class="btn btn-warning btn-xs">Edit</a>
                                            <form action="{{ route('catatan.destroy', $note) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-xs">Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item text-center text-muted">
                                    @if ($activeTag)
                                        Tidak ada catatan dengan tag "#{{ $activeTag->name }}" di topik ini.
                                    @else
                                        Belum ada catatan di topik ini.
                                    @endif
                                </li>
                            @endforelse
                        </ul>
                        <div class="mt-1 px-4">
                            {{ $notes->onEachSide(1)->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
