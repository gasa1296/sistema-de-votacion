<?php

use App\Models\Election;
use App\Models\User;

test('voter can view login page', function () {
    $response = $this->get(route('voter.login'));

    $response->assertSuccessful();
});

test('voter can login with valid credentials', function () {
    $user = User::factory()->voter()->create([
        'email' => 'voter@test.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post(route('voter.login.store'), [
        'email' => 'voter@test.com',
        'password' => 'password',
    ]);

    $response->assertRedirect(route('voter.vote'));
    $this->assertAuthenticatedAs($user, 'voter');
});

test('voter cannot login with invalid credentials', function () {
    $response = $this->post(route('voter.login.store'), [
        'email' => 'wrong@test.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest('voter');
});

test('admin can also login as voter', function () {
    $user = User::factory()->admin()->create([
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post(route('voter.login.store'), [
        'email' => 'admin@test.com',
        'password' => 'password',
    ]);

    $response->assertRedirect(route('voter.vote'));
    $this->assertAuthenticatedAs($user, 'voter');
});

test('voter can logout', function () {
    $user = User::factory()->voter()->create();

    $this->actingAs($user, 'voter');

    $response = $this->post(route('voter.logout'));

    $response->assertRedirect(route('voter.login'));
    $this->assertGuest('voter');
});
