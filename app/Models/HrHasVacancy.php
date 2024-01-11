<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HrHasVacancy extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'hr_id',
        'has_vacancy',
        're_write',
        'is_active',
    ];
    public function hr()
    {
        return $this->belongsTo(Hr::class, 'hr_id', 'id');
    }

    public function getActiveAttribute()
    {
        return $this->hr();
    }


}
