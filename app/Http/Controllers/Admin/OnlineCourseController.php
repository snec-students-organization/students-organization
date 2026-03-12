<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\OnlineCourseAttendance;

use App\Models\OnlineCourseSetting;

class OnlineCourseController extends Controller
{
    public function index()
    {
        $students = Student::whereHas('onlineCourseRegistration')
            ->withCount('onlineCourseAttendances')
            ->with('onlineCourseRegistration')
            ->latest()
            ->paginate(10);

        $meetingLink = OnlineCourseSetting::where('key', 'class_room_link')->value('value');

        return view('admin.online-course.index', compact('students', 'meetingLink'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'class_room_link' => 'nullable|url',
        ]);

        OnlineCourseSetting::updateOrCreate(
            ['key' => 'class_room_link'],
            ['value' => $request->class_room_link]
        );

        return redirect()->route('admin.online-course.index')
            ->with('success', 'Class Room link updated successfully.');
    }
}
