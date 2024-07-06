<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Blacklist extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'employer_id',
        'ground_id',
        'author_id',
        'comment'
    ];

    public function getActivitylogOptions(): LogOptions
    {

        $logOptions = LogOptions::defaults([])->logFillable()->logOnlyDirty();

        return $logOptions;
    }
     // User relationship
     public function user()
     {
        return $this->belongsTo(User::class, 'user_id');
     }

     // Employer relationship
     public function employer()
     {
         // Assuming Employer is a model. Replace 'Employer' with 'User' if it's the same model as User
        return $this->belongsTo(Employer::class, 'employer_id');
     }

     // Ground relationship
     public function ground()
     {
        return $this->belongsTo(BlacklistGround::class, 'ground_id');
     }

     // Author relationship
     public function author()
     {
         // Assuming Author is a User
        return $this->belongsTo(User::class, 'author_id');
     }
}
