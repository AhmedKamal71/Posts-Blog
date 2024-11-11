@extends('main.parent')

@section('content')
    <div class="container">
        <div class="card mt-5 shadow-sm">
            <div class="card-body">
                <h3 class="card-title mb-4 text-center">Edit Comment</h3>

                @if(Auth::id() === $comment->user_id || Auth::user()->is_admin)
                    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="content" class="form-label fw-bold">Comment</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" required>{{ old('content', $comment->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Update Comment</button>
                        </div>
                    </form>
                @else
                    <p class="text-muted text-center">You do not have permission to edit this comment.</p>
                @endif
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('posts.show', $comment->post_id) }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Post</a>
        </div>
    </div>
@endsection
