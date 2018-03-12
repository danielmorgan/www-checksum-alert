@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @include('checkers.create')
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-12">
                @include('checkers.index', ['checkers' => $checkers])
            </div>
        </div>
    </div>
@endsection
