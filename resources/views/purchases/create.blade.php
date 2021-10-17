@extends('adminlte::page')
@section('plugins.Select2', true)
@section('title', 'Добавить товар')

@section('content')

<div class="row">
    <div class="col-6 mx-auto mt-5">
        <form action="{{ route('purchases.store') }}" method="POST">
            @csrf

            <x-adminlte-select2 name="shopper_id" label="Покупатель" label-class="text-muted"
                data-placeholder="Выберите покупателя...">
                <x-slot name="prependSlot">
                    <div class="input-group-text text-muted">
                        <i class="fas fa-user"></i>
                    </div>
                </x-slot>
                @foreach ($shoppers as $shopper)
                    <option value="{{ $shopper->id }}">{{ $shopper->name }}</option>
                @endforeach
            </x-adminlte-select2>

            <x-adminlte-select2 name="product_ids[]" label="Продукты" label-class="text-muted"
                data-placeholder="Выберите продукты покупки..." multiple>
                <x-slot name="prependSlot">
                    <div class="input-group-text text-muted">
                        <i class="fas fa-gift"></i>
                    </div>
                </x-slot>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </x-adminlte-select2>

            <x-adminlte-button class="btn-block" type="submit" label="Сохранить" theme="success" icon="fas fa-lg fa-save"/>
        </form>
    </div>
</div>

@stop
