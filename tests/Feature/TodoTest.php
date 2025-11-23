<?php

use App\Models\Todo;
use App\Models\User;

test('guest is redirected from todos', function () {
    $this->get('/todos')->assertRedirect('/login');
});

test('user can create a todo', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('/todos', [
            'title' => 'Test Todo',
            'description' => 'Some details',
            'due_date' => now()->addDay()->toDateString(),
        ])
        ->assertRedirect('/todos');

    $this->assertDatabaseHas('todos', [
        'user_id' => $user->id,
        'title' => 'Test Todo',
    ]);
});

test('user cannot see another users todos', function () {
    $userA = User::factory()->create();
    $userB = User::factory()->create();

    Todo::factory()->create([
        'user_id' => $userA->id,
        'title' => 'A Secret Todo',
    ]);

    $response = $this->actingAs($userB)->get('/todos');

    $response->assertDontSee('A Secret Todo');
});

test('user cannot edit another users todo', function () {
    $userA = User::factory()->create();
    $userB = User::factory()->create();

    $todoA = Todo::factory()->create(['user_id' => $userA->id]);

    $this->actingAs($userB)
        ->get("/todos/{$todoA->id}/edit")
        ->assertForbidden();
});

test('user can mark todo complete and store completed_at', function () {
    $user = User::factory()->create();
    $todo = Todo::factory()->create([
        'user_id' => $user->id,
        'is_completed' => false,
        'completed_at' => null,
    ]);

    $this->actingAs($user)
        ->patch("/todos/{$todo->id}/complete")
        ->assertRedirect('/todos');

    $this->assertDatabaseHas('todos', [
        'id' => $todo->id,
        'is_completed' => true,
    ]);
});
