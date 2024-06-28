<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacancy extends Model
{
    use LogsActivity, HasFactory;
    protected $fillable = [
        'code ',
        'author_id',
        'hr_id',
        'title_ka',
        'title_en',
        'title_ru',
        'slug',
        'category_id',
        'status_id',
        'address_ka',
        'address_en',
        'address_ru',
        'payment',
        'currency_id',
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
        'reason_for_cancel_id'
    ];
    protected $casts = [
        'created_at' => 'datetime:m-d-Y H:i',
        'updated_at' => 'datetime:m-d-Y H:i',
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone(config('app.timezone'))->format('Y-m-d H:i');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone(config('app.timezone'))->format('Y-m-d H:i');
    }
    public function getActivitylogOptions(): LogOptions
    {
        $additionalArray  = ['category.name_ka', 'currency.name_ka', 'status.name_ka', 'workSchedule.name_ka', 'hr.user.name', 'term.name_ka', 'reasonForCancel.name_ka', 'interviewPlace.name_ka'];
        $combinedArray = array_merge($this->fillable, $additionalArray);
        $logOptions = LogOptions::defaults()
        ->logOnly($combinedArray)
        ->logOnlyDirty()
        ->dontLogIfAttributesChangedOnly(['view']);

        return $logOptions;
    }

    // belongsToMany
    public function vacancyDuty()
    {
        return $this->belongsToMany(Duty::class, 'vacancy_candidate_duties');
    }
    public function syncVacancyDuty($item)
    {
        $this->syncRelationship('vacancyDuty',  $item, 'duty');
    }

    public function vacancyBenefit()
    {
        return $this->belongsToMany(Benefit::class, 'vacancy_benefits');
    }
    public function syncVacancyBenefit($item)
    {
        $this->syncRelationship('vacancyBenefit', $item, 'benefit');
    }

    public function vacancyDrivingLicense()
    {
        return $this->belongsToMany(DrivingLicense::class, 'vacancy_driving_licenses');
    }
    public function syncVacancyDrivingLicense($item)
    {
        $this->syncRelationship('vacancyDrivingLicense', $item, 'driving_license');
    }

    public function vacancyForWhoNeed()
    {
        return $this->belongsToMany(ForWhoNeed::class, 'for_who_vacancies');
    }
    public function syncVacancyForWhoNeed($item)
    {
        $this->syncRelationship('vacancyForWhoNeed', $item, 'for_who_need');
    }

    public function characteristic()
    {
        return $this->belongsToMany(GeneralCharacteristic::class, 'vacancy_candidate_characteristics',  'vacancy_id', 'characteristic_id');
    }
    public function syncCharacteristic($item)
    {
        $this->syncRelationship('characteristic', $item, 'characteristic');
    }

    public function syncRelationship($relationship, $item, $type)
    {
        $beforeSync = $this->{$relationship}()->pluck("{$type}_id")->toArray();
        $this->{$relationship}()->sync($item);
        $afterSync = $this->{$relationship}()->pluck("{$type}_id")->toArray();
        $this->syncActiveLog($beforeSync, $afterSync, $this, $type);
    }



    // sync active log

    public function syncActiveLog($beforeSync, $afterSync, $that, $type)  {


        $difference_old_to_new = array_diff($beforeSync, $afterSync);
        $difference_new_to_old = array_diff($afterSync, $beforeSync);

        $difference = array_merge($difference_old_to_new, $difference_new_to_old);
        // dd($difference);
        if (!empty($difference)) {
            activity()
                ->performedOn($that)
                ->withProperties([
                    'old' => $beforeSync,
                    'attributes' => $afterSync,
                ])
                ->log('Sync_'.$type);
        }
    }

    public function getVacancyDrivingLicense()
    {
        return $this->hasMany(VacancyDrivingLicense::class, 'vacancy_id', 'id');
    }

    public function demand()
    {
        return $this->hasOne(VacancyDemand::class, 'vacancy_id', 'id');
    }

    public function getCharacteristic()
    {
        return $this->hasMany(VacancyCandidateCharacteristic::class, 'vacancy_id', 'id');
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
    public function qualifyingCandidate()
    {
        return $this->hasMany(QualifyingCandidate::class, 'vacancy_id', 'id');
    }

    public function qualifyingCandidatePluckCandidateId()
    {
        return $this->hasMany(QualifyingCandidate::class, 'vacancy_id', 'id')->pluck('candidate_id');
    }

    public function vacancyInterest()
    {
        return $this->hasMany(QualifyingCandidate::class, 'vacancy_id', 'id')->where('qualifying_type_id', 2);
    }
    public function deposit()
    {
        return $this->belongsTo(VacancyDeposit::class, 'id', 'vacancy_id');
    }
    public function reasonForCancel()
    {
        return $this->belongsTo(ReasonForCancel::class, 'reason_for_cancel_id', 'id');
    }



     // This is the scope we added
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

}
