<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

// use PHPUnit\Framework\TestCase;

class AdminUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function testIfUserIsAdmin(): void
    {
        $user = User::factory()->createOne([
            'is_admin' => false,
        ]);

        $this->assertFalse($user->isAdmin());

        $user->is_admin = true;
        $user->save();

        $this->assertTrue($user->isAdmin());
    }
}
