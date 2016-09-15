<?php

namespace App\Http\Controllers\Devices;

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

    public function __construct(RoleRepositoryInterface $measurementRepository)
    {
        $this->measurementRepository = $measurementRepository;
    }

    public function index() {
        $result = $this->measurementRepository->createModel();

        return $this->response->item(
            $result,
            $this->createTransformer()
        );
    }

    public function show() {
        //... TODO
    }

    public function store() {
        //... TODO
    }

    public function update() {
        //... TODO
    }

    public function destroy() {
        //... TODO
    }
}
