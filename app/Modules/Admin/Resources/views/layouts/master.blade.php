@extends('layouts.main')

@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        Admin
    </li>
@endsection

@push('pre-js')
    <script>
        window.trans = {
            users:@json(@trans('admin::users')),
            roles:@json(@trans('admin::roles')),
            permissions:@json(@trans('admin::permissions'))
        }
    </script>
@endpush
