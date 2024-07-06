<?php

namespace App\Traits;

trait HandlesAdminDataViewUpdates
{
    /**
     * Update the view type of an admin data view entry.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $viewType
     * @return bool
     */
    public function updateViewType($model, $viewType)
    {
        if (!in_array($viewType, ['full', 'child'])) {
            throw new \InvalidArgumentException("Invalid view type: {$viewType}");
        }

        return $model->update(['view' => $viewType]);
    }

    /**
     * Update the permission type of an admin data view entry.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $permissionType
     * @return bool
     */
    public function updatePermissionType($model, $permissionType)
    {
        if (!in_array($permissionType, ['full', 'child'])) {
            throw new \InvalidArgumentException("Invalid permission type: {$permissionType}");
        }

        return $model->update(['permission' => $permissionType]);
    }
}
