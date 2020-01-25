<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">


  <title>@yield('title')</title>

  <!-- Bootstrap core CSS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"></script>
  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">
  @yield('styles')
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="/home">Vape Turf</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/home">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            E-liquid
            </a>
            <div class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('pages.collections') }}">All Products</a>
                @foreach ($categories as $category)
                <a class="dropdown-item" href="{{ route('pages.collections', ['category' => $category->name]) }}">{{ $category->name }}</a>
                @endforeach
            </div>
        </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <form class="form-inline ml-auto">
                <div class="md-form my-0">
                  <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                </div>
                <button href="#!" class="btn btn-outline-white btn-md my-0 ml-sm-2" type="submit">Search</button>
            </form>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('cart.index') }}">Cart</a>
          </li>
          <li>
            @if (Cart::instance('default')->count() > 0)
            <span class="badge badge-secondary">{{ Cart::instance('default')->count() }}</span>
            @endif
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    @yield('content')

  </div>
  <!-- /.container -->

  <!-- Footer -->
 <div style="padding:0px;"class="col-lg-12">
    <footer class="p-5 bg-dark">
        <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; VapeTurf 2019</p>
        </div>
        <!-- /.container -->
    </footer>
   </div>


  <!-- Bootstrap core JavaScript -->

  @include('sweetalert::alert')

</body>

@yield('script')
</html>
