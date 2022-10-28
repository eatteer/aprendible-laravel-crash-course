<x-layouts.app title="Login">
    <h1 class="title mb-4">Login</h1>
    <form action="{{route('login')}}" method="POST" class="space-y-4">
        @csrf
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
        <div class="flex items-center gap-2">
            <label class="mb-0" for="remember_me">Remember me</label>
            <input type="checkbox" id="remember_me" name="remember_me">
        </div>
        <input class="button button-primary" type="submit" value="Submit">
        <p>Don't you have an account? <a class="font-bold text-sky-700" href="{{route('register')}}">Register</a></p>
    </form>
</x-layouts.app>
