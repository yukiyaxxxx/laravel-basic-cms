@extends('layouts.base')

@section('main')

    {{ $paginate->links() }}

    <ul>
        @foreach($paginate as $article)
            <li>
                <a href="{{ route('article.detail', ['article' => $article]) }}">
                    [{{ $article->category->title }}]
                    {{ $article->title }}
                </a>
            </li>
        @endforeach
    </ul>

    {{ $paginate->links() }}

@stop
