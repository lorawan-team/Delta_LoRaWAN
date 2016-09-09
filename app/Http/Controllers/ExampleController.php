<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repositories\ExampleRepositoryInterface;

class ExampleController extends BaseController
{

    private $example;

    public function __construct(ExampleRepositoryInterface $example)
    {
        $this->example = $example;
    }

    public function index() {
        //dd(app());
        return response($this->example->createModel());
        //return response("Example Controller");
    }

}