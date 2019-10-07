<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--start bootstrap  -->
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- end bootstrap -->
    <link rel="stylesheet" href="{{asset('jquery-timepicker/jquery.timepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('datepicker/dist/css/bootstrap-datepicker.css')}}">

    <link href="{{asset('fullcalendar/packages/core/main.css')}}" rel='stylesheet' />
    <link href="{{asset('fullcalendar/packages/daygrid/main.css')}}" rel='stylesheet' />
    
    <link rel="stylesheet" href="{{asset('css/main.css')}}">


    

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

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
                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
    <div class="main-content">
        <div id="calendar"></div>
        <div id="personal-info">
            <div class="view">
                <div class="view-item">
                    <input type="radio" v-model="currentView" id="myEvents" value="myEvents">
                    <label for="myEvents">My Events</label>
                </div>
                <div class="view-item">
                    <input type="radio" v-model="currentView" id="eventsShared" value="eventsShared">
                    <label for="eventsShared">Events shared with me</label>
                </div>
                <div class="view-item">
                    <input type="radio" v-model="currentView" id="allEvents"  value="allEvents">
                    <label for="allEvents">All Events</label>
                </div>
            </div>
        </div>
    </div>
    @include('admin/events/create')
    @include('admin/events/edit')
    @include('admin/events/box')
    <!-- <div id="suggestUser">
        <div class="content">
            Click on date to create
        </div>        
        <button id="btnCloseSuggestUser">
            <i class="fas fa-times"></i>
        </button>
    </div> -->
    <div id="backgroundOverlay"></div>

    <!-- start Vuejs -->
     <script src="{{asset('js/vue.js')}}"></script>
     
    <!-- end Vuejs -->
    <!-- start moment.js -->
    <script src="{{asset('js/moment.min.js')}}"></script>
    <!-- end moment.js -->

    <!-- start axios -->
    <script src="{{asset('js/axios.min.js')}}"></script>
    <!-- end axios -->
    <!-- start jquery -->
    <script src="{{asset('js/jquery-3.3.1.slim.min.js')}}"></script>
    <!-- end jquery -->

    <!-- start bootstrap js -->
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- end bootstrap js -->
    
    <script src="{{asset('jquery-timepicker/jquery.timepicker.min.js')}}"></script>
    <script src="{{asset('datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- start fullcalendar js-->
    <script src="{{asset('fullcalendar/packages/core/main.js')}}"></script>
    <script src="{{asset('fullcalendar/packages/daygrid/main.js')}}"></script>
    <script src="{{asset('fullcalendar/packages/interaction/main.js')}}"></script>
    <!-- end fullcalendar js -->
    
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/extra.js')}}"></script>
</body>
</html>