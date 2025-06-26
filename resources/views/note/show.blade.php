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
                                <a href="{{ route('subjects.show', $note->topic->subject) }}"
                                    class="btn btn-secondary btn-sm">
                                    <i class="fa fa-arrow-left"></i> Kembali ke Daftar
                                </a>
                            </div>
                        </div>
                        <small class="text-muted">Dibuat oleh: {{ $note->user->name }} | Terakhir diperbarui:
                            {{ $note->updated_at->diffForHumans() }}</small>
                    </div>

                    @if ($note->lampiran)
                        <div class="m-1 p-4">
                            <a href="{{ asset('uploads/' . $note->lampiran) }}" class="flex" target="_blank">
                                {{ $note->lampiran }}
                            </a>
                        </div>
                    @endif
                    <div class="note-content p-1 m-3 border rounded bg-light" style="margin: 0; padding: 0;">
                        <div class="card-body">
                            {{-- Merender konten dari Trix Editor --}}
                            {{-- Paket tonysm/rich-text-laravel akan otomatis merender HTML dan lampiran --}}
                            <div class="trix-content ">
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
