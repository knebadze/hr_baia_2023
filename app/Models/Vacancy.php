<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;
    protected $fillable = [
        'author_id ',
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
        'for_who_ka',
        'for_who_en',
        'for_who_ru',
        'comment',
        'additional_ka',
        'additional_en',
        'additional_ru',
        'provider_token',
        'photo',
    ];
    protected $appends = ['hrInfo'];
    public function vacancyDutySkill()
    {
        return $this->belongsToMany(Skill::class, 'vacancy_candidate_duties');
    }
    public function characteristic()
    {
        return $this->belongsToMany(GeneralCharacteristic::class, 'vacancy_candidate_characteristics',  'vacancy_id', 'characteristic_id');
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
    public function getHrInfoAttribute():array
    {
        $hr = Hr::where('id', $this->hr_id)->first()->toArray();
        $user = User::where('id', $hr['user_id'])->where('role_id', 2)->first()->toArray();
        return $user;
    }
}
