<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kognise/water.css@latest/dist/light.min.css">

    <style>
        .error {
            color: #f00;
        }

        .gnav ul {
            display: flex;
            margin-bottom: 30px;
        }


        .gnav li {
            margin-right: 30px;
        }

        .pagination {
            display: flex;
            padding: 30px 0;
        }

        .pagination li {
            padding-right: 10px;
        }


        ul, li {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .paginate {
            display: flex;
        }

        /*.articleList li {*/
        /*    list-style-type: none !important;*/
        /*}*/

    </style>

</head>
<body>

<h1>
    <a href="/">
        {{ config('app.name') }}
    </a>
</h1>

<nav class="gnav">
    <ul>
        <li>
            <a href="{{ route('welcome') }}">ホーム</a>
        </li>
        <li>
            <a href="{{ route('article.list') }}">記事一覧</a>
        </li>
        <li>
            <a href="{{ route('inquiry.form') }}">問い合わせ</a>
        </li>
    </ul>
</nav>

<main>
    @yield('main')
</main>
<hr>

</body>
</html>
