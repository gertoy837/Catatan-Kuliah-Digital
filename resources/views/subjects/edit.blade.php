@extends('layouts.simple.master')

@section('breadcrumb')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{route('dashboard')}}">Dashboard Mata Kuliah</a></li>
@endsection
@section('title', 'Edit Mata Kuliah')

@section('main_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Mata Kuliah: {{ $subject->name }}</h5>
                </div>
                <div class="card-body">
                    {{-- Form mengarah ke route update dan menggunakan method PUT --}}
                    <form action="{{ route('subjects.update', $subject) }}" method="POST" class="theme-form">
                        @csrf
                        @method('PUT') {{-- Method spoofing untuk request UPDATE --}}

                        {{-- Input untuk Nama Mata Kuliah --}}
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="name">Nama Mata Kuliah</label>
                            {{-- Menggunakan old() dengan nilai default dari $subject --}}
                            <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" value="{{ old('name', $subject->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Textarea untuk Deskripsi --}}
                        <div class="mb-3">
                            <label class="col-form-label pt-0" for="description">Deskripsi (Opsional)</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $subject->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tombol Aksi --}}
                        <hr>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('subjects.show', $subject) }}" class="btn btn-secondary">Batal</a>
                            <button class="btn btn-primary" type="submit">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
