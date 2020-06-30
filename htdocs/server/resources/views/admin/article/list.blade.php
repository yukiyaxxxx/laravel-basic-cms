@extends('layouts.app')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">ホーム</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ route('admin.article.list') }}">
                記事一覧
            </a>
        </li>
    </ol>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">記事一覧</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ $paginate->links() }}

                        <a href="{{ route('admin.article.create') }}" class="btn btn-primary mb-4">
                            + 新規作成
                        </a>

                        <table class="table">

                            <tr>
                                <th>タイトル</th>
                                <th>カテゴリ</th>
                                <th>記事日付</th>
                                <th>操作</th>
                            </tr>

                            @foreach($paginate as $article)
                                <tr>
                                    <td>
                                        {{ $article->title }}
                                    </td>
                                    <td>
                                        {{ $article->category->title }}
                                    </td>
                                    <td>
                                        {{ $article->date }}
                                    </td>
                                    <td>

                                        <div class="btn-group">
                                            <a href="{{ route('admin.article.edit', ['article' => $article->id]) }}">
                                                <button class="btn btn-primary mr-2">
                                                    編集
                                                </button>
                                            </a>

                                            <form action="{{ route('admin.article.destroy', ['article' => $article->id]) }}" method="POST"
                                                  onSubmit="if(!confirm('本当に削除しますか？')){return false;}">
                                                @csrf
                                                <button class="btn btn-danger">
                                                    削除
                                                </button>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        {{ $paginate->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
