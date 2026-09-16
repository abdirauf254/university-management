<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'user_id',
        'student_number',
        'admission_number',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'gender',
        'phone',
        'address',
        'admission_date',
        'status',
    ];

    /**
     * University this student belongs to.
     */
    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    /**
     * User account associated with this student.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Program enrollment history for this student.
     */
    public function programEnrollments(): HasMany
    {
        return $this->hasMany(StudentProgramEnrollment::class);
    }

    /**
     * Course registrations for this student.
     */
    public function courseRegistrations(): HasMany
    {
        return $this->hasMany(CourseRegistration::class);
    }

    /**
     * Assessment results for this student.
     */
    public function assessmentResults(): HasMany
    {
        return $this->hasMany(AssessmentResult::class);
    }

    /**
     * Course results for this student.
     */
    public function courseResults(): HasMany
    {
        return $this->hasMany(CourseResult::class);
    }

    /**
     * Attendance records for this student.
     */
    public function attendanceRecords(): HasMany
    {
        return $this->hasMany(StudentAttendance::class);
    }

    /**
     * Invoices belonging to this student.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Payments made by this student.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Receipts issued for this student.
     */
    public function receipts(): HasMany
    {
        return $this->hasMany(Receipt::class);
    }

    /**
     * Financial clearance records.
     */
    public function financialClearances(): HasMany
    {
        return $this->hasMany(FinancialClearance::class);
    }

    /**
     * Graduation records for this student.
     */
    public function graduationCandidates(): HasMany
    {
        return $this->hasMany(GraduationCandidate::class);
    }

    /**
     * Cast date attributes.
     */
    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'admission_date' => 'date',
        ];
    }
}