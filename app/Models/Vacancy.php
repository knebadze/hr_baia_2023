<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Vacancy extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
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
    // protected $appends = ['timeAgo'];
    public function vacancyDuty()
    {
        return $this->belongsToMany(Duty::class, 'vacancy_candidate_duties');
    }
    public function vacancyBenefit()
    {
        return $this->belongsToMany(Benefit::class, 'vacancy_benefits');
    }
    public function vacancyDrivingLicense()
    {
        return $this->belongsToMany(DrivingLicense::class, 'vacancy_driving_licenses');
    }
    public function getVacancyDrivingLicense()
    {
        return $this->belongsTo(VacancyDrivingLicense::class, 'id', 'vacancy_id');
    }
    public function vacancyForWhoNeed()
    {
        return $this->belongsToMany(ForWhoNeed::class, 'for_who_vacancies');
    }
    public function demand()
    {
        return $this->belongsTo(VacancyDemand::class, 'id', 'vacancy_id');
    }

    public function getCharacteristic()
    {
        return $this->belongsTo(VacancyCandidateCharacteristic::class, 'id', 'vacancy_id');
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
    public function deposit()
    {
        return $this->belongsTo(VacancyDeposit::class, 'id', 'vacancy_id');
    }



     // This is the scope we added
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

}
