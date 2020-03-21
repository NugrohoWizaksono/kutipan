@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <a href="/quotes/random" class="btn btn-primary">Random</a>
            <a href="/quotes/create" class="btn btn-primary">Create</a>
        </div>
    </div>
    <div class="row">
        @foreach ($quotes as $quote)
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $quote->title }}</h5>
                    <p class="card-text">......</p>
                    <a href="/quotes/{{ $quote->slug }}" class="card-link">Lihat Kutipan</a>
                </div>
            </div>
          </div>
        @endforeach
    </div>
</div>
@endsection
