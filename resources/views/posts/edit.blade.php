<x-layouts.app title="Editing {{$post->title}}">
    <h1 class="title mb-2">Editing {{$post->title}}</h1>
    <div class="mb-4 text-sm font-bold">
        <p>Created at {{$post->created_at}}</p>
        <p>Updated at {{$post->updated_at}}</p>
    </div>
    <form action="{{route('posts.update', $post->id)}}" method="POST">
        @method('PATCH')
        @csrf
        <div class="mb-2">
            <label>Title</label>
            <input class="input" type="text" name="title" value="{{old('title', $post->title)}}">
            @error('title')
            <small class="error-feedback">{{$message}}</small>
            @enderror
        </div>
        <div class="mb-4">
            <label>Body</label>
            <textarea class="input h-48" name="body">{{old('body', $post->body)}}</textarea>
            @error('body')
            <small class="error-feedback">{{$message}}</small>
            @enderror
        </div>
        <div class="flex gap-4">
            <input class="button button-primary" type="submit" value="Submit">
            <a class="button button-danger" href="{{ route('posts.show', $post->id) }}">Cancel</a>
        </div>
    </form>
</x-layouts.app>
