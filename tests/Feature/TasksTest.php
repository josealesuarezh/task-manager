<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_task()
    {
        $tasks = Task::factory(5)->create();
        $this->get('/tasks')->assertStatus(200);

        $this->assertDatabaseCount('tasks', 5);
    }

    public function test_create_task()
    {
        $task = Task::factory()->raw();

        $this->post('/tasks',  $task)->assertStatus(302);

        $this->assertDatabaseHas('tasks', $task);
    }

    public function test_get_task()
    {
        $task = Task::factory()->create();
        $this->get('/tasks/'. $task->id)->assertStatus(200);
    }

    public function test_update_task()
    {
        $task = Task::factory()->create();
        $newTask = Task::factory()->raw();

        $this->patch('/tasks/' . $task->id, $newTask)->assertStatus(302);

        $this->assertDatabaseHas('tasks', $newTask);
    }

    public function test_delete_task()
    {
        $task = Task::factory()->create();
        $this->delete('/tasks/'. $task->id)->assertStatus(200);
        $this->assertDatabaseMissing('tasks', $task->toArray());
    }
}
