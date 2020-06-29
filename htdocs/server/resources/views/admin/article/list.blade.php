@extends('layouts.app')


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
                                        <button class="btn btn-primary">
                                            編集
                                        </button>
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
