<?php

namespace App\Services;

use App\Repositories\CandidateRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;


class CandidateService
{
    protected $candidateRepository;

    public function __construct(CandidateRepository $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
    }

    public function candidateSaveData($data)
    {
        // $validator = Validator::make($data,[

        // ]);
        // if ($validator->fails()) {
        //     throw new InvalidArgumentException($validator->errors());
        // }
        $result = $this->candidateRepository->save($data);
        return $result;
    }
}
