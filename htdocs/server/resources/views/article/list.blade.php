{{ $paginate->links() }}

<ul>
    @foreach($paginate as $article)
        <li>
            <a href="{{ route('article.detail', ['article' => $article]) }}">
                {{ $article->title }}
            </a>
        </li>
    @endforeach
</ul>

{{ $paginate->links() }}
