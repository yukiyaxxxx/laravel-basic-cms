<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property string category_id
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
        'category_id',
        'title',
        'body',
        'date',
        'is_publish',
    ];

    // public $withRelations = [
    // ];

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
        return $this->hasOne(Category::class, 'id', 'category_id')->withDefault();
    }

    /**
     * フォーマット済み日付の取得
     *
     * @param string $format
     * @return string|null
     */
    public function getFormatDate($format = 'Y-m-d H:i')
    {
        if (null == $this->date) {
            return null;
        }

        return \Carbon::parse($this->date)->format($format);
    }

}
