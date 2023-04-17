<?php

namespace App\Services\Admin;

use App\Repositories\admin\HrRepository;

class HrService
{
    protected $hrRepository;

    public function __construct(HrRepository $hrRepository)
    {
        $this->hrRepository = $hrRepository;
    }

    public function addHr($data)
    {

        $result = $this->hrRepository->store($data);
        return $result;
    }

    public function updateHr($data)
    {

        $result = $this->hrRepository->update($data);
        return $result;
    }
}
