<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coding extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'topic_id',
        'subtopic_id',
        'question',
        'sample_input1',
        'sample_input2',
        'sample_input3',
        'sample_input4',
        'sample_output1',
        'sample_output2',
        'sample_output3',
        'sample_output4',
        'type',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id'); // Assuming 'course' is the foreign key column in the 'codings' table
    }

    public function subtopic()
    {
        return $this->belongsTo(Subtopic::class, 'subtopic_id'); // Assuming 'subtopic' is the foreign key column in the 'codings' table
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id'); // Assuming 'topic' is the foreign key column in the 'codings' table
    }
}
