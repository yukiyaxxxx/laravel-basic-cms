<?php

namespace App\Repositories\Article;

use App\Models\Article\Article;
use App\Repositories\Repository;
use BenSampo\Enum\Exceptions\InvalidEnumMemberException;

// use Prettus\Repository\Eloquent\BaseRepository;
use Yukiyaxxxx\LaravelSimpleRepository\Eloquent\BaseRepository;

/**
 * Class RuleRepository
 * @package App\Repositories\Rule
 */
class ArticleRepository extends BaseRepository
{
    /**
     * @return string
     */
    function model()
    {
        return new Article();
    }


    /**
     * 公開用ページネーションを取得
     *
     * @param int $perPage
     * @param string $asc
     * @param string $orderBy
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */


    public function getPaginatePublish($perPage = 20, string $orderBy = 'date', string $asc = 'DESC')
    {
        $query = $this->newQuery();
        return $query->where('is_publish', '=', 1)
            ->orderBy($orderBy, $asc)
            ->paginate($perPage);
    }


    /**
     * 管理画面用ページネーションを取得
     *
     * @param int $perPage
     * @param string $asc
     * @param string $orderBy
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getPaginateAdmin($perPage = 20, string $orderBy = 'date', string $asc = 'DESC')
    {
        $query = $this->newQuery();
        return $query->with($this->model()->withRelations)
            ->orderBy($orderBy, $asc)
            ->paginate($perPage);
    }
}
