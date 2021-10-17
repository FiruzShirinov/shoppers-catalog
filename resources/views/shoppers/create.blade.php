@extends('adminlte::page')
@section('plugins.BsCustomFileInput', true)
@section('title', 'Добавить покупателя')

@section('content')

<div class="row">
    <div class="col-6 mx-auto mt-5">
        <form action="{{ route('shoppers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-adminlte-input name="name" label="ФИО" placeholder="ФИО" label-class="text-secondary" value="{{ old('name') }}">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user text-muted"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-input name="phone" label="Телефон" placeholder="+12345678901" type="text" label-class="text-secondary" value="{{ old('phone') }}">
                <x-slot name="appendSlot">
                    <div class="input-group-text bg-secondary">
                        <i class="fas fa-hashtag"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-input name="email" label="Эл. почта" placeholder="test@example.com" label-class="text-secondary" value="{{ old('email') }}">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-envelope text-muted"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-input name="password" label="Пароль" type="password" label-class="text-secondary">
                <x-slot name="appendSlot">
                    <div class="input-group-text bg-secondary">
                        <i class="fas fa-hashtag"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-input-file name="image" label="Фотография" placeholder="Выберите файл..." label-class="text-secondary"/>

            <x-adminlte-button class="btn-block" type="submit" label="Сохранить" theme="success" icon="fas fa-lg fa-save"/>
        </form>
    </div>
</div>

@stop
