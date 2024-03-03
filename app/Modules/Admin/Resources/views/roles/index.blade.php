@extends('admin::layouts.master')

@section('title')
    <i class="fa fa-user"></i> {{__('admin::roles.roles')}}
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page">
        {{__('admin::roles.roles')}}
    </li>
@endsection

@section('content')
    <div id="app" class="row">
        <div class="col-12">
            <roles-list></roles-list>
        </div>
    </div>
@endsection
