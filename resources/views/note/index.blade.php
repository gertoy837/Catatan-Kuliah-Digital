@extends('layouts.simple.master')

@section('title', 'Detail Catatan')

@section('main_content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center p-3">
                <h5 class="mb-0">{{ $note->title ?? 'Catatan #' . $note->id }}</h5>

                <!-- Tombol Aksi -->
                <div>
                    <a href="{{ route('catatan.create') }}" class="btn btn-success btn-sm me-2">Buat Baru</a>
                    <a href="{{ route('catatan.edit', $note->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                    {{-- <a href="{{ route('catatan.delete') }}" class="btn btn-danger btn-sm me-2">Hapus</a> --}}
                </div>
            </div>

            <div class="card-body p-4">
                

                <!-- Isi Catatan -->
                <div class="note-content p-3 border rounded bg-light" style="white-space: pre-wrap; line-height: 1.6;">
                    {!! $note->body !!}
                </div>

                <!-- Tag Catatan -->
                {{-- @if ($note->tags->isNotEmpty())
                    <div class="mt-4">
                        @foreach ($note->tags as $tag)
                            <span class="badge border border-secondary text-secondary bg-white">#{{ $tag->name }}</span>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted mt-4"><em>Tidak ada tag.</em></p>
                @endif --}}
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
{{-- <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus catatan ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('notes.destroy', $note->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div> --}}
@endsection
