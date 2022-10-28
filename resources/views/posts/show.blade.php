<x-layouts.app title="{{$post->title}}">
    @if(session('postStatus'))
        <div class="alert alert-success mb-4">
            {{session('postStatus')}}
        </div>
    @endif
    <div>
        <h1 class="title mb-2">{{$post->title}}</h1>
        <p>{{$post->body}}</p>
    </div>
    @auth
        <div class="flex gap-4 mt-4">
            <a class="button button-primary" href="{{route('posts.edit', $post->id)}}">Edit</a>
            <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <input class="button button-danger" type="submit" value="Delete">
            </form>
        </div>
    @endauth
</x-layouts.app>