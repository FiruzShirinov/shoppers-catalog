@extends('layouts.app')

@section('title', 'Список продуктов')
@section('create_route', route('products.create'))
@section('content')

<div class="table-responsive">
    {!! $dataTable->table() !!}
</div>
@stop

@section('js')
{!! $dataTable->scripts() !!}
@stop

