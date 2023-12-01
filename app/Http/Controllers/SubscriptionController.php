<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        // Validate the request
        $request->validate([
            'data.email' => 'required|email|unique:subscribers,email', // Adjust the validation rules as needed
        ]);
        $subscribe = new Subscriber();
        $subscribe->email = $request->data['email'];
        $subscribe->save();
        return response()->json(['message' => 'Subscription successful']);
    }
}
