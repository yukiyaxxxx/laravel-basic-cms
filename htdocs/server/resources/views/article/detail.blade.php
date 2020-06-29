@extends('layouts.base')


@section('main')
    <section>
        <h3>
            {{ $article->title }}
        </h3>

        <p>
            {{ $article->getFormatDate('Y.m.d') }}
        </p>

        <div>
            {!! nl2br($article->body) !!}
        </div>
    </section>
@endsection
