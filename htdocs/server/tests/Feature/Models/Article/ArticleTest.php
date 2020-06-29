<?php

namespace Tests\Feature\Models\Article;

use App\Models\Article\Article;
use App\Models\Article\Category;
use DemeterChain\A;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 公開状態か のテスト
     */
    public function testIsPublish()
    {
        $article = new Article();
        $this->assertFalse($article->isPublish());

        $article->is_publish = 0;
        $this->assertFalse($article->isPublish());

        $article->is_publish = 1;
        $this->assertTrue($article->isPublish());
    }

    /**
     * カテゴリへのリレーションテスト
     */
    public function testRelationCategory()
    {
        // カテゴリ作成
        $category = new Category();
        $category->id = 1;
        $category->slug = 'category1';
        $category->title = 'カテゴリー１';
        $category->save();

        $category = new Category();
        $category->id = 2;
        $category->slug = 'category2';
        $category->title = 'カテゴリー２';
        $category->save();

        // カテゴリリレーション
        $article = new Article();
        $article->category_id = 2;
        $article->save();
        $this->assertEquals(2, $article->category->id);
    }


    /**
     * フォーマット済み日付の取得 のテスト
     */
    public function testGetFormatDate()
    {
        $article = new Article();
        $article->date = '2020-03-15 12:00:00';

        $this->assertEquals('2020-03-15 12:00:00', $article->getFormatDate('Y-m-d H:i:s'));
        $this->assertEquals('2020/03/15', $article->getFormatDate('Y/m/d'));
    }
}
