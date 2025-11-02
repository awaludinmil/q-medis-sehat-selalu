@extends('layouts.admin')

@section('content')
    @livewire('lokets.show', ['id' => $loketId])
@endsection
