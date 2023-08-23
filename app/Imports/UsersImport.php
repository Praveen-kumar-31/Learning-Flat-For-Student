<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class UsersImport implements ToModel, WithHeadingRow, WithStartRow, WithValidation, WithBatchInserts
{
    private $batchId;
    private $departmentId;
    private $sectionId;
    private $startRow;

    public function __construct($batchId, $departmentId, $sectionId, $hasHeadingRow = true)
    {
        $this->batchId = $batchId;
        $this->departmentId = $departmentId;
        $this->sectionId = $sectionId;
        $this->startRow = $hasHeadingRow ? 2 : 1;
    }

    public function model(array $row)
    {
        return new User([
            'batch_id' => $this->batchId,
            'department_id' => $this->departmentId,
            'section_id' => $this->sectionId,
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => bcrypt($row['password']),
        ]);
    }

    public function startRow(): int
    {
        return $this->startRow;
    }

    public function rules(): array
    {
        return [
            '*.name' => 'required',
            '*.email' => 'required|email|unique:users,email',
            '*.password' => 'required',
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            '*.name.required' => 'Name is required.',
            '*.email.required' => 'Email is required.',
            '*.email.email' => 'Invalid email format.',
            '*.email.unique' => 'Duplicate email entry found.',
            '*.password.required' => 'Password is required.',
        ];
    }

    public function batchSize(): int
    {
        return 1000; // Adjust the batch size as per your requirements
    }
}
