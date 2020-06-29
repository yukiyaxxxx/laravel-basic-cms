<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;


abstract class Repository extends BaseRepository
{
    /**
     * 初期化
     *
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function resetRepository()
    {
        $this->resetModel();
        $this->boot();
    }

    /**
     * l5-repositoryのfindはデフォルトではfindOrFailなので上書く
     *
     * @param $id
     * @param array $columns
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function find($id, $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->find($id, $columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * findOrFailは明示的に使用する。
     *
     * @param $id
     * @param array $columns
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function findOrFail($id, $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->findOrFail($id, $columns);
        $this->resetModel();

        return $this->parserResult($model);
    }


}