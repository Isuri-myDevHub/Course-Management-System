

<?php


use Tests\TestCase;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;


class CourseControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_create_a_course()
    {
        $response = $this->post('/courses/create', [
            'name' => 'B.Sc in Computing',
            'seo_url' => 'bsc-computing',
            'faculty' => 'Computing',
            'category' => 'Undergraduate',
            'status' => 'draft',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('courses', ['name' => 'B.Sc in Computing']);
    }

    /** @test */
    public function academic_head_can_update_a_course_within_6_hours()
    {
        $course = Course::factory()->create(['status' => 'publish', 'updated_at' => now()]);

        $response = $this->put("/courses/update/{$course->id}", [
            'name' => 'Updated Course Name',
        ]);

        $response->assertStatus(200);
        $this->assertEquals('Updated Course Name', $course->fresh()->name);
    }

    /** @test */
    public function academic_head_cannot_update_a_published_course_after_6_hours()
    {
        $course = Course::factory()->create(['status' => 'publish', 'updated_at' => now()->subHours(7)]);

        $response = $this->put("/courses/update/{$course->id}", ['name' => 'New Name']);

        $response->assertStatus(403);
    }

    /** @test */
    public function admin_can_delete_any_course()
    {
        $course = Course::factory()->create();

        $response = $this->delete("/courses/delete/{$course->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
    }

    





































}

