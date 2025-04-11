@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">{{ isset($category) ? 'Edit Category' : 'Add Category' }}</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form 
        action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" 
        method="POST" 
        class="border p-4 rounded bg-light shadow-sm"
    >
        @csrf
        @if(isset($category))
            @method('PUT')
        @endif

        @include('categories._form')

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">← Back</a>
            <button type="submit" class="btn btn-success">
                {{ isset($category) ? 'Update Category' : 'Create Category' }}
            </button>
        </div>
    </form>
</div>
@endsection
