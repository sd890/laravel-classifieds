<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'دیوار' )</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="shortcut icon" href="{{url('panel/assets/media/image/favicon.png')}}">
    <meta name="theme-color" content="#5867dd">
    <link rel="stylesheet" href="{{url('panel/vendors/bundle.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('panel/vendors/slick/slick.css')}}">
    <link rel="stylesheet" href="{{url('panel/vendors/slick/slick-theme.css')}}">
    <link rel="stylesheet" href="{{url('panel/vendors/vmap/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{url('panel/assets/css/app.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('panel/vendors/select2/css/select2.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('panel/plugins/sweet_alert/sweetalert2.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('panel/plugins/colorpicker/css/bootstrap-colorpicker.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('panel/plugins/datepicker/kamadatepicker.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('panel/plugins/dropzone/css/dropzone.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('css/custom.css')}}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about_us.css')}}">
</head>
<body>

    {{-- منوی سایت --}}
    @include('web.layout.partials.navbar')

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/site.js') }}"></script>
     <script src="{{url('js/custom.js')}}"></script>
<script src="{{url('panel/vendors/bundle.js')}}"></script>
<script src="{{url('panel/vendors/select2/js/select2.min.js')}}"></script>
<script src="{{url('panel/plugins/sweet_alert/sweetalert2.all.min.js')}}"></script>
<script src="{{url('panel/plugins/colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{url('panel/plugins/colorpicker/js/colorpicker.js')}}"></script>
<script src="{{url('panel/plugins/datepicker/kamadatepicker.min.js')}}"></script>
<script src="{{url('panel/plugins/ckeditor/ckeditor.js')}}"></script>
<script src="{{url('panel/plugins/dropzone/js/dropzone.js')}}"></script>
<script src="{{url('panel/vendors/slick/slick.min.js')}}"></script>
<script src="{{url('panel/vendors/vmap/jquery.vmap.min.js')}}"></script>
<script src="{{url('panel/assets/js/app.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> <!-- برای تب ها-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
