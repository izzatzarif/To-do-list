@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Senarai Tugasan</h3>
    <a href="{{ route('tasks.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Tugasan Baru
    </a>
</div>

<div class="mb-3">
    <form method="GET" action="{{ route('tasks.index') }}">
        <select name="filter" onchange="this.form.submit()" class="form-select w-auto d-inline-block">
            <option value="">Semua</option>
            <option value="0" {{ request('filter') === '0' ? 'selected' : '' }}>Belum Selesai</option>
            <option value="1" {{ request('filter') === '1' ? 'selected' : '' }}>Selesai</option>
        </select>
    </form>
</div>

<table class="table table-bordered bg-white">
    <thead class="table-light">
        <tr>
            <th>Tugasan</th>
            <th>Status</th>
            <th>Tarikh</th>
            <th>Tindakan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
        <tr>
            <td>{{ $task->title }}</td>
            <td>
                @if ($task->completed)
                    <span class="badge bg-success">Selesai</span>
                @else
                    <span class="badge bg-warning text-dark">Belum</span>
                @endif
            </td>
            <td>{{ $task->created_at->format('d M Y') }}</td>
            <td class="d-flex gap-2">
                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i>
                </a>

                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Padam tugasan?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
