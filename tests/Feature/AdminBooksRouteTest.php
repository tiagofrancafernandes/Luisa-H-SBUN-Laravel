<?php

namespace Tests\Feature;

// use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class AdminBooksRouteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function testNoAdminCantAccessRoute(): void
    {
        $user = User::factory()->createOne([
            'is_admin' => false,
        ]);

        $this->assertFalse($user->isAdmin());

        $this->get(route('admin.books.index'))
            ->assertStatus(302)
            ->assertRedirectToRoute('login');

        $this->actingAs($user)->get(route('admin.books.index'))
            ->assertStatus(401);

        $user->is_admin = true;
        $user->save();

        $this->assertTrue($user->isAdmin());

        $this->actingAs($user)->get(route('admin.books.index'))
            ->assertStatus(200);
    }
}
