<header>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('news') }}">Портал новостей</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('news') }}">Главная
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>

                    @if(Auth::user())
                        <li class="nav-item d-flex align-items-center justify-content-center">
                            <span> <a href="{{ route('admin.account') }}" class="text-decoration-none text-white">{{ Auth::user()->name }}</a> /</span>
                        </li>
                        <li class="nav-item m-0 d-flex align-items-center justify-content-center">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn-group btn">
                                    <i class="fa fa-sign-out text-white" aria-hidden="true"></i>
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item d-flex align-items-center justify-content-center">
                            <a class="nav-link text-white" href="{{ route('login') }}">
                                <i class="fa fa-sign-in" aria-hidden="true"></i>
                            </a>
                        </li>
                    @endif


                </ul>
            </div>
        </div>
    </nav>
</header>
