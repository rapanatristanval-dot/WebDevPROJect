<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskManagerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_displays_tasks(): void
    {
        Task::create([
            'task_name' => 'Finish project outline',
            'description' => 'Draft project milestones and requirements',
            'status' => 'Pending',
            'due_date' => '2026-10-10',
        ]);

        $response = $this->get('/tasks');

        $response->assertOk();
        $response->assertSee('Finish project outline');
    }

    public function test_user_can_create_task(): void
    {
        $response = $this->post('/tasks', [
            'task_name' => 'Submit assignment',
            'description' => 'Upload Laravel project to GitHub',
            'status' => 'Pending',
            'due_date' => '2026-10-15',
        ]);

        $this->assertDatabaseHas('tasks', [
            'task_name' => 'Submit assignment',
            'status' => 'Pending',
        ]);

        $response->assertRedirect('/tasks');
    }
}
