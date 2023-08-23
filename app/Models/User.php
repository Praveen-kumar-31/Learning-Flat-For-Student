<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'department_id',
        'section_id',
        'batch_id',
        'email',
        'password',
        'trainer1_id',
        'trainer2_id',

    ];
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
    public function allocationTrainers()
    {
        return $this->hasMany(TrainerAllocation::class, 'batch_id', 'batch_id')
            ->where('department_id', $this->department_id)
            ->where('section_id', $this->section_id)
            ->with('course.topics.subtopics');
    }
    public function trainer1()
{
    return $this->belongsTo(Trainer::class, 'trainer1_id');
}

public function trainer2()
{
    return $this->belongsTo(Trainer::class, 'trainer2_id');
}
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
