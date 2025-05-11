<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_correct_credentials(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard'); // или твой маршрут
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_wrong_password(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_admin_can_create_project(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $this->actingAs($admin);

        $response = $this->post('/projects', [
            'name_project' => 'Тестовый проект',
            'discription_project' => 'Описание проекта',
            'id_status' => 1, // Убедись, что статус с id 1 существует
        ]);

        $response->assertRedirect(); // на /projects или /projects/{id}
        $this->assertDatabaseHas('projects', [
            'name_project' => 'Тестовый проект',
        ]);
    }

    public function test_student_cannot_access_admin_dashboard(): void
    {
        $student = User::factory()->create();
        $student->assignRole('student');

        $this->actingAs($student);

        $response = $this->get('/admin/dashboard');
        $response->assertForbidden(); // Или assertRedirect('/')
    }
}
