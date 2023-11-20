<?php

namespace Tests\Unit;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskPriorityUpdate extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        for ($i = 1; $i <= 8; $i++){
           Task::factory()->create(['name' =>'Task ' . $i,'priority' => $i]);
        }
        $task8 = Task::find(8);

        $task8->update(['priority' => 1]);
        $this->assertDatabaseHas('tasks',['id' => 2 , 'priority' => 3]);

        $task8->update(['priority' => 5]);
        $this->assertDatabaseHas('tasks',['id' => 2 , 'priority' => 2]);
    }
}
