<a href="/posts/create">Create Post</a>

@foreach($posts as $post)
    <h3>{{ $post->title }}</h3>
    <p>{{ $post->description }}</p>

    <a href="/posts/{{ $post->id }}/edit">Edit</a>

    <form action="/posts/{{ $post->id }}" method="POST">
        @csrf
        @method('DELETE')
        <button>Delete</button>
    </form>
@endforeach