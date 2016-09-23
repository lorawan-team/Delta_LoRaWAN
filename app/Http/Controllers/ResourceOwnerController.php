<?php

namespace App\Http\Controllers;

use App\Http\Transformers\UserTransformer;

class ResourceOwnerController extends Controller
{

    private $token;

    protected $transformer = UserTransformer::class;

    public function __construct()
    {
        //...
    }

    public function index() {

        $user = \Auth::user();

        return $this->response->item(
            $user,
            $this->createTransformer()
        );
    }
}
