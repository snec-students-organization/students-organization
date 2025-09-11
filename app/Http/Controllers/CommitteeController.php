<?php

namespace App\Http\Controllers;

use App\Models\CommitteeMember;

class CommitteeController extends Controller
{
    public function index()
    {
        $mainCommittee = CommitteeMember::where('committee_type', 'main')->get();
        $subCommittees = CommitteeMember::where('committee_type', 'sub')->get()->groupBy('sub_committee');

        return view('committees.index', compact('mainCommittee', 'subCommittees'));
    }
}
