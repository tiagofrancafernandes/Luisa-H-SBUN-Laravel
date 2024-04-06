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

    /**
     * A basic test example.
     */
    public function testRouteRedirects(): void
    {
        $user = User::factory()->createOne([
            'is_admin' => false,
        ]);

        $this->assertFalse($user->isAdmin());

        // Por não estar logado, não pode ver a tela de listagem de livros, então é redirecionado para login
        $this->get(route('books.index'))
            ->assertStatus(302)
            ->assertRedirectToRoute('login');

        // Por estar logado, pode ver a tela de listagem de livros
        $this->actingAs($user)->get(route('books.index'))
            ->assertStatus(200);

        // Apesar de estar logado, não é admin, então não pode ver a tela de admin
        $this->actingAs($user)->get(route('admin.books.index'))
            ->assertStatus(401);

        // Agora o usuário passou a ser um admin
        $user->is_admin = true;
        $user->save();

        $this->assertTrue($user->isAdmin());

        // Apesar de estar logado, por agora ser admin, então é redirecionado para a área de admin
        $this->actingAs($user)->get(route('books.index'))
            ->assertStatus(302)
            ->assertRedirectToRoute('admin.books.index');

        // Por ser admin, a tela administrativa é apresentada normalmente
        $this->actingAs($user)->get(route('admin.books.index'))
            ->assertStatus(200);
    }
}
