@extends('layouts.app')

@section('content')
<div class="container">

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/quotes" method="post">
        <div class="form-group">
            <label for="title">Judul</label>
            <input class="form-control" value="{{ old('title') }}" type="text" name="title" id="title" placeholder="Input Judul">
        </div>
        <div class="form-group">
            <label for="subject">Isi Kutipan</label>
            <textarea name="subject" id="subject" cols="30" rows="10" class="form-control">{{ old('subject') }}</textarea>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
@endsection
