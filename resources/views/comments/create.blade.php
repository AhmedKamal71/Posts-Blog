{{-- resources/views/comments/create.blade.php --}}

@extends('main.parent')

@section('content')
    <div class="container">
        <div class="card mt-5 shadow-sm">
            <div class="card-body">
                <h2 class="card-title mb-3">Add Comment to "{{ $post->title }}"</h2>

                <form action="{{ route('comments.store', $post->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="content" class="form-label">Comment</label>
                        <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" rows="4" required></textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit Comment</button>
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
