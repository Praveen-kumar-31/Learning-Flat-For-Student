<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    public function getSections(Request $request)
    {
        $departmentId = $request->input('department_id');
        $sections = Section::where('department_id', $departmentId)->get();

        return response()->json(['sections' => $sections]);
    }
}
