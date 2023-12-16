{{--<div>
    <nav class="navbar navbar-expand-sm navbar-dark bg-warning p-3">
        <a class="navbar-brand" href="/">Oven</a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="/" aria-current="page">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Your Orders</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/create">Log in</a>
                    </li>
                @endguest
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="#">Fast food</a>
                        <a class="dropdown-item" href="#">Home food</a>
                    </div>
                </li>
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle bg-success text-light" style="border-radius: 10px" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{auth()->user()->email}}</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="{{route('logout')}}">Log out</a>
                        <a class="dropdown-item" href="#">Modifier</a>
                    </div>
                </li>
                @endauth
            </ul>
            <form class="d-flex my-2 my-lg-0">
                <input class="form-control me-sm-2" type="text" placeholder="Search">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</div>
--}}
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Oven</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
            @guest                      
                <li class="nav-item">
                    <a class="nav-link" href="/create">Your order</a>
                </li>
            @endguest
            @auth                            
                <li class="nav-item">
                    <a class="nav-link" href="/panier">Your order</a>
                </li>
            @endauth
          @guest                  
            <li class="nav-item">
                <a class="nav-link" href="/create">Log in</a>
            </li>
          @endguest
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Menu
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/fast_food">Fast food</a></li>
              <li><a class="dropdown-item" href="/home_food">Home food</a></li>
            </ul>
          </li>
          @auth              
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{auth()->user()->email}}
                </a>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('logout')}}">Log out</a></li>
                <li><a class="dropdown-item" href="#">Modifier</a></li>
                </ul>
            </li>
          @endauth
        </ul>
        {{--<form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>--}}
      </div>
    </div>
  </nav>