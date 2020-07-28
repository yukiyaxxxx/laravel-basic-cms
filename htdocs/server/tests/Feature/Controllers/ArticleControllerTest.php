<?php

namespace Tests\Feature\Controllers;

use App\Models\Article\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 記事の公開非公開ミドルウェアのテスト
     */
    public function testPublishedMiddleware()
    {
        $article = new Article();
        $article->title = 'title';
        $article->body = 'body';
        $article->is_publish = 1;
        $article->save();

        $response = $this->get(route('article.detail', ['article' => $article]));
        $response->assertStatus(200);
        $response->assertSee('title');
        $response->assertSee('body');

        // 非公開化
        $article->is_publish = 0;
        $article->save();

        $response = $this->get(route('article.detail', ['article' => $article]));
        // dump($response->getContent());
        $response->assertStatus(404);
    }

}
