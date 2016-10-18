<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\RoleStoreRequest;
use App\Http\Requests\Roles\RoleUpdateRequest;
use App\Http\Transformers\RoleTransformer;
use App\Jobs\StoreRole;
use Delta\DeltaService\Roles\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

/**
 * Class RoleController
 * @package App\Http\Controllers\Roles
 * @Resource("Role")
 */
class RoleController extends Controller
{

    private $roleRepository;

    protected $transformer = RoleTransformer::class;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * List all roles
     *
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $result = $this->roleRepository->findAll();

        return $this->response->collection(
            $result,
            $this->createTransformer()
        );
    }

    /**
     * Show a specific role
     *
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function show($id)
    {
        $result = $this->roleRepository->findById($id);

        return $this->response->item(
            $result,
            $this->createTransformer()
        );
    }

    /**
     * Add a new role
     *
     * @param RoleStoreRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        $requestArray = $request->all();
        $this->dispatch((new StoreRole($requestArray))->onQueue('role-queue'));

        return $this->response->created();
    }

    /**
     * Update a given role
     *
     * @param $id
     * @param RoleUpdateRequest $request
     * @return \Dingo\Api\Http\Response|void
     */
    public function update($id, RoleUpdateRequest $request)
    {
        try {
            $model = $this->roleRepository->findById($id);

            $this->roleRepository->update($model, $request->all());

            return $this->response->accepted();
        } catch (ModelNotFoundException $exception) {
            return $this->response->error("the role with the given ID does not exist", 404);
        }

    }

    /**
     * Delete a Role
     *
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->roleRepository->deleteById($id);
            return $this->response->noContent();
        } catch (QueryException $e) {
            return $this->response->error("Could not delete the role as it is still being used", 409);
        }


    }
}
