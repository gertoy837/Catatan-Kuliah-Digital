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

        {{-- Tombol Utama untuk Menambah Mata Kuliah Baru --}}
        <div class="row mb-3">
            <div class="col-lg-12">
                <a href="{{ route('subjects.create') }}" class="btn btn-primary float-end">
                    <i class="fa fa-plus"></i> Tambah Mata Kuliah Baru
                </a>
            </div>
        </div>

        <div class="row">
            {{-- Loop untuk setiap mata kuliah, menggunakan @forelse untuk handle jika kosong --}}
            @forelse ($subjects as $subject)
                <div class="col-lg-6 col-xl-4 mb-4">
                    {{-- Kartu untuk setiap mata kuliah --}}
                    <div class="card shadow h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                {{-- Judul Kartu adalah Nama Mata Kuliah --}}
                                <h6 class="mb-0">{{ $subject->name }}</h6>
                                {{-- Tombol Edit mengarah ke halaman edit subject --}}
                                <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-link text-secondary p-0">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                            </div>
                        </div>
                        <div class="card-body border-top p-3">
                            {{-- Deskripsi Mata Kuliah --}}
                            <p class="text-sm">
                                {{ $subject->description ?? 'Tidak ada deskripsi untuk mata kuliah ini.' }}
                            </p>
                            <hr class="horizontal dark mt-4 mb-3">
                            {{-- Informasi tambahan seperti jumlah topik dan catatan --}}
                            <div class="d-flex justify-content-between text-sm">
                                <span><i class="fa fa-folder-open-o me-1"></i> {{ $subject->topics_count }} Topik</span>
                                <span><i class="fa fa-file-text-o me-1"></i> {{ $subject->notes_count }} Catatan</span>
                            </div>
                        </div>
                        <div class="card-footer p-3">
                            {{-- Tombol Detail mengarah ke halaman show subject --}}
                            <a href="{{ route('subjects.show', $subject) }}" class="btn btn-primary btn-sm float-end">
                                Lihat Detail & Catatan
                            </a>
                            {{-- Tombol Hapus dengan konfirmasi --}}
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
                {{-- Tampilan jika tidak ada mata kuliah sama sekali --}}
                <div class="col-12">
                    <div class="card text-center py-5">
                        <div class="card-body">
                            <h5 class="card-title">Anda Belum Punya Mata Kuliah</h5>
                            <p class="card-text">Silakan buat mata kuliah pertama Anda untuk mulai menambahkan topik dan
                                catatan.</p>
                            <a href="{{ route('subjects.create') }}" class="btn btn-primary">Buat Mata Kuliah Sekarang</a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Link Pagination jika datanya banyak --}}
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                {{ $subjects->links() }}
            </div>
        </div>
    </div>
@endsection
