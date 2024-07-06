<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminDataView;

class AdminDataViewController extends Controller
{
    public function updateView($id)
    {
        $adminDataView = AdminDataView::findOrFail($id);
        $adminDataView->updateViewType($adminDataView, 'child');

        // Return response or redirect
    }

    public function updatePermission($id)
    {
        $adminDataView = AdminDataView::findOrFail($id);
        $adminDataView->updatePermissionType($adminDataView, 'full');

        // Return response or redirect
    }
}
