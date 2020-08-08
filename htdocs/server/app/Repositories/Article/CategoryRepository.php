<?php

namespace App\Repositories\Article;

use App\Models\Article\Category;
use App\Repositories\Repository;
use BenSampo\Enum\Exceptions\InvalidEnumMemberException;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class RuleRepository
 * @package App\Repositories\Rule
 */
class CategoryRepository extends Repository
{
    /**
     * @return string
     */
    function model()
    {
        return Category::class;
    }

}
