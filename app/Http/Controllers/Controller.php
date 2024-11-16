<?php




use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Store a newly created course.
     */
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'seo_url' => 'required|string|unique:courses,seo_url',
            'faculty' => 'required|string',
            'category' => 'required|string',
            'status' => 'required|in:draft,publish',
        ]);

        // Create the course
        Course::create($request->all());

        return response()->json(['message' => 'Course created successfully']);
    }

    /**
     * Update an existing course.
     */
    public function update(Request $request, Course $course)
    {
        // Validate request data
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'seo_url' => 'sometimes|required|string|unique:courses,seo_url,' . $course->id,
            'faculty' => 'sometimes|required|string',
            'category' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:draft,publish',
        ]);

        // Update the course
        $course->update($request->all());

        return response()->json(['message' => 'Course updated successfully']);
    }

    /**
     * Delete an existing course.
     */
    public function delete(Course $course)
    {
        $course->delete();

        return response()->json(['message' => 'Course deleted successfully']);
    }
}
