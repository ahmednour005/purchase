<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark navbar-success sticky-top">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                   <img class="profile-photo-nav" src="{{ asset('Images/user_profile.png') }}" >
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                      <img class="profile-photo-dropdown" src="{{ asset('Images/user_profile.png') }}" >
                     <p class="profile-name-dropdown"> {{  Auth::user()->name }} </p>
                    <div class="dropdown-divider"></div>


                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        <i class="user-nav-icon float-right fas fa-sign-out-alt mr-2"></i> <span class=" float-right text-muted text-sm"> تسجيل خروج</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <div class="dropdown-divider"></div>
                </div>

            </li>

        <!--language -->
        <li class="nav-item dropdown">
        @if(LaravelLocalization::getCurrentLocale() == 'en')
        <a class="nav-link" data-toggle="dropdown" href="#">
           English  <i class="far fa-flag"> </i>

          </a>
        @elseif(LaravelLocalization::getCurrentLocale() == 'ar')
        <a class="nav-link" data-toggle="dropdown" href="#">
           العربية <i class="far fa-flag"></i>

          </a>
        @endif


          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode)  }}"
                 class="dropdown-item">
                    <span class="float-left text-muted text-sm">{{ $properties['native'] }}</span>

                   <img style=" width: 30px;
                   height: 20px;
                   float: right;
                   margin-top: 3px;" src="{{asset('Images/flag_img/'.$localeCode.'.png')}}" />

                </a>
                <div class="dropdown-divider"></div>
              @endforeach
          </div>
        </li>


        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>

