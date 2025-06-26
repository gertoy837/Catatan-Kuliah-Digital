@extends('layouts.simple.master')

@section('breadcrumb')
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Dashboard Mata
            Kuliah</a></li>
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
            href="{{ route('subjects.show', $topic->subject) }}">Detail Mata Kuliah</a></li>
@endsection
@section('title', 'Buat Catatan Baru')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
@endsection

@section('main_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Buat Catatan Baru</h4>
                        <span>Buat catatan baru di dalam topik: <strong>{{ $topic->name }}</strong> (Mata Kuliah:
                            {{ $topic->subject->name }})</span>
                    </div>
                    <div class="card-body">
                        {{-- Form tidak lagi memerlukan enctype="multipart/form-data" --}}
                        <form action="{{ route('catatan.store', $topic) }}" method="POST" class="theme-form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="topic_id" value="{{ $topic->id }}">

                            {{-- Input untuk Judul Catatan --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="title">Judul Catatan</label>
                                <input class="form-control @error('title') is-invalid @enderror" id="title"
                                    type="text" name="title" placeholder="Masukkan judul catatan"
                                    value="{{ old('title') }}">
                                @error('title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="lampiran">Lampiran (Opsional)</label>
                                <input class="form-control @error('lampiran') is-invalid @enderror" id="lampiran"
                                    type="file" name="lampiran" accept=".pdf,.doc,.docx,.txt,.jpg,.jpeg,.png">
                                @error('lampiran')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="body">Isi Catatan dan Lampiran</label>

                                <input id="body" type="hidden" name="body"
                                    value="{{ old('body', $note->body ?? '') }}">
                                <trix-editor input="body"></trix-editor>

                                @error('body')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol Aksi --}}
                            <hr>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('catatan.detail', [$topic->subject_id, $topic->id]) }}"
                                    class="btn btn-secondary">Batal</a>
                                <button class="btn btn-primary" type="submit">Simpan Catatan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
