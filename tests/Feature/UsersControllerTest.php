<?php

use App\Models\User;
use Illuminate\Support\Facades\Artisan;

test('Manage Users page is displayed For Admin', function () {
    Artisan::call('db:seed');
    $user = User::factory()->create();
    $user->assignRole('Admin');

    $response = $this
        ->actingAs($user)
        ->get('/manageUsers');

    $response->assertOk();
});

test('Manage Users page is displayed For MidLevelAdmin', function () {
    Artisan::call('db:seed');
    $user = User::factory()->create();
    $user->assignRole('MidLevelAdmin');

    $response = $this
        ->actingAs($user)
        ->get('/manageUsers');

    $response->assertOk();
});

test('Manage Users page Not displayed For who not Admin or MidLevelAdmin', function () {
    Artisan::call('db:seed');
    $user = User::factory()->create();
    $user->assignRole('user');

    $response = $this
        ->actingAs($user)
        ->get('/manageUsers');

    $response->assertStatus(403);
});

test('Admin can deactivate a user', function () {
    Artisan::call('db:seed');
    $user = User::factory()->create();
    $user->assignRole('Admin');

    $response = $this
        ->actingAs($user)
        ->post('/changeUserStatus', [
            'id' => User::first()->id,
            'status' => 1,
        ]);

    $response->assertOk();
});

test('MidLevelAdmin can not deactivate a user', function () {
    Artisan::call('db:seed');
    $user = User::factory()->create();
    $user->assignRole('MidLevelAdmin');

    $response = $this
        ->actingAs($user)
        ->post('/changeUserStatus', [
            'id' => User::first()->id,
            'status' => 1,
        ]);

    $response->assertStatus(403);
});
