<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Equipo;
use App\Models\OrdenTaller;
use App\Models\Ubicacion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrdenTallerTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_workshop_order_edit_form(): void
    {
        [$user, $orden] = $this->createWorkshopOrder();

        $response = $this->actingAs($user)->get(route('ordenes-taller.edit', $orden));

        $response
            ->assertOk()
            ->assertSee('Editar orden de taller')
            ->assertSee('No enciende');
    }

    public function test_authenticated_user_can_update_workshop_order(): void
    {
        [$user, $orden] = $this->createWorkshopOrder();

        $response = $this->actingAs($user)->put(route('ordenes-taller.update', $orden), [
            'motivo' => 'Fuente de poder dañada',
            'estado' => 'finalizado',
            'fecha_salida' => null,
            'observaciones' => 'Fuente reemplazada',
        ]);

        $response->assertRedirect(route('ordenes-taller.index'));
        $this->assertDatabaseHas('ordenes_taller', [
            'id' => $orden->id,
            'motivo' => 'Fuente de poder dañada',
            'estado' => 'finalizado',
        ]);
        $this->assertSame('activo', $orden->equipo->fresh()->estado);
    }

    private function createWorkshopOrder(): array
    {
        $user = User::factory()->create();
        $categoria = Categoria::create([
            'nombre' => 'Computadoras',
            'codigo' => 'COMP',
            'tipo' => 'equipo',
        ]);
        $ubicacion = Ubicacion::create([
            'nombre' => 'Oficina principal',
            'activo' => true,
        ]);
        $equipo = Equipo::create([
            'nombre' => 'PC recepción',
            'categoria_id' => $categoria->id,
            'ubicacion_id' => $ubicacion->id,
            'estado' => 'en_reparacion',
        ]);
        $orden = OrdenTaller::create([
            'equipo_id' => $equipo->id,
            'motivo' => 'No enciende',
            'estado' => 'en_espera',
            'fecha_ingreso' => '2026-08-12',
            'usuario_id' => $user->id,
        ]);

        return [$user, $orden];
    }
}
