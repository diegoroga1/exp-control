@extends('layouts.main')
@section('title')
    <i class="fas fa-fw fa-coins"></i> {{__('Transactions')}}
@endsection

@section('content')

    <div id="app">
        <transaction-navbar></transaction-navbar>
        <transactions-list></transactions-list>
        <new-transaction-floating-button></new-transaction-floating-button>
    </div>

@endsection
