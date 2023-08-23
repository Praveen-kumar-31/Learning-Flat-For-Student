<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Batch;
use Illuminate\Http\Request;

class DropdownController extends Controller
{
    public function getSections($department_id)
    {
        $sections = Section::where('department_id', $department_id)->get();

        return response()->json([
            'sections' => $sections,
        ]);
    }

    public function getBatches($section_id)
    {
        $batches = Batch::where('section_id', $section_id)->get();

        return response()->json([
            'batches' => $batches,
        ]);
    }
}
