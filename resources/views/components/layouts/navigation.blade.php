<nav class="p-4 border-b border-stone-300 bg-white">
    <div class="flex flex-col gap-4 max-w-5xl mx-auto md:flex-row md:justify-between">
        <div class="flex flex-col gap-4 font-medium md:flex-row">
            <a class="nav-item {{request()->routeIs('home') ? 'active' : null}}"
               href="{{route('home')}}"
            >
                Home
            </a>
            <a class="nav-item {{request()->routeIs('posts.*') ? 'active' : null}}"
               href="{{route('posts.index')}}"
            >
                Posts
            </a>
            <a class="nav-item {{request()->routeIs('about') ? 'active' : null}}"
               href="{{route('about')}}"
            >
                About
            </a>
            <a class="nav-item {{request()->routeIs('contact') ? 'active' : null}}"
               href="{{route('contact')}}"
            >
                Contact
            </a>

        </div>
        <div class="flex flex-col gap-4 md:flex-row">
            @guest
                <a class="button button-primary flex-grow"
                   href="{{route('login')}}"
                >
                    Login
                </a>
                <a class="button button-primary flex-grow"
                   href="{{route('register')}}"
                >
                    Register
                </a>
            @endguest
            @auth
                <form action="{{route('logout.destroy')}}" method="POST">
                    @csrf
                    <input type="submit" class="button button-primary w-full" value="Logout">
                </form>

            @endauth
        </div>
    </div>
</nav>
