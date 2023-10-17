  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="/" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="#" class="nav-link">Contact</a>
          </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-comments"></i>
                  <span class="badge badge-danger navbar-badge">{{$countmessages}}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                  @foreach($showmessages as $message)
                  <div class="dropdown-divider"></div>
                  <a href="{{route('admin.messages')}}" class="dropdown-item">
                      <!-- Message Start -->
                      <div class="media">
                          <div class="media-body">
                              <h3 class="dropdown-item-title">
                                  {{$message->name}}
                                  <span class="float-right text-sm text-success"><i class="fas fa-star"></i></span>
                              </h3>
                              <p class="text-sm">{{$message->comment}}</p>
                              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                  {{$message->created_at}}
                              </p>
                          </div>
                      </div>
                      <!-- Message End -->
                  </a>
                  @endforeach
                  <div class="dropdown-divider"></div>
                  <a href="{{route('admin.messages')}}" class="dropdown-item dropdown-footer"> See
                      Messages</a>
              </div>
          </li>

          <li class="nav-item">
              <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
              </a>
          </li>


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