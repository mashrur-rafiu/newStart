<form action="/posts" method="POST">
    @csrf
    <input type="text" name="title" placeholder="title">
    <textarea name="description" placeholder="description"></textarea>
    <button>Create</button>
</form>