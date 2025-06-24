@extends('layouts.simple.master')

@section('breadcrumb')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{route('dashboard')}}">Dashboard Mata Kuliah</a></li>
@endsection
@section('title', 'Tambah Mata Kuliah')

@section('main_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Mata Kuliah Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('subjects.store') }}" method="POST" class="theme-form">
                        @csrf
                        {{-- Input untuk Nama Mata Kuliah --}}
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="name">Nama Mata Kuliah</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="Contoh: Pemrograman Berorientasi Objek" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Textarea untuk Deskripsi --}}
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="description">Deskripsi (Opsional)</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Deskripsi singkat mengenai mata kuliah ini">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tombol Aksi --}}
                        <hr>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Batal</a>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
