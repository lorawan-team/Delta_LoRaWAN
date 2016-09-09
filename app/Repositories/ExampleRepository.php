<?php

namespace App\Repositories;

use App\Models\ExampleModel;

class ExampleRepository extends AbstractRepository implements ExampleRepositoryInterface
{
    protected $model = ExampleModel::class;
}