<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="version" value="{{config('app.version')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{env('APP_NAME')}}</title>

    <!-- Custom fonts for this template-->
    {{--    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('/css/theme.css')}}" rel="stylesheet">
    <link href="{{asset('/css/app.css')}}" rel="stylesheet">
    @stack('css')
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
@include('layouts.partials.sidebar')
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
        @include('layouts.partials.topbar')
        <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

{{--            @include('layouts.partials.breadcrumb')--}}

            <!-- Page Heading -->
{{--                <div class="d-sm-flex align-items-center justify-content-between mb-4">--}}
{{--                    <h1 class="h3 mb-0 text-gray-800">--}}
{{--                        @yield('title')--}}
{{--                    </h1>--}}
{{--                </div>--}}

                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
    @include('layouts.partials.footer')
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('messages.logout-confirm.title')}}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">{{__('messages.logout-confirm.message')}}</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">{{__('Cancel')}}</button>
                <a class="btn btn-primary" href="{{route('logout')}}">{{__('Logout')}}</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script>
    window.lang = '{{session('locale')}}'
    window.userAdmin = {{ auth()->user()->isAdmin() ? 'true' : 'false' }}
    window.userPermissions = JSON.parse('{!! json_encode(auth()->user()->getAllPermissions()->pluck('name')->toArray() ?? []) !!}')
</script>
@stack('pre-js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{mix('/js/manifest.js')}}"></script>
<script src="{{mix('/js/vendor.js')}}"></script>
<script src="{{mix('/js/app.js')}}"></script>
<script src="{{asset('/js/theme.js')}}"></script>
@include('partials.ErrorMessageJS')
@stack('js')
</body>

</html>
