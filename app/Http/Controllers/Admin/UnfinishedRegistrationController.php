<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UnfinishedRegistration;
use App\Services\ClassificatoryService;
use App\Http\Resources\UnfinishedRegistrationCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Staff\UnfinishedRegistrationResource;
use App\Filters\unFinishedRegistration\UnFinishedRegistrationFilters;

class UnfinishedRegistrationController extends Controller
{
    function index() {
        return view('admin.unfinished_registration');
    }

    function fetch() {
        $query = UnfinishedRegistration::where('status_id', 2)->when(Auth::user()->role_id != 1, function ($query) {
            $query->where('was_assigned_id', '=', Auth::id());
        });
        $unfinished = $query->paginate(20);
        $unfinished = new UnfinishedRegistrationCollection($unfinished);
        $total = $query->count();
        $classificatoryArray = ['status', 'unfinishedRegistrationAuthor', 'administrator'];
        $classificatoryService = new ClassificatoryService();
        $classificatory = $classificatoryService->get($classificatoryArray);

        $data = ['unfinishedRegistrations' => $unfinished, 'total' => $total, 'role_id' => Auth::user()->role_id, 'classificatory' => $classificatory];
        return response()->json($data);
    }

    function completed(Request $request) {
        try {
            $unfinished = UnfinishedRegistration::findOrFail($request->id);
            $checkUser = $this->checkUser($unfinished->user_id);

            if (!$checkUser) {
                return response()->json(['message' => 'You are not authorized to complete this registration'], 403);
            }

            $unfinished->update(['status_id' => 4]);
            return response()->json(['message' => 'რეგისტრაცია დასრულებულია']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Unfinished registration not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while completing the registration'], 500);
        }
    }

    private function checkUser($user_id) {
        $user = User::findOrFail($user_id);
        if ($user->candidate && $user->candidate->stage >= 6) {
            return true;
        }
        return false;
    }

    function filter(UnFinishedRegistrationFilters $filters) {
        try {
            $query = UnfinishedRegistration::filter($filters)
                ->orderBy('id', 'ASC');
            $total = $query->count();
            $unfinished = $query->paginate(20);
            $unfinishedRegistrations = new UnfinishedRegistrationCollection($unfinished);
            $data = [
                'total' => $total,
                'unfinishedRegistrations' => $unfinishedRegistrations
            ];
            return response()->json($data);
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

}
