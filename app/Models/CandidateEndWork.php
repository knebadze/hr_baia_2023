<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateEndWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'qualifying_candidate_id',
        'candidate_id',
        'no_reason_id',
        'reason_info',
        'user_id',
        'created_at',
        'updated_at',
    ];
    public function qualifyingCandidate()
    {
        return $this->belongsTo(QualifyingCandidate::class);
    }
    // Relationship to the Candidate model
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    // Relationship to the NoReason model (assuming there is a model for the reasons)
    public function noReason()
    {
        return $this->belongsTo(NoReason::class);
    }

    // Relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
