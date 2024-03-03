@extends('admin::layouts.master')

@section('title')
    <i class="fa fa-user"></i> {{__('admin::roles.role')}} {{$role->name}}
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{route('admin.roles')}}">
            {{__('admin::roles.roles')}}
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        {{ $role->name }}
    </li>
@endsection

@section('content')
    <div id="app" class="row">
        <div class="col-12">
            <roles-details :role_id="{!!  $roleId !!}"></roles-details>
        </div>
    </div>
@endsection
