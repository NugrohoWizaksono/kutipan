@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-offset-md-3">
            <h1>{{ $user->name }}</h1>
            <ul class="list-group">
                @foreach ($user->quotes as $quote)
                    <li class="list-group-item">
                        <a href="/quotes/{{ $quote->slug }}">{{ $quote->title }}</a>
                    </li>                    
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
