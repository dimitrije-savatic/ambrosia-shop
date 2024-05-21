<!-- Navbar start -->
<div class="container-fluid fixed-top">
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{route('home')}}" class="navbar-brand"><h1 class="text-primary display-6">Ambrosia</h1></a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    @foreach($menu as $link)
                        <a href="{{route($link->route)}}"
                           class="nav-item nav-link @if(request()->routeIs($link->route)) active @endif">{{$link->name}}</a>
                    @endforeach
                </div>
                <div class="d-flex m-3 me-0">
                    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role_id == 2)
                        <a href="/admin" class="my-auto me-4" title="Admin Panel">
                            <i class="fa-solid fa-gear fa-2x"></i>
                        </a>
                    @endif
                        <a href="{{route('products.cart')}}" class="position-relative me-3 my-auto" title="Cart">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">{{$counter}}</span>
                        </a>
                    @if(!\Illuminate\Support\Facades\Auth::check())
                        <a href="/login" class="my-auto" title="Login">
                            <i class="fas fa-user fa-2x"></i>
                        </a>
                    @else
                        <div class="nav-item">
                            <form action="{{route('logout')}}" method="POST" id="logoutFrom">
                                @csrf
                                <a href="#" class="nav-link"
                                   onclick="event.preventDefault(); document.getElementById('logoutFrom').submit();"
                                   title="{{\Illuminate\Support\Facades\Auth::user()->first_name}}">
                                    <i class="fa-regular fa-user fa-2x"></i> (Logout)</a>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->
