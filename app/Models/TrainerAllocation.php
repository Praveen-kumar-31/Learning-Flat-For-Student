<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainerAllocation extends Model
{
    protected $table = 'allocation_trainers';

    protected $fillable = [
        'batch_id',
        'department_id',
        'section_id',        
        'course_id',
        'trainer1_id',
        'trainer2_id',
    ];

    // Define relationships with other models
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function trainer1()
    {
        return $this->belongsTo(Trainer::class,'trainer1_id');
    }
    public function trainer2()
    {
        return $this->belongsTo(Trainer::class,'trainer2_id');
    }
}
