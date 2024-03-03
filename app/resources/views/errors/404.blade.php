@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message')
    {{ __('errors.404')}}
    @if($exception->getMessage())
        <p>
            {{__($exception->getMessage())}}
        </p>
    @endif
@endsection
