<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string category_slug
 * @property string title
 * @property string body
 * @property string date
 * @property boolean is_publish
 * @property Category category
 *
 * Class Article
 * @package App\Models\Article
 */
class Article extends Model
{
    protected $table = 'article_articles';

    protected $fillable = [
        'category_slug',
        'title',
        'body',
        'date',
        'is_publish',
    ];


    /**
     * 公開状態か
     *
     * @return bool
     */
    public function isPublish()
    {
        return 1 == $this->is_publish;
    }

    /**
     * カテゴリリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(Category::class, 'slug', 'category_slug')->withDefault();
    }

}
