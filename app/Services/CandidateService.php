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
    public function candidateFile($data){
        // print_r('hello');
        // exit;
        $result = $this->candidateRepository->saveFile($data);
        return $result;
    }

    public function removeOldWorkExperience($data)
    {
        $result = $this->candidateRepository->removeOldWorkExperience($data);
        return $result;
    }
}
