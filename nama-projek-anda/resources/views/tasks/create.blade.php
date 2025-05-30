@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Tambah Tugasan Baru</h3>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<form method="POST" action="{{ route('tasks.store') }}">
    @csrf

    <div class="mb-3">
        <label for="title" class="form-label">Tajuk Tugasan</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Contoh: Siapkan report" required>
    </div>

    <div class="mb-3">
        <label for="completed" class="form-label">Status</label>
        <select name="completed" id="completed" class="form-select">
            <option value="0" selected>Belum Selesai</option>
            <option value="1">Selesai</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">
        <i class="bi bi-check-circle"></i> Simpan Tugasan
    </button>
</form>
@endsection
