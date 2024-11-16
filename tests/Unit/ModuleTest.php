<?php



use Tests\TestCase;
use App\Models\Module;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ModuleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_module()
    {
        $course = Course::factory()->create();

        $module = Module::create([
            'course_id' => $course->id,
            'code' => 'CS101',
            'name' => 'Introduction to Computing',
            'semester' => 1,
            'description' => 'Basic computing concepts',
            'credit' => 3,
            'type' => 'Mandatory',
            'status' => 'draft',
        ]);

        $this->assertDatabaseHas('modules', [
            'name' => 'Introduction to Computing',
        ]);
    }

    /** @test */
    public function it_can_update_a_module()
    {
        $module = Module::factory()->create();

        $module->update(['name' => 'Updated Module Name']);

        $this->assertEquals('Updated Module Name', $module->name);
    }

    /** @test */
    public function it_cannot_update_a_published_module_after_6_hours()
    {
        $module = Module::factory()->create(['status' => 'publish', 'updated_at' => now()->subHours(7)]);

        $response = $this->put(route('modules.update', $module->id), ['name' => 'New Name']);

        $response->assertStatus(403);
    }

    /** @test */
    public function it_can_delete_a_module()
    {
        $module = Module::factory()->create();

        $module->delete();

        $this->assertDeleted($module);
    }
}
