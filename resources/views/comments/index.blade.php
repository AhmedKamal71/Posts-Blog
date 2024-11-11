{{-- resources/views/comments/index.blade.php --}}

<div class="card mt-4 shadow-sm">
    <div class="card-body">
        <h4 class="mb-3">Comments</h4>

        @forelse($comments as $comment)
            <div class="border rounded p-3 mb-3">
                <p><strong>{{ $comment->user->name }}</strong> 
                   <small class="text-muted">{{ $comment->created_at->format('d M Y, H:i') }}</small>
                </p>
                <p>{{ $comment->content }}</p>

                <!-- Edit/Delete buttons for Post Owner -->
                @if(Auth::id() === $post->user_id)
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-primary me-2">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmCommentDeletion({{ $comment->id }})">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </div>
                @endif
            </div>
        @empty
            <p class="text-muted">No comments yet.</p>
        @endforelse
    </div>
</div>
