@extends('admin::layouts.master')

@section('title')
    <i class="fa fa-user"></i> {{__('admin::permissions.permission')}} <b>{{$permission->name}}</b>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{route('admin.permissions')}}">
            {{__('admin::permissions.permissions')}}
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        {{ $permission->name }}
    </li>
@endsection

@section('content')
    <div id="app" class="row">
        <div class="col-12">
            <permission-details :permission_id="{!!  $permissionId !!}"></permission-details>
        </div>
    </div>
@endsection
