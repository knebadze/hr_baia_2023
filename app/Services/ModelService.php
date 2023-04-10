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
        if ($auth->user_type_id == 1) {
            $result = $this->userModelRepository->candidate($auth->id);
        }elseif ($auth->user_type_id == 2) {
            $result = $this->userModelRepository->employer($auth->id);
        }
        return $result;
    }
    public function getWorkInformationModel()
    {
        $auth = Auth::user();
        $result = $this->workInformationModelRepository->model($auth->id);
        return $result;
    }
}
