<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriaTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_categories(): void
    {
        $user = User::factory()->create();
        Categoria::create([
            'nombre' => 'Computadoras',
            'codigo' => 'COMP',
            'tipo' => 'equipo',
        ]);

        $response = $this->actingAs($user)->get(route('categorias.index'));

        $response
            ->assertOk()
            ->assertSee('Categorías')
            ->assertSee('Computadoras');
    }

    public function test_authenticated_user_can_view_category_edit_form(): void
    {
        $user = User::factory()->create();
        $categoria = Categoria::create([
            'nombre' => 'Herramientas',
            'codigo' => 'HERR',
            'tipo' => 'insumo',
        ]);

        $response = $this->actingAs($user)->get(route('categorias.edit', $categoria));

        $response
            ->assertOk()
            ->assertSee('Editar categoría')
            ->assertSee('Herramientas');
    }
}
