<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Transformers\UserTransformer;
use Delta\DeltaVerification\Users\UserRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class UserController
 * @package App\Http\Controllers\Users
 * @Resource("User")
 */
class UserController extends Controller
{

    private $userRepository;

    protected $transformer = UserTransformer::class;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * Show a specific user
     *
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function show($id)
    {
        $result = $this->userRepository->findById($id);

        return $this->response->item(
            $result,
            $this->createTransformer()
        );
    }
}
