@extends('main.parent')

@section('content')
    <div class="post-show">
        <h2>{{ $post->title }}</h2>
        <p><strong>Author:</strong> {{ $post->user->name }}</p>
        <p><strong>Created At:</strong> {{ $post->created_at->format('d M Y') }}</p>
        
        <div class="post-content">
            <p>{{ $post->content }}</p>
        </div>

        <div class="mt-3">
            <a href="{{ route('posts.index') }}" class="btn btn-primary">Back to Posts</a>
            @if(Auth::id() === $post->user_id)
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success">Edit Post</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</button>
                </form>
            @endif
        </div>
    </div>
@endsection
