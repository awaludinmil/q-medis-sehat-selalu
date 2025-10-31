@extends('layouts.display')

@section('content')
    @livewire('display.loket-board', ['loketId' => $loketId])
@endsection
