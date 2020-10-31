<?php

namespace App\Repositories;

use Yukiyaxxxx\LaravelSimpleRepository\Eloquent\BaseRepository;

class ExampleRepository extends BaseRepository
{
    protected function model()
    {
        /**
        * TODO: Setting eloquent model
        */
        return new ExampleModel();
    }


    /**
     * Example:
     * Get models method by email column.
     */
    public function getByEmail($email)
    {
        $query = $this->newQuery();
        return $query->where('email', '=', $email)->get();
    }


    /**
     * Example:
     * Find model method by email column.
     */
    public function findByEmail($email)
    {
        $query = $this->newQuery();
        return $query->where('email', '=', $email)->first();
    }

}

