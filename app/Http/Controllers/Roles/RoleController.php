<?php

namespace App\Http\Controllers\Roles;

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

    public function index() {
        $result = $this->roleRepository->createModel();

        return $this->response->item(
            $result,
            $this->createTransformer()
        );
    }

    public function show() {
        //... TODO
    }

    public function store() {

        return $this->response->created();
    }

    public function update() {
        //... TODO
    }

    public function destroy() {
        return $this->response->noContent();
    }
}
