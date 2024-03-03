@extends('admin::layouts.master')

@section('title')
    <i class="fa fa-user"></i> {{__('admin::users.users')}}
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page">
        {{__('admin::users.users')}}
    </li>
@endsection

@section('content')
    <div id="app" class="row">
        <div class="col-12">
            <users-list></users-list>
        </div>
    </div>
@endsection
