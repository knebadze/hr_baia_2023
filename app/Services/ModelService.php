<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Basic\UserModelRepository;
use App\Repositories\Basic\WorkInformationModelRepository;

class ModelService
{
    protected UserModelRepository $userModelRepository;
    private WorkInformationModelRepository $workInformationModelRepository;

    public function __construct()
    {
        $this->userModelRepository = new UserModelRepository();
        $this->workInformationModelRepository = new WorkInformationModelRepository();
    }

    public function getUserModel()
    {
        $auth = Auth::user();
        $result = $this->userModelRepository->candidate($auth->id);

        return $result;
    }
    public function getWorkInformationModel()
    {
        $auth = Auth::user();
        $result = $this->workInformationModelRepository->model($auth->id);
        return $result;
    }
}
