<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Delta\DeltaService\Example\ExampleRepositoryInterface;
use App\Http\Transformers\ExampleTransformer;

class ExampleController extends Controller
{

    private $example;

    protected $transformer = ExampleTransformer::class;

    public function __construct(ExampleRepositoryInterface $example)
    {
        $this->example = $example;
    }

    public function index() {
        $result = $this->example->createModel();

        return $this->response->item(
            $result,
            $this->createTransformer()
        );
    }

}
