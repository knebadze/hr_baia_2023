<?php

namespace App\Services\Admin;

use App\Repositories\Admin\StaffRepository;

class StaffService
{
    protected $staffRepository;

    public function __construct(StaffRepository $staffRepository)
    {
        $this->staffRepository = $staffRepository;
    }

    public function addStaff($data)
    {

        $result = $this->staffRepository->store($data);
        return $result;
    }

    public function updateStaff($data)
    {

        $result = $this->staffRepository->update($data);
        return $result;
    }
}
