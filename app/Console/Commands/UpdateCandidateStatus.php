<?php

namespace App\Console\Commands;

use App\Models\Candidate;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\QualifyingCandidate;

class UpdateCandidateStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:candidate-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update candidate statuses based on specific date comparison';
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $periodEmploy = QualifyingCandidate::whereDate('end_date', '<', Carbon::today())->where('qualifying_type_id', 7)->with('workDay')->get()->toArray();
        foreach ($periodEmploy as $key => $value) {
            if (in_array(Carbon::today()->toDateString(), json_decode($value['work_day']['work_day']))) {
                if (!Candidate::where('id', $value['candidate_id'])->where('status_id', 11)) {
                    Candidate::where('id', $value['candidate_id'])->update(['status_id' => 11]);
                }
            }else{
                if (Candidate::where('id', $value['candidate_id'])->where('status_id', 11)) {
                    Candidate::where('id', $value['candidate_id'])->update(['status_id' => 9]);
                }
            }
        }

        return Command::SUCCESS;
    }
}
