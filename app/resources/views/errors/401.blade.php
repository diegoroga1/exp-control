@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message')
    {{ __('errors.401')}}
    @if($exception->getMessage())
        <p>
            {{__($exception->getMessage())}}
        </p>
    @endif
@endsection
