<?php

namespace App\Repositories\Article;

use App\Models\Article\Article;
use App\Repositories\Repository;
use BenSampo\Enum\Exceptions\InvalidEnumMemberException;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class RuleRepository
 * @package App\Repositories\Rule
 */
class ArticleRepository extends Repository
{
    /**
     * @return string
     */
    function model()
    {
        return Article::class;
    }

    /**
     *
     */
    public function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        // $this->with(Article::$withRelations);
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
        $this->resetRepository();

        return $this->where('is_publish', '=', 1)
            ->orderBy($orderBy, $asc)
            ->paginate($perPage);
    }

}
