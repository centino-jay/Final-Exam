<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'subject_code', 'name', 'description', 'instructor', 'schedule',
        'prelims', 'midterms', 'pre_finals', 'finals', 'average_grade', 'remarks', 'date_taken',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
