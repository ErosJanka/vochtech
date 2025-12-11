<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('displays profile page', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get('/profile')
        ->assertOk();
});

it('can update profile information', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->patch('/profile', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $user->refresh();

    expect($user->name)->toBe('Test User')
        ->and($user->email)->toBe('test@example.com')
        ->and($user->email_verified_at)->toBeNull();
});

it('does not change email verification status when email is unchanged', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->patch('/profile', [
            'name' => 'Test User',
            'email' => $user->email,
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    expect($user->refresh()->email_verified_at)->not->toBeNull();
});

it('can delete account', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->delete('/profile', [
            'password' => 'password',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect('/');

    assertGuest();
    expect($user->fresh())->toBeNull();
});

it('requires correct password to delete account', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->from('/profile')
        ->delete('/profile', [
            'password' => 'wrong-password',
        ])
        ->assertSessionHasErrorsIn('userDeletion', 'password')
        ->assertRedirect('/profile');

    expect($user->fresh())->not->toBeNull();
});