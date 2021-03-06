<?php

namespace Tests\Feature\Repositories\Article;

use App\Models\Article\Article;
use App\Repositories\Article\ArticleRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $repository;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->repository = app()->make(ArticleRepository::class);
    }

    /**
     * 公開用ページネーションを取得 のテスト
     */
    public function testGetPaginatePublish()
    {
        $article = new Article();
        $article->id = 1;
        $article->date = '2020-01-15 12:00:00';
        $article->is_publish = 1;
        $article->save();

        // 非公開記事
        $article = new Article();
        $article->id = 2;
        $article->date = '2020-01-15 12:00:00';
        $article->is_publish = 0;
        $article->save();

        $article = new Article();
        $article->id = 3;
        $article->date = '2020-01-16 12:00:00';
        $article->is_publish = 1;
        $article->save();

        $article = new Article();
        $article->id = 4;
        $article->date = '2020-01-17 12:00:00';
        $article->is_publish = 1;
        $article->save();

        $articles = $this->repository->getPaginatePublish(10);
        $this->assertEquals([4, 3, 1], $articles->pluck('id')->toArray());

        $articles = $this->repository->getPaginatePublish(10, 'date', 'ASC');
        $this->assertEquals([1, 3, 4], $articles->pluck('id')->toArray());
    }


    /**
     * 管理ページネーションを取得 のテスト
     */
    public function testGetPaginateAdmin()
    {
        $article = new Article();
        $article->id = 1;
        $article->date = '2020-01-14 12:00:00';
        $article->is_publish = 1;
        $article->save();

        // 非公開記事
        $article = new Article();
        $article->id = 2;
        $article->date = '2020-01-15 12:00:00';
        $article->is_publish = 0;
        $article->save();

        $article = new Article();
        $article->id = 3;
        $article->date = '2020-01-16 12:00:00';
        $article->is_publish = 1;
        $article->save();

        $article = new Article();
        $article->id = 4;
        $article->date = '2020-01-17 12:00:00';
        $article->is_publish = 1;
        $article->save();

        $articles = $this->repository->getPaginateAdmin(10);
        $this->assertEquals([4, 3, 2, 1], $articles->pluck('id')->toArray());

        $articles = $this->repository->getPaginateAdmin(10, 'date', 'ASC');
        $this->assertEquals([1, 2, 3, 4], $articles->pluck('id')->toArray());
    }

}
