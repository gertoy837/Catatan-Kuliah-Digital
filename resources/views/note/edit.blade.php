@extends('layouts.simple.master')

@section('breadcrumb')
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">Dashboard Mata
            Kuliah</a></li>
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
            href="{{ route('subjects.show', $note->topic->subject) }}">Detail Mata Kuliah</a></li>
@endsection

@section('title', 'Edit Catatan')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css ">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js "></script>
@endsection

@section('main_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Catatan</h4>
                        <span>Edit catatan dalam topik: <strong>{{ $note->topic->name }}</strong> (Mata Kuliah:
                            {{ $note->topic->subject->name }})</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('catatan.update', $note) }}" method="POST" enctype="multipart/form-data"
                            class="theme-form">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="topic_id" value="{{ $note->topic_id }}">

                            {{-- Input Judul --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="title">Judul Catatan</label>
                                <input class="form-control @error('title') is-invalid @enderror" id="title"
                                    type="text" name="title" placeholder="Masukkan judul catatan"
                                    value="{{ old('title', $note->title) }}">
                                @error('title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="lampiran">Lampiran</label>
                                <input class="form-control @error('lampiran') is-invalid @enderror" id="lampiran"
                                    type="file" name="lampiran" accept=".pdf,.doc,.docx,.txt,.jpg,.jpeg,.png">

                                @if ($note->lampiran)
                                    <small>Lampiran saat ini:
                                        <a href="{{ asset('uploads/' . $note->lampiran) }}" target="_blank">
                                            {{ $note->lampiran }}
                                        </a>
                                    </small>
                                @endif

                                @error('lampiran')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Input Body dengan Trix Editor --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="body">Isi Catatan</label>
                                <input id="body" type="hidden" name="body" value="{{ old('body', $note->body) }}">
                                <trix-editor input="body" class="@error('body') is-invalid @enderror"></trix-editor>
                                @error('body')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Input Tags --}}
                            <div class="mb-3">
                                <label class="col-form-label pt-0" for="tags">Tags (Pisahkan dengan koma)</label>
                                <input class="form-control @error('tags') is-invalid @enderror" id="tags"
                                    type="text" name="tags" placeholder="Contoh: penting, rumus, ujian"
                                    value="{{ old('tags', $note->tags->pluck('name')->implode(',')) }}">
                                @error('tags')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol Aksi --}}
                            <hr>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('catatan.detail', [$note->topic->subject_id, $note->topic_id]) }}"
                                    class="btn btn-secondary">Batal</a>
                                <button class="btn btn-primary" type="submit">Perbarui Catatan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
