<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstructorDetail extends Model
{
    use HasFactory;

    protected $table = 'instructor_details';

    // instructorID is PK and FK to instructors.id
    protected $primaryKey = 'instructorID';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'instructorID',
        'fullname',
        'phone',
        'gender',
        'dob',
        'bio',
        'country',
        'expertise',
        'yearsOfExperience',
        'linkedin',
        'cv',
        'status',
    ];

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class, 'instructorID');
    }
}
