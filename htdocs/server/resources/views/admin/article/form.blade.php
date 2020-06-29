@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <form action="{{ $actionUrl }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label>
                                    タイトル
                                </label>
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                            </div>

                            <div class="form-group">
                                @foreach($categories as $category)
                                    <div class=" form-check form-check-inline">
                                        <label>
                                            <input type="radio" name="category_id" value="{{ $category->id }}" class="form-check-input"
                                                   @if(old('category_id') == $category->id) checked @endif>
                                            {{ $category->title }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label>
                                    記事日付
                                </label>
                                <input type="text" class="form-control" name="date" value="{{ old('date') }}">
                            </div>

                            <div class="form-group">
                                <label>
                                    本文
                                </label>
                                <textarea name="body" class="form-control" rows="10">{!! old('body') !!}</textarea>
                            </div>

                            <div class="form-group">
                                <div class=" form-check form-check-inline">
                                    <label>
                                        <input type="radio" name="is_publish" value="0" class="form-check-input"
                                               @if(0 == old('is_publish')) checked @endif>
                                        下書き
                                    </label>
                                </div>
                                <div class=" form-check form-check-inline">
                                    <label>
                                        <input type="radio" name="is_publish" value="1" class="form-check-input"
                                               @if(1 == old('is_publish')) checked @endif>
                                        公開
                                    </label>
                                </div>
                            </div>


                            <div class="form-group">
                                <button class="btn-primary form-control">
                                    保存する
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
