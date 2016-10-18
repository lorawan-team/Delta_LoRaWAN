<?php

namespace App\Jobs;

use Delta\DeltaService\Roles\RoleRepositoryInterface;


class StoreRole extends Job
{

    /**
     * @var array
     */
    protected $data;

    /**
     * Bind instances to the class
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle(RoleRepositoryInterface $roleRepository) {
        $roleRepository->store($this->data);
    }
}