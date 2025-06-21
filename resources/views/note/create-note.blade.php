@extends('layouts.simple.master')

@section('title', 'Catatan Baru')

@section('main_content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header pb-0 p-3">
                    <h5 class="mb-0">Buat Catatan Baru</h5>
                </div>
                <div class="card-body p-4">

                    <!-- Toolbar Formatting -->
                    <div class="btn-toolbar mb-3" role="toolbar">
                        <div class="btn-group me-2" role="group">
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="formatText('bold')"
                                title="Bold">
                                <i class="bi bi-type-bold"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="formatText('italic')"
                                title="Italic">
                                <i class="bi bi-type-italic"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm"
                                onclick="formatText('underline')" title="Underline">
                                <i class="bi bi-type-underline"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Area Editable -->
                    <div id="editor" class="form-control p-3" contenteditable="true"
                        style="min-height: 400px; white-space: pre-wrap; line-height: 1.6;">
                        Tuliskan catatanmu di sini...
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="mt-4 text-end">
                        <button class="btn btn-primary px-4" onclick="saveNote()">Simpan</button>
                    </div>

                    <!-- Form Hidden untuk Kirim Data ke Backend -->
                    <form id="noteForm" action="{{ route('catatan.create') }}" method="POST" style="display:none;">
                        @csrf
                        <input type="hidden" name="content" id="noteContent">
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function formatText(command) {
            document.execCommand(command, false, null);
        }

        function saveNote() {
            const content = document.getElementById('editor').innerHTML;
            document.getElementById('noteContent').value = content;
            document.getElementById('noteForm').submit();
        }
    </script>
@endsection
