@extends('layouts.simple.master')

@section('title', 'Detail Catatan')

@section('main_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">{{ $note->title }}</h4>
                            <div class="d-flex gap-2">
                                @if (auth()->id() === $note->user_id)
                                    <a href="{{ route('catatan.edit', $note) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil"></i> Edit Catatan
                                    </a>
                                @endif
                                <a href="{{ route('catatan.detail', [$note->topic->subject_id, $note->topic_id]) }}"
                                    class="btn btn-secondary btn-sm">
                                    <i class="fa fa-arrow-left"></i> Kembali ke Daftar
                                </a>
                            </div>
                        </div>
                        <small class="text-muted">Dibuat oleh: {{ $note->user->name }} | Terakhir diperbarui:
                            {{ $note->updated_at->diffForHumans() }}</small>
                        <br>
                        @foreach ($note->tags as $tag)
                            <span class="text-muted text-decoration-none">
                                <small>#{{ $tag->name }}</small>
                            </span>
                        @endforeach
                    </div>

                    <div class="note-content rounded" style="margin: 0; padding: 0;">
                        <div class="card-body">
                            <div class="trix-content bg-white text-black">
                                {!! $note->body !!}
                            </div>
                        </div>
                    </div>

                    @if ($note->lampiran)
                        @php
                            $filePath = public_path('uploads/' . $note->lampiran);
                            $extension = strtolower(pathinfo($note->lampiran, PATHINFO_EXTENSION));
                            $publicUrl = asset('uploads/' . $note->lampiran);
                        @endphp

                        <div class="lampiran-container px-4">
                            <h6 class="mb-3">Lampiran:</h6>
                            @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp']))
                                <a href="{{ $publicUrl }}" target="_blank" title="Lihat gambar penuh">
                                    <img src="{{ $publicUrl }}" alt="Lampiran Gambar"
                                        style="max-width: 400px; height: auto; border-radius: 8px;">
                                </a>
                            @elseif ($extension == 'pdf')
                                <iframe src="{{ $publicUrl }}" width="100%" height="500px"
                                    style="border: 1px solid #ccc; border-radius: 8px;"></iframe>
                            @elseif (in_array($extension, ['mp4', 'webm', 'ogg']))
                                <video width="100%" style="max-width: 500px;" controls>
                                    <source src="{{ $publicUrl }}" type="video/{{ $extension }}">
                                    Browser Anda tidak mendukung tag video.
                                </video>
                            @elseif (in_array($extension, ['mp3', 'wav', 'ogg']))
                                <audio controls>
                                    <source src="{{ $publicUrl }}" type="audio/{{ $extension }}">
                                    Browser Anda tidak mendukung tag audio.
                                </audio>
                            @else
                                <div class="flex items-center p-2 bg-gray-100 rounded-lg">
                                    <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>

                                    <a href="{{ $publicUrl }}" target="_blank" download
                                        class="text-blue-600 hover:underline">
                                        Download: {{ $note->lampiran }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="p-4">
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="note_id" value="{{ $note->id }}">
                            <div class="d-flex align-items-start gap-3">
                                <img src="{{ auth()->user()->avatar_url ?? asset('img/avatar.png') }}"
                                    class="rounded-circle" width="40" height="40" alt="Avatar">

                                <div class="flex-grow-1">
                                    <textarea name="body" class="form-control" rows="2" placeholder="Tulis komentar Anda..." required></textarea>
                                    <div class="d-flex justify-content-end mt-2">
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card bg-white text-white p-4" style="max-height: 90vh; overflow-y: auto;">
                            <h5 class="mb-4">Komentar</h5>

                            <div id="commentList">
                                @forelse($note->comments as $comment)
                                    @if (!$loop->first)
                                        <hr class="my-3">
                                    @endif

                                    <div class="d-flex align-items-start gap-3">
                                        <img src="{{ $comment->user->avatar_url ?? asset('img/avatar.png') }}"
                                            class="rounded-circle" width="40" height="40"
                                            alt="Avatar {{ $comment->user->name }}">

                                        <div class="flex-grow-1 text-dark">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <strong class="mb-0">{{ $comment->user->name }}</strong>
                                                <small
                                                    class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                            </div>

                                            <p class="mt-1 mb-2">{{ $comment->body }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center p-4 rounded bg-light">
                                        <p class="text-muted mb-0">Jadilah yang pertama berkomentar!</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
