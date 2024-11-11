@extends('main.parent')

@section('content')
    <div class="container">
        <h2 class="my-5 text-center">All Posts</h2>

        <div>
            <a href="{{ route('posts.create') }}" class="btn btn-success mb-3">
                <i class="fas fa-plus"></i> Add New Post
            </a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="bg-primary text-white">
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Author</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <th scope="row">{{ $post->id }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ Str::limit($post->content, 50) }}</td> <!-- Truncate content for better display -->
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->created_at->format('M d, Y') }}</td> <!-- Format date -->
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info me-2">
                                        <i class="fas fa-eye"></i> Show
                                    </a>

                                    @if(Auth::id() === $post->user_id)
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning me-2">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
