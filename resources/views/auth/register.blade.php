<x-layouts.app title="Register">
    <h1 class="title mb-4">Register</h1>
    <form action="{{route('register')}}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="name">Name</label>
            <input class="input" type="text" id="name" name="name" value="{{old('name')}}">
            @error('name')
            <small class="error-feedback">{{$message}}</small>
            @enderror
        </div>
        <div>
            <label for="email">Email</label>
            <input class="input" type="email" id="email" name="email" value="{{old('email')}}">
            @error('email')
            <small class="error-feedback">{{$message}}</small>
            @enderror
        </div>
        <div>
            <label for="password">Password</label>
            <input class="input" type="password" id="password" name="password">
            @error('password')
            <small class="error-feedback">{{$message}}</small>
            @enderror
        </div>
        <div>
            <label for="password_confirmation">Password confirmation</label>
            <input class="input" type="password" id="password_confirmation" name="password_confirmation">
            @error('password_confirmation')
            <small class="error-feedback">{{$message}}</small>
            @enderror
        </div>
        <input class="button button-primary" type="submit" value="Submit">
        <p>Don you have an account? <a class="font-bold text-sky-700" href="{{route('login')}}">Login</a></p>
    </form>
</x-layouts.app>
