<?php

namespace App\Http\Controllers\Roles;

use App\Http\Requests\Roles\RoleStoreRequest;
use App\Http\Requests\Roles\RoleUpdateRequest;
use App\Http\Controllers\Controller;
use Delta\DeltaService\Roles\RoleRepositoryInterface;
use App\Http\Transformers\RoleTransformer;

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
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function index($id) {
        $result = $this->roleRepository->findAll($id);

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
    public function show($id) {
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
    public function store(RoleStoreRequest $request) {

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
    public function update($id, RoleUpdateRequest $request) {
        $model = $this->roleRepository->findById($id);

        if(! isset($model)) {
            return $this->response->error('Role not found', 404);
        }

        $this->roleRepository->update($model, $request->all());

        return $this->response->accepted();
    }

    /**
     * Delete a Role
     *
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function destroy($id) {
        $this->roleRepository->deleteById($id);

        return $this->response->noContent();
    }
}
