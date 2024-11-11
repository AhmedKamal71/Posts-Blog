@extends('main.parent')

@section('content')
    <div class="container">
        <!-- Post Details -->
        <div class="card mt-5 shadow-sm">
            <div class="card-body">
                <h2 class="card-title mb-3">{{ $post->title }}</h2>
                
                <p><strong>Author:</strong> {{ $post->user->name }}</p>
                <p><strong>Created At:</strong> {{ $post->created_at->format('d M Y') }}</p>

                <div class="post-content my-4">
                    <p>{{ $post->content }}</p>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Posts</a>
                    @if(Auth::id() === $post->user_id)
                        <div>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success me-2"><i class="fas fa-edit"></i> Edit Post</a>
                            <button type="button" class="btn btn-danger" onclick="confirmDeletion({{ $post->id }})">
                                <i class="fas fa-trash-alt"></i> Delete Post
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="my-3 text-end mt-5">
            <a href="{{ route('comments.create', $post) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Comment
            </a>
        </div>

        @include('comments.index', ['comments' => $post->comments])
    </div>

    <form id="delete-post-{{ $post->id }}" action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>
    <form id="delete-comment-form" action="" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>
    <script>
        function confirmDeletion(postId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-post-${postId}`).submit();
                }
            });
        }

        function confirmCommentDeletion(commentId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('delete-comment-form');
                    form.action = `/comments/${commentId}`;
                    form.submit();
                }
            });
        }
    </script>
@endsection
