@extends('layouts.app')

@section('title', 'Список покупателей')
@section('create_route', route('shoppers.create'))
@section('plugins.Datatables', true)

@section('content')
<div class="table-responsive">
    {!! $dataTable->table() !!}
</div>
@stop

@section('js')
{!! $dataTable->scripts() !!}
@stop
