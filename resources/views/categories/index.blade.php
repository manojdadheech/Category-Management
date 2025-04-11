@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Category List</h2>
            @auth
                @if (auth()->user()->is_admin)
                    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">+ Add Category</a>
                @endif
            @endauth
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Category Path</th>
                        <th>Status</th>
                        <th>Parent ID</th>
                        <th>Created Date</th>
                        <th>Updated Date</th>
                        @auth
                            @if (auth()->user()->is_admin)
                                <th>Actions</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $cat)
                        <tr>
                            <td>{{ $cat->id }}</td>
                            <td>{{ $cat->full_path }}</td>
                            <td>
                                <span class="badge {{ $cat->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $cat->status == 1 ? 'Enabled' : 'Disabled' }}
                                </span>
                            </td>
                            <td>{{ $cat->parent_id ?? '—' }}</td>
                            <td>{{ $cat->created_at->format('d M Y, h:i A') }}</td>
                            <td>{{ $cat->updated_at ? $cat->updated_at->format('d M Y, h:i A') : '—' }}</td>
                            @auth
                                @if (auth()->user()->is_admin)
                                    <td>
                                        <a href="{{ route('categories.edit', $cat->id) }}"
                                            class="btn btn-sm btn-warning me-1">Edit</a>
                                        <form action="{{ route('categories.destroy', $cat->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')"
                                                class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                @endif
                            @endauth

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
