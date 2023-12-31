  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="/" class="nav-link">Home Web</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="#" class="nav-link">Contact</a>
          </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

          <li class="nav-item">
              <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
              </a>
          </li>

        <!-- Logout nav-item -->
          <li class="nav-item mr-3">
              <a class="nav-link text-danger" href="{{route('logout')}}"
                  onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                      class="fas fa-power-off"></i> Logout</a>
              <form action="{{route('logout')}}" id="logout-form" method="POST" style="display: none;">
                  @csrf

              </form>
          </li>
      </ul>
  </nav>
  <!-- /.navbar -->