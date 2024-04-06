@extends('shared.layout')
@section('title', 'Idea')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('helpers.success-messsage')
            <div class="mt-3">
                @include('ui.idea-card')
            </div>

        </div>
        <div class="col-3">
            @include('ui.search-card')
            @include('ui.follow-box')
        </div>
    </div>
@endsection
