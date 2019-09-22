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
    <div id="calendar"></div>
    @include('admin/events/create')
    @include('admin/events/edit')
    @include('admin/events/box')
    <div id="suggestUser">
        <div class="content">
            Click on date to create
        </div>        
        <button id="btnCloseSuggestUser">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div id="backgroundOverlay"></div>

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
   
</body>
</html>