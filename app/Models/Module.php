<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['course_id', 'code', 'name', 'semester', 'description', 'credit', 'type', 'status'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }





    public function publishSyllabus($syllabusId)
    {
        try {
            $syllabus = Syllabus::findOrFail($syllabusId);
    
            if ($syllabus->status != 'draft') {
                throw new \Exception("Syllabus is already published.");
            }
    
            $syllabus->update(['status' => 'publish', 'published_at' => now()]);
            Log::info("Syllabus published: ID $syllabusId");
        } catch (\Exception $e) {
            Log::error("Error publishing syllabus ID $syllabusId: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    




    
}

