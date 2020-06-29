@extends('layouts.base')


@section('main')

    <h3>
        {{ $article->title }}
    </h3>


    <div>
        {!! nl2br($article->body) !!}
    </div>

@endsection
