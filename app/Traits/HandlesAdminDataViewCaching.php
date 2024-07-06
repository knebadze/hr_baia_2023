<?php

namespace App\Traits;

use App\Models\AdminDataView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

trait HandlesAdminDataViewCaching
{
    /**
     * Retrieve or cache indefinitely the AdminDataView data.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getAdminDataView()
    {
        $adminId = Auth::guard('staff')->id();
        return Cache::rememberForever('admin_data_view'.$adminId, function () use ($adminId) {
            return AdminDataView::where('admin_id', $adminId)->get();
        });
    }

    protected function getAdminDataViewByKeyAndUserId($key)
    {
        $adminDataView = $this->getAdminDataView();
        return $adminDataView->where('key', $key)->first();
    }
}
