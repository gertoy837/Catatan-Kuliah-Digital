@extends('layouts.simple.master')

@section('breadcrumb')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{route('dashboard')}}">Dashboard Mata Kuliah</a></li>
@endsection
@section('title', 'Detail Mata Kuliah')

@section('main_content')
    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Bagian Header Mata Kuliah --}}
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4>Mata Kuliah: {{ $subject->name }}</h4>
                    <p class="mb-0 text-muted">{{ $subject->description ?? 'Tidak ada deskripsi.' }}</p>
                </div>
                <div>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Bagian untuk Menambah Topik Baru --}}
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="mb-3">Tambah Topik Baru</h5>
            <form action="{{ route('topics.store', $subject) }}" method="POST">
                @csrf
                <div class="row gx-3 gy-2">
                    <div class="col-sm-9">
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                            placeholder="Contoh: Bab 1 - Pengenalan Laravel" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-primary w-100" type="submit">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Daftar Topik dan Catatan --}}
    <div class="row">
        <div class="col-sm-12">
            @foreach ($subject->topics as $topic)
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
                            <a href="{{ route('catatan.detail', [$topic->subject_id, $topic->id]) }}" class="btn btn-info btn-xs mb-0">Lihat Catatan</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
