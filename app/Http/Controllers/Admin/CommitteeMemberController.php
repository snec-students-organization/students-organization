<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommitteeMember;

class CommitteeMemberController extends Controller
{
    public function index()
{
    $members = CommitteeMember::latest()->paginate(10); // 10 per page
    return view('admin.committees.index', compact('members'));
}


    public function create()
    {
        return view('admin.committees.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'committee_type' => 'required|in:main,sub',
            'sub_committee' => 'nullable|in:media_hub,creative_commune,literary,cultural_sphere',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'college_name' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('committee_members', 'public');
        }

        CommitteeMember::create($data);

        return redirect()->route('admin.committees.index')->with('success', 'Member added successfully!');
    }

    // 🟢 EDIT
    public function edit(CommitteeMember $committee)
    {
        return view('admin.committees.edit', ['member' => $committee]);
    }

    // 🟢 UPDATE
    public function update(Request $request, CommitteeMember $committee)
    {
        $data = $request->validate([
            'committee_type' => 'required|in:main,sub',
            'sub_committee' => 'nullable|in:media_hub,creative_commune,literary,cultural_sphere',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'college_name' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('committee_members', 'public');
        }

        $committee->update($data);

        return redirect()->route('admin.committees.index')->with('success', 'Member updated successfully!');
    }

    // 🟢 DELETE
    public function destroy(CommitteeMember $committee)
    {
        if ($committee->image && \Storage::disk('public')->exists($committee->image)) {
            \Storage::disk('public')->delete($committee->image);
        }

        $committee->delete();

        return redirect()->route('admin.committees.index')->with('success', 'Member deleted successfully!');
    }
}
