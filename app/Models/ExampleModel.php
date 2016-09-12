<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExampleModel extends Model implements ExampleModelInterface
{
    protected $test = 'basic string';

    public function getTest()
    {
        return $this->test;
    }


}
