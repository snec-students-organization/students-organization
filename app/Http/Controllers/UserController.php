<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UpcomingEvent; 
use App\Models\Student;
class UserController extends Controller
{
    // User dashboard
   

public function dashboard()
{
    $user = auth()->user();
    $message = null;

    // Fetch upcoming events starting today or later
    $upcomingEvents = UpcomingEvent::where('event_date', '>=', now())
                          ->orderBy('event_date', 'asc')
                          ->get();

    // Find the student matching the user's UID
    $student = Student::where('uid', $user->uid)->first();

    if ($student) {
        if ($student->status === 'verified') {
            $message = 'You are a member of our SSO family';
        } else {
            $message = 'Please pay the working fund and take the membership';
        }
    } else {
        $message = 'Your UID is not associated with any institution record.';
    }

    // Pass both variables to the view
    return view('user.dashboard', compact('message', 'upcomingEvents'));
}



    // Optional: Admin can list all users
    public function index()
    {
        $users = \App\Models\User::paginate(10);
        return view('admin.users.index', compact('users'));
    }
}

