<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FeatureFlag;
use App\Models\Student;
use App\Models\OnlineCourseRegistration;
use App\Models\OnlineCourseAttendance;
use App\Models\OnlineCourseSetting;
use Illuminate\Support\Facades\Auth;

class OnlineCourseController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Find student record for the logged-in user
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $student = Student::where('uid', $user->uid)->first();

        // Check feature flags
        $registrationFlag = FeatureFlag::where('feature_name', 'online_course_registration')->first();
        $attendanceFlag = FeatureFlag::where('feature_name', 'online_course_attendance')->first();

        $registrationEnabled = $registrationFlag && $registrationFlag->is_active;
        $attendanceEnabled = $attendanceFlag && $attendanceFlag->is_active;

        $isRegistered = false;
        $attendanceMarkedToday = false;

        $attendanceCount = 0;
        $progressPercentage = 0;
        $totalCourseDays = 30; // Default course duration target

        if ($student) {
            $isRegistered = OnlineCourseRegistration::where('student_id', $student->id)->exists();
            if ($isRegistered) {
                $attendanceMarkedToday = OnlineCourseAttendance::where('student_id', $student->id)
                    ->whereDate('attendance_date', now())
                    ->exists();

                $attendanceCount = OnlineCourseAttendance::where('student_id', $student->id)->count();
                $progressPercentage = min(100, round(($attendanceCount / $totalCourseDays) * 100));
            }
        }

        $meetingLink = OnlineCourseSetting::where('key', 'class_room_link')->value('value');

        return view('online-course.index', compact(
            'student',
            'registrationEnabled',
            'attendanceEnabled',
            'isRegistered',
            'attendanceMarkedToday',
            'meetingLink',
            'attendanceCount',
            'progressPercentage'
        ));
    }

    public function register()
    {

        $user = Auth::user();
        $student = Student::where('uid', $user->uid)->first();

        if (!$student) {
            return back()->with('error', 'Student record not found.');
        }

        $registrationEnabled = FeatureFlag::where('feature_name', 'online_course_registration')->value('is_active');

        if (!$registrationEnabled) {
            return back()->with('error', 'Registration is currently closed.');
        }

        if ($student->onlineCourseRegistration()->exists()) {
            return back()->with('info', 'You are already registered.');
        }

        $student->onlineCourseRegistration()->create();

        return back()->with('success', 'Successfully registered for the Online Course!');
    }

    public function markAttendance()
    {

        $user = Auth::user();
        $student = Student::where('uid', $user->uid)->first();

        if (!$student) {
            return back()->with('error', 'Student record not found.');
        }

        $attendanceEnabled = FeatureFlag::where('feature_name', 'online_course_attendance')->value('is_active');

        if (!$attendanceEnabled) {
            return back()->with('error', 'Attendance marking is currently closed.');
        }

        if (!$student->onlineCourseRegistration()->exists()) {
            return back()->with('error', 'You must register for the course first.');
        }

        $today = now()->toDateString();

        if ($student->onlineCourseAttendances()->where('attendance_date', $today)->exists()) {
            return back()->with('info', 'Attendance already marked for today.');
        }

        $student->onlineCourseAttendances()->create([
            'attendance_date' => $today
        ]);

        return back()->with('success', 'Attendance marked successfully!');
    }

    public function activities()
    {
        $activities = \App\Models\OnlineCourseActivity::where('is_active', true)
            ->latest()
            ->get();

        return view('online-course.activities', compact('activities'));
    }

    public function quizzes()
    {
        $quizzes = \App\Models\OnlineCourseQuiz::where('is_active', true)
            ->latest()
            ->get();

        return view('online-course.quizzes', compact('quizzes'));
    }
}
