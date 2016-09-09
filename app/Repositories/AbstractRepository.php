<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

class AbstractRepository
{
    protected $model = "";

    /**
     * @return Model
     */
    public function createModel() {
        $model = $this->model;
        return new $model();
    }
}