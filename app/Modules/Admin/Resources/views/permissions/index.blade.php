@extends('admin::layouts.master')

@section('title')
    <i class="fa fa-lock"></i> {{__('admin::permissions.permissions')}}
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page">
        {{__('admin::permissions.permissions')}}
    </li>
@endsection

@section('content')
    <div id="app" class="row">
        <div class="col-12">
            <permissions-list></permissions-list>
        </div>
    </div>
@endsection
