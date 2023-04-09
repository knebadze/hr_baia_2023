<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Basic\ModelRepository;

class ModelService
{
    protected $modelRepository;

    public function __construct(ModelRepository $modelRepository)
    {
        $this->modelRepository = $modelRepository;
    }

    public function getModel()
    {
        $auth = Auth::user();
        if ($auth->user_type_id == 1) {
            $result = $this->modelRepository->candidate($auth->id);
        }elseif ($auth->user_type_id == 2) {
            $result = $this->modelRepository->employer($auth->id);
        }
        

        return $result;

    }
}
