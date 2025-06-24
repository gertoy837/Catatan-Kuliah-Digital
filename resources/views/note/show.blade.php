@extends('layouts.simple.master')

@section('title', 'Detail Catatan')

@section('main_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    {{-- Navigasi Breadcrumb untuk Konteks --}}
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('subjects.index') }}">Mata Kuliah</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('subjects.show', $note->topic->subject) }}">{{ $note->topic->subject->name }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $note->topic->name }}</li>
                        </ol>
                    </nav>
                    <hr class="mt-0">

                    {{-- Judul Catatan dan Tombol Aksi --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ $note->title }}</h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('notes.edit', $note) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-pencil"></i> Edit Catatan
                            </a>
                            <a href="{{ route('subjects.show', $note->topic->subject) }}"
                                class="btn btn-secondary btn-sm">
                                <i class="fa fa-arrow-left"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                    <small class="text-muted">Dibuat oleh: {{ $note->user->name }} | Terakhir diperbarui:
                        {{ $note->updated_at->diffForHumans() }}</small>
                </div>
                <div class="card-body">
                    {{-- Merender konten dari Trix Editor --}}
                    {{-- Paket tonysm/rich-text-laravel akan otomatis merender HTML dan lampiran --}}
                    <div class="trix-content">
                        {!! $note->body !!}
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
