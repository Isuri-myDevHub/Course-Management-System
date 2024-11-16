<?php

use Tests\TestCase;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CourseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_course()
    {
        $course = Course::create([
            'name' => 'B.Sc in Computing',
            'seo_url' => 'bsc-computing',
            'faculty' => 'Computing',
            'category' => 'Undergraduate',
            'status' => 'draft',
        ]);

        $this->assertDatabaseHas('courses', [
            'name' => 'B.Sc in Computing',
        ]);
    }

    /** @test */
    public function it_can_update_a_course()
    {
        $course = Course::factory()->create();

        $course->update(['name' => 'Updated Course Name']);

        $this->assertEquals('Updated Course Name', $course->name);
    }

    /** @test */
    public function it_can_delete_a_course()
    {
        $course = Course::factory()->create();

        $course->delete();

        $this->assertDeleted($course);
    }
}
