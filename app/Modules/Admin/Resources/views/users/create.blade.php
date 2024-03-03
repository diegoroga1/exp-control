@extends('admin::layouts.master')

@section('title')
    <i class="fa fa-user"></i> {{__('admin::users.new_user')}}
@endsection


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{route('admin.users')}}">
            {{__('admin::users.users')}}
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        {{__('admin::users.new_user')}}
    </li>
@endsection

@section('content')
    <div id="app" class="row">
        <div class="col-12">

                    <user-form></user-form>

        </div>
    </div>
@endsection
