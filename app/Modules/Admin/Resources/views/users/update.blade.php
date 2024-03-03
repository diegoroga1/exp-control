@extends('admin::layouts.master')

@section('title')
    <i class="fa fa-user"></i> {{__('admin::users.update_user')}}: {{$user->name}}
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{route('admin.users')}}">
            {{__('admin::users.users')}}
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        {{$user->name}}
    </li>
@endsection

@section('content')
    <div id="app" class="row">
        <div class="col-12">

                    <user-form :user="{{ json_encode($user_json) }}"></user-form>

        </div>
    </div>
@endsection
