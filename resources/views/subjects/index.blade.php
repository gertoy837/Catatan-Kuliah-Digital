@extends('layouts.simple.master')

@section('title', 'Daftar Mata Kuliah')

@section('main_content')
<div class="container-fluid">
    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Daftar Mata Kuliah Anda</h5>
                    <a href="{{ route('subjects.create') }}" class="btn btn-primary">Tambah Mata Kuliah Baru</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nama Mata Kuliah</th>
                                <th scope="col">Jumlah Topik</th>
                                <th scope="col">Tanggal Dibuat</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subjects as $subject)
                                <tr>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->topics->count() }}</td>
                                    <td>{{ $subject->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('subjects.show', $subject) }}" class="btn btn-info btn-sm">Lihat</a>
                                            <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('subjects.destroy', $subject) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini? Semua topik dan catatan di dalamnya akan ikut terhapus.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Anda belum memiliki mata kuliah. Silakan tambahkan satu!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- Menampilkan link pagination jika ada --}}
                <div class="card-footer">
                    {{ $subjects->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
