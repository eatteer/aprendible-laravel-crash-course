<x-layouts.app title="Posts">
    @if(session('postStatus'))
        <div class="alert alert-success mb-4">
            {{session('postStatus')}}
        </div>
    @endif

    <div class="flex justify-between items-center mb-5">
        <h1 class="title">Last entries</h1>
        @auth
            <a class="button button-primary" href="{{route('posts.create')}}">Create post</a>
        @endauth
    </div>
    <div class="flex flex-col gap-6">
        @foreach($posts as $post)
            <a class="p-4 shadow-md border border-stone-300 rounded bg-white transition-all hover:scale-105 "
               href="{{route('posts.show', $post->id)}}">
                <div class="flex justify-between mb-2">
                    <h3 class="text-xl font-bold">{{$post->title}}</h3>
                    <time class="text-xs text-slate-700 font-bold">{{$post->created_at->format('d/m/Y')}}</time>
                </div>
                <p class="text-sm line-clamp-4">{{$post->body}}</p>
            </a>
        @endforeach
    </div>
</x-layouts.app>
