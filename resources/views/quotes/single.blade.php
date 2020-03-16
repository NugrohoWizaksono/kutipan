@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="jumbotron">
        <h1>{{ $quote->title }}</h1>
        <p>{{ $quote->subject }}</p>
        <p>Ditulis oleh : {{ $quote->user->name }}</p>
        @if ($quote->isOwner())
            <a href="/quotes/{{ $quote->id }}/edit" class="btn btn-primary">Edit</a>
            <form action="/quotes/{{ $quote->id }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" value="DELETE" name="_method">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        @endif
    </div>
    <a href="/quotes" class="btn btn-success"> Kembali ke halaman quotes</a>
</div>
@endsection
