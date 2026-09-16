<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'email',
        'phone',
        'address',
        'website',
        'logo',
        'status',
    ];

    /**
     * Users belonging to this university.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * University settings.
     */
    public function settings(): HasOne
    {
        return $this->hasOne(UniversitySetting::class);
    }

    /**
     * Campuses belonging to this university.
     */
    public function campuses(): HasMany
    {
        return $this->hasMany(Campus::class);
    }

    /**
     * Faculties belonging to this university.
     */
    public function faculties(): HasMany
    {
        return $this->hasMany(Faculty::class);
    }

    /**
     * Departments belonging to this university.
     */
    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    /**
     * Academic years belonging to this university.
     */
    public function academicYears(): HasMany
    {
        return $this->hasMany(AcademicYear::class);
    }

    /**
     * Semesters belonging to this university.
     */
    public function semesters(): HasMany
    {
        return $this->hasMany(Semester::class);
    }

    /**
     * Programs belonging to this university.
     */
    public function programs(): HasMany
    {
        return $this->hasMany(Program::class);
    }

    /**
     * Courses belonging to this university.
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    /**
     * Student profiles belonging to this university.
     */
    public function students(): HasMany
    {
        return $this->hasMany(StudentProfile::class);
    }

    /**
     * Lecturer profiles belonging to this university.
     */
    public function lecturers(): HasMany
    {
        return $this->hasMany(LecturerProfile::class);
    }

    /**
     * Applications submitted to this university.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Course offerings belonging to this university.
     */
    public function courseOfferings(): HasMany
    {
        return $this->hasMany(CourseOffering::class);
    }

    /**
     * Exams belonging to this university.
     */
    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    /**
     * Fee structures belonging to this university.
     */
    public function feeStructures(): HasMany
    {
        return $this->hasMany(FeeStructure::class);
    }

    /**
     * Invoices belonging to this university.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Payments belonging to this university.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Graduation batches belonging to this university.
     */
    public function graduationBatches(): HasMany
    {
        return $this->hasMany(GraduationBatch::class);
    }

    /**
     * Graduation candidates belonging to this university.
     */
    public function graduationCandidates(): HasMany
    {
        return $this->hasMany(GraduationCandidate::class);
    }
}