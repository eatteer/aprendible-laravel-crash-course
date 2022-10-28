<x-layouts.app title="Create post">
    <x-back-button></x-back-button>
    <h1 class="title mb-4">Create post</h1>
    <form action="{{route('posts.store')}}" method="POST">
        @csrf
        <div class="mb-2">
            <label>Title</label>
            <input class="input" type="text" name="title" value="{{old('title')}}">
            @error('title')
            <small class="error-feedback">{{$message}}</small>
            @enderror
        </div>
        <div class="mb-4">
            <label>Body</label>
            <textarea class="input h-48" name="body">{{old('body')}}</textarea>
            @error('body')
            <small class="error-feedback">{{$message}}</small>
            @enderror
        </div>
        <div class="flex gap-4">
            <input class="button button-primary" type="submit" value="Submit">
            <a class="button button-danger" href="{{route('posts.index')}}">Cancel</a>
        </div>
    </form>
</x-layouts.app>
