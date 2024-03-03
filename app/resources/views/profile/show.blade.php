@extends('layouts.main')

@section('title')
    <i class="fa fa-user"></i> {{__('Profile')}} {{$user->name}}
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item" aria-current="page"> {{__('User')}} </li>
    <li class="breadcrumb-item active" aria-current="page">
        {{$user->name}}
    </li>
@endsection

@section('content')
    <div id="app" class="row">
        <div class="col-12">

            <user-profile :user="{{$user}}"></user-profile>

        </div>
    </div>
@endsection
