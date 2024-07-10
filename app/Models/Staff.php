<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Model implements AuthenticatableContract
{
    use HasFactory, Notifiable, Authenticatable;
    protected $table = 'staff';

    protected $fillable = [
        'role_id',
        'parent_id',
        'name_ka',
        'name_en',
        'name_ru',
        'email',
        'number',
        'date_of_birth',
        'gender_id',
        'avatar',
        'password',
        'verify_code',
        'person_number',
        'mobile',
        'inside_number',
        'bonus_percent',
        'fixed_salary',
        'branch_id',
        'internship',
        'fb_link',
        'is_active',
        'status',
        'verify_code_date'
    ];

    protected $hidden = [
        'password', 'verify_code',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        // 'internship' => 'boolean',
        // 'is_active' => 'boolean',
        'bonus_percent' => 'float',
        'fixed_salary' => 'integer',
        'branch_id' => 'integer',
        'status' => 'integer',
        'email_verified_at' => 'datetime',
    ];

    public function parent()
    {
        return $this->belongsTo(Staff::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Staff::class, 'parent_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function gender()
    {
        return $this->belongsTo(gender::class, 'gender_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function dataViews()
    {
        return $this->hasMany(AdminDataView::class, 'admin_id');
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class, 'staff_id');
    }
}
