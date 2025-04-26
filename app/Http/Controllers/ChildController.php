<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
         $validated = $request->validate([
            'name' => 'required|string|max:100',
            'dob' => 'required|date',
            'gender' => 'required|in:M,F',
            'parent_id' => 'required|exists:users,id', // Ensure parent_id exists in parents table
        ]);


        // Create and save the child
        $child = Child::create([
            'name' => $request->name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'parent_id' => $request->parent_id,
        ]);

        // Optionally, you can return a success message or redirect
        return redirect()->route('pardash')->with('success', 'Child added successfully');
    }

    public function showCalendar($child_id)
    {
        // احصل على الطفل من قاعدة البيانات باستخدام الـ id
        $child = Child::findOrFail($child_id);

        // إرجاع عرض التقويم مع بيانات الطفل
        return view('calendar', compact('child'));
    }
}
