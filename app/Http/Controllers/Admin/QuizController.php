<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OnlineCourseQuiz;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = OnlineCourseQuiz::latest()->get();
        return view('admin.online-course.quizzes', compact('quizzes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
        ]);

        OnlineCourseQuiz::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'link' => $validated['link'],
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Quiz created successfully.');
    }

    public function destroy(OnlineCourseQuiz $quiz)
    {
        $quiz->delete();
        return back()->with('success', 'Quiz deleted successfully.');
    }
}
