<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PharIo\Manifest\Author;

class Vacancy extends Model
{
    use HasFactory;
    protected $fillable = [
        'code ',
        'uuid',
        'author_id',
        'hr_id',
        'title_ka',
        'title_en',
        'title_ru',
        'slug',
        'category_id ',
        'status_id ',
        'address_ka',
        'address_en',
        'address_ru',
        'payment',
        'currency_id ',
        'work_schedule_id',
        'additional_schedule_ka',
        'additional_schedule_en',
        'additional_schedule_ru',
        'start_date',
        'term_id',
        'comment',
        'go_vacation',
        'stay_night',
        'work_additional_hours',
        'interview_date',
        'interview_place_id',
        'view',
        'photo',
    ];
    protected $appends = ['hrInfo','timeAgo'];
    public function vacancyDuty()
    {
        return $this->belongsToMany(Duty::class, 'vacancy_candidate_duties');
    }
    public function vacancyBenefit()
    {
        return $this->belongsToMany(Benefit::class, 'vacancy_benefits');
    }
    public function vacancyForWhoNeed()
    {
        return $this->belongsToMany(ForWhoNeed::class, 'for_who_vacancies');
    }
    public function demand()
    {
        return $this->belongsTo(VacancyDemand::class, 'id', 'vacancy_id');
    }

    public function characteristic()
    {
        return $this->belongsToMany(GeneralCharacteristic::class, 'vacancy_candidate_characteristics',  'vacancy_id', 'characteristic_id');
    }
    public function author()
    {
        return $this->belongsTo(Employer::class);
    }
    public function employer()
    {
        return $this->belongsTo(Employer::class, 'author_id', 'id');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function workSchedule()
    {
        return $this->belongsTo(WorkSchedule::class);
    }
    public function hr()
    {
        return $this->belongsTo(Hr::class);
    }
    public function interviewPlace()
    {
        return $this->belongsTo(InterviewPlace::class);
    }
    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function vacancyInterest()
    {
        return $this->hasMany(QualifyingCandidate::class, 'vacancy_id', 'id')->where('qualifying_type_id', 2);
    }
    // public function forWhoNeed()
    // {
    //     return $this->belongsTo(ForWhoNeed::class, '');
    // }
    public function getHrInfoAttribute():array
    {
        $hr = Hr::where('id', $this->hr_id)->first()->toArray();
        $user = User::where('id', $hr['user_id'])->where('role_id', 2)->first()->toArray();
        return $user;
    }


    function getTimeAgoAttribute():string
    {

        $time = strtotime($this->created_at);
        $out    = ''; // what we will print out
        $now    = time(); // current time
        $diff   = $now - $time; // difference between the current and the provided dates

        if( $diff < 60 ) // it happened now
            return 'now';

        elseif( $diff < 3600 ) // it happened X minutes ago
            return str_replace( '{num}', ( $out = round( $diff / 60 ) ),'{num} წუთის წინ');
            // $out == 1 ? '{num} minute ago' : '{num} minutes ago' );

        elseif( $diff < 3600 * 24 ) // it happened X hours ago
            return str_replace( '{num}', ( $out = round( $diff / 3600 ) ),'{num} საათის წინ');
            // $out == 1 ? '{num} hour ago' : '{num} hours ago' );

        elseif( $diff < 3600 * 24 * 2 ) // it happened yesterday
            return 'yesterday';

        else // falling back on a usual date format as it happened later than yesterday
            // setlocale(LC_TIME, '	ka_GE.UTF-8');
            // dd(setlocale(LC_TIME, "de_DE"));
            return strftime( date( 'Y', $time ) == date( 'Y' ) ? '%e %B' : '%e %B, %Y', $time );
    }

     // This is the scope we added
    public function scopeFilter($query, $filters)
    {
    return $filters->apply($query);
    }

}
