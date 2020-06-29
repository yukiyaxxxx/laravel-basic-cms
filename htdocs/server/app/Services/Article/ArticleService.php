<?php

namespace App\Services\Article;

use App\Models\Article\Article;

class ArticleService
{

    /**
     * 新規作成
     *
     * @param array $values
     * @return Article
     */
    public function create(array $values)
    {
        $article = new Article();

        $article->category_id = $values['category_id'];
        $article->title = $values['title'];
        $article->body = $values['body'];
        $article->date = $values['date'];
        $article->is_publish = $values['is_publish'];
        $article->save();

        return $article;
    }


    /**
     * 更新
     *
     * @param Article $article
     * @param array $values
     * @return Article
     */
    public function update(Article $article, array $values)
    {
        $article->category_id = $values['category_id'];
        $article->title = $values['title'];
        $article->body = $values['body'];
        $article->date = $values['date'];
        $article->is_publish = $values['is_publish'];
        $article->save();

        return $article;
    }

}
