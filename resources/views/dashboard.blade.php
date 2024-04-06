@extends('shared.layout')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            @include('helpers.success-messsage')
            @include('ui.share-idea')
            <hr>
            @forelse ($ideas as $idea)
                <div class="mt-3">
                    @include('ui.idea-card')
                </div>
            @empty
                <p class="text-center my-3">No Results Found.</p>
            @endforelse
            <div class="mt-3">
                {{ $ideas->withQueryString()->links() }}
            </div>
        </div>
        <div class="col-3">
            @include('ui.search-card')
            @include('ui.follow-box')
        </div>
    </div>
@endsection
