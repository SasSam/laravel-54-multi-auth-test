@extends('layouts.app')


@section('content')
    <p>
        <a href="{{ route('employee.dashboard') }}">Employee</a>
    </p>
    <p>
        <a href="{{ route('customer.dashboard') }}">Customers</a>
    </p>
@stop
