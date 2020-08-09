<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property string slug
 * @property string title
 *
 * Class Category
 * @package App\Models\Article
 */
class Category extends Model
{
    protected $table = 'article_categories';

    protected $fillable = [
        'slug',
        'title',
    ];

}
