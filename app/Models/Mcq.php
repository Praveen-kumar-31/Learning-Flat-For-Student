<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcq extends Model
{
    use HasFactory;

    protected $fillable = [
        'course',
        'topic',
        'subtopic',
        'question',
        'answer',
        'type',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id'); // Make sure 'course' matches the actual foreign key column name
    }
    
    public function subtopic()
    {
        return $this->belongsTo(Subtopic::class, 'subtopic_id'); // Make sure 'subtopic' matches the actual foreign key column name
    }
    
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id'); // Make sure 'topic' matches the actual foreign key column name
    }
    
}
