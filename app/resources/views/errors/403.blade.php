@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message')
    {{ __('errors.403')}}
    @if($exception->getMessage())
        <p>
            {{__($exception->getMessage())}}
        </p>
    @endif
@endsection
