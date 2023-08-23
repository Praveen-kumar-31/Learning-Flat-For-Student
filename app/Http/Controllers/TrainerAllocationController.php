<?php

namespace App\Http\Controllers;
use App\Models\TrainerAllocation;
use App\Models\Department;
use App\Models\Section;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Trainer;
use Illuminate\Http\Request;


class TrainerAllocationController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'department_id' => 'required',
            'section_id' => 'required',
            'batch_id' => 'required',
            'course_id' => 'required',
            'trainer1_id' => 'required',
            'trainer2_id' => 'required',
        ]);

        // Create a new TrainerAllocation instance and fill it with the validated data
        $allocation = new TrainerAllocation();
        $allocation->department_id = $validatedData['department_id'];
        $allocation->section_id = $validatedData['section_id'];
        $allocation->batch_id = $validatedData['batch_id'];
        $allocation->course_id = $validatedData['course_id'];
        $allocation->trainer1_id = $validatedData['trainer1_id'];
        $allocation->trainer2_id = $validatedData['trainer2_id'];

        // Save the allocation to the database
        $allocation->save();

        // Optionally, you can redirect the user to a specific page after storing the data
        return redirect()->back()->with('success', 'Trainer allocated successfully!');
    }

    
}
