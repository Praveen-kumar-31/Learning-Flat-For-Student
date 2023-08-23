<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\Section;
use App\Models\Batch;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // Edit and Delete
    public function studentedit($id)
    {
        $user = User::findOrFail($id);
        $batches = Batch::all();
        $departments = Department::all();
        $sections = Section::all();

        return view('page.studentedit', compact('user', 'batches', 'departments', 'sections'));
    }

    public function studentupdate(Request $request, $id)
    {
        $request->validate([
            'batch_id' => 'required',
            'department_id' => 'required',
            'section_id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);

        $user->batch_id = $request->input('batch_id');
        $user->department_id = $request->input('department_id');
        $user->section_id = $request->input('section_id');
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Update the student upload record
        $user->save();

        return redirect()->route('excel')->with('success', 'Student details updated successfully.');
    }

    public function studentdelete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect('uploadstudent')->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            return redirect('uploadstudent')->with('error', 'Failed to delete student.');
        }
    }

    public function uploads()
    {
        $users = User::get();
        $departments = Department::all();
        $sections = Section::all();
        $batches = Batch::all();

        return view('page.uploadstudent', compact('users', 'departments', 'sections', 'batches'));
    }

    public function import_user(Request $request)
    {
        $request->validate([
            'batch_id' => 'required',
            'department_id' => 'required',
            'section_id' => 'required',
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        $file = $request->file('excel_file');

        try {
            $import = new UsersImport($request->batch_id, $request->department_id, $request->section_id, true);
            Excel::import($import, $file);
            return redirect()->back()->with('success', 'User data imported successfully.');
        } catch (ValidationException $e) {
            $failures = $e->failures();

            $importErrors = [];
            foreach ($failures as $failure) {
                $importErrors[] = [
                    'row' => $failure->row(),
                    'message' => $failure->errors()[0],
                ];
            }

            return redirect()->back()->with('import_errors', $importErrors);
        }
    }

    public function export_user()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
