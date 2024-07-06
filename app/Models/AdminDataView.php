<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HandlesAdminDataViewUpdates;

class AdminDataView extends Model
{
    use HasFactory, HandlesAdminDataViewUpdates;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'admin_id',
        'key',
        'view',
        'permission',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'view' => 'string',
        'permission' => 'string',
    ];

    /**
     * Get the admin that owns the data view.
     */
    public function admin()
    {
        return $this->belongsTo(Staff::class, 'admin_id');
    }
}
