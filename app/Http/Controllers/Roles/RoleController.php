<?php

namespace App\Http\Controllers\Roles;

use App\Http\Requests\Roles\RoleIndexRequest;
use App\Http\Requests\Roles\RoleStoreRequest;
use App\Http\Requests\Roles\RoleUpdateRequest;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Transformers\DeviceTransformer;
use Delta\DeltaService\Devices\DeviceRepositoryInterface;
use App\Http\Controllers\Controller;
use Delta\DeltaService\Measurements\MeasurementRepositoryInterface;
use App\Http\Transformers\MeasurementTransformer;
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
     * @param RoleIndexRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function index(RoleIndexRequest $request) {
        $userId = $request->get("account_id");

        $result = $this->roleRepository->findAll($userId);

        return $this->response->collection(
            $result,
            $this->createTransformer()
        );
    }

    /**
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
     * @param RoleStoreRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(RoleStoreRequest $request) {

        $requestArray = $request->all();
        $this->dispatch((new StoreRole($requestArray))->onQueue('role-queue'));

        return $this->response->created();
    }

    /**
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
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function destroy($id) {
        $this->roleRepository->deleteById($id);

        return $this->response->noContent();
    }
}
