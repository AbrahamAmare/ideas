@extends('shared.layout')
@section('title', $user->name)
@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('helpers.success-messsage')
            <div class="mt-3">
                @include('ui.user-card')
                <hr>
                @forelse ($ideas as $idea)
                    <div class="mt-3">
                        @include('ui.idea-card')
                    </div>
                @empty
                    <p class="text-center my-3">No Results Found.</p>
                @endforelse
            </div>
        </div>
        <div class="col-3">
            @include('ui.search-card')
            @include('ui.follow-box')
        </div>
    </div>
@endsection
