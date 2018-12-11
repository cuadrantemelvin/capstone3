<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FriendBits</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.15/css/mdb.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    FriendBit
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <ul class="navbar-nav mr-auto">
                        @auth
                        <li class="nav-menu"><a class="nav-link" href="{{url('/home')}}">Newsfeed</a></li>
                       
                        <li class="nav-menu"><a class="nav-link" href="{{url('/profile')}}/{{Auth::user()->slug}}">TimeLine</a></li>
                        <li class="nav-menu"><a class="nav-link" href="{{url('/requests')}}">Friend Requests <span class="badge" style="background: red;"  >{{App\Friendship::where('status',0)
                            ->where('user_requested', Auth::user()->id)->count()}}</span>

                        </a></li>
                        <li class="nav-menu"><a class="nav-link" href="{{url('/friends')}}">Friends</a></li>

                        <li class="nav-menu dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown" 
                               role="button" aria-expanded="false">
                                <i class="fa fa-globe fa-2x" aria-hidden="true"></i>
                                <span class="badge" 
                                      style="background:red; position: relative; top: -15px; left:-10px">
                                {{App\Notification::where('status', 1)
                                    ->where('user_hero', Auth::user()->id)
                                    ->count()}}
                                </span>
                            </a>
                               @php 
                               $notes = DB::table('users')
                                    ->leftJoin('notifications', 'users.id', 'notifications.user_logged')
                                    ->where('user_hero', Auth::user()->id)
                                    ->where('status', 1) //unread notifications
                                    ->orderBy('notifications.created_at', 'desc')
                                ->get();
                               @endphp
                               <div class="row justify-content-around">
                                <ul class="dropdown-menu" role="menu">
                                   @foreach($notes as $note)
                                   
                                   <li class="nav-item dropdown"> 
                                     <a href="{{url('/notifications')}}/{{$note->id}}" class="dropdown-item"><strong style="color:green">
                                    <div class="row">
                                        <div class="col-md-2">
                                        <img src="{{$note->pic}}" style="height: 50px; width: 50px;">
                                        </div>
                                        <div class="col-md-10">
                                       {{ucwords($note->name)}}</strong> {{$note->note}}
                                        </div>
                                    </div>
                                    </a>
                                   </li>
                                       
                                  
                                   @endforeach
                               </ul>
                               </div>
                            </li>
                        @endauth
                      
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                            <img src="{{Auth::user()->pic}}" style="width: 50px; height: 50px; border-radius: 50%;" >
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ ucfirst(Auth::user()->name) }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                     <a class="dropdown-item" href="{{url('/findFriends')}}">Find Friends</a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
    <script>
        var token = '{{ Session::token() }}';

        var urlLike = '{{ route('like') }}';
       
    </script>
</body>
</html>
