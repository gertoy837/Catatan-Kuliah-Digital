@extends('layouts.simple.master')

@section('title', 'Dashboard Mata Kuliah')

@section('main_content')
    <div class="container-fluid">

        {{-- Notifikasi jika ada pesan sukses dari session --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-md-8">
                <form action="{{ route('dashboard') }}" method="GET">
                    <div class="row gx-3 gy-2">
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="search"
                                placeholder="Cari berdasarkan nama mata kuliah..." value="{{ request('search') }}">
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-primary" style="padding: 11px 16px" type="submit"><i
                                    class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-4 text-end">
                <a href="{{ route('subjects.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Tambah Mata Kuliah
                </a>
            </div>
        </div>

        <div class="row">
            {{-- Loop untuk setiap mata kuliah --}}
            @forelse ($subjects as $subject)
                <div class="col-lg-6 col-xl-4 mb-4">
                    {{-- Kartu untuk setiap mata kuliah --}}
                    <div class="card shadow h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">{{ $subject->name }}</h6>
                                <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-link text-secondary p-0">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                            </div>
                        </div>
                        <div class="card-body border-top p-3">
                            <p class="text-sm">
                                {{ $subject->description ?? 'Tidak ada deskripsi untuk mata kuliah ini.' }}
                            </p>
                            <small class="text-muted">Dibuat oleh: {{ $subject->user->name }} |
                                {{ $subject->created_at->diffForHumans() }}</small>
                            <hr class="horizontal dark mt-4 mb-3">
                            <div class="d-flex justify-content-between text-sm">
                                <span><i class="fa fa-folder-open-o me-1"></i> {{ $subject->topics_count }} Topik</span>
                                <span><i class="fa fa-file-text-o me-1"></i> {{ $subject->notes_count }} Catatan</span>
                            </div>
                        </div>
                        <div class="card-footer p-3">
                            <a href="{{ route('subjects.show', $subject) }}" class="btn btn-primary btn-sm float-end">
                                Lihat Detail & Catatan
                            </a>
                            <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus mata kuliah ini dan semua isinya?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Tampilan jika tidak ada mata kuliah (atau hasil pencarian kosong) --}}
                <div class="col-12">
                    <div class="card text-center py-5">
                        <div class="card-body">
                            <h5 class="card-title">Tidak Ada Hasil</h5>
                            <p class="card-text">
                                {{-- INI BAGIAN YANG DIPERBAIKI --}}
                                @if (request('search'))
                                    Tidak ada mata kuliah yang cocok dengan pencarian "{{ request('search') }}".
                                @else
                                    Anda belum punya mata kuliah. Silakan buat satu!
                                @endif
                            </p>
                            @if (request('search'))
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-2">Tampilkan Semua Mata
                                    Kuliah</a>
                            @else
                                <a href="{{ route('subjects.create') }}" class="btn btn-primary mt-2">Buat Mata Kuliah
                                    Sekarang</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Link Pagination --}}
        <div class="mt-1 px-4">
            {{ $subjects->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
