<!doctype html>
<html lang="en">

<head>
  <title>Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <!-- main css -->
  <link rel="stylesheet" type="text/css" href="{{ url('/css/main.css') }}" />
  <!-- Icons -->
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>


<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="/">
        <img src="{{ URL::to('/') }}/images/laravel-icon.png" class="laravel-icon" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      @if(Auth::check())
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <div class="d-flex align-items-center">
            <p class="m-0 fs-6 color-gray"> Welcome, {{ Auth::user()->name }}</p>
          </div>

        </ul>
        <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger" type="submit">Logout</button>
        </form>
      </div>
      @else
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item d-flex align-items-center">
            <button class="btn layout-nav-button">
              <a class="nav-link" href="{{ url('/') }}">Login</a>
            </button>
          </li>
          <li class="nav-item d-flex align-items-center ms-2">
            <button class="btn layout-nav-button">
              <a class="nav-link" href="{{ url('/register') }}">Register</a>
            </button>
          </li>
        </ul>
      </div>
      @endif
    </div>
  </nav>
  <div>
    @yield('content')
  </div>
</body>

</html>