<?php

namespace Feature\TransportUnit;

use App\Enums\TransportType;
use App\Models\TransportUnit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransportUnitControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_transport_unit(): void
    {
        $response = $this->postJson('/api/transport-units', [
            'name' => 'Heavy Hauler',
            'type' => TransportType::TRUCK->value,
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'name' => 'Heavy Hauler',
                'type' => TransportType::TRUCK->value,
            ]);

        $this->assertDatabaseHas('transport_units', [
            'name' => 'Heavy Hauler',
            'type' => TransportType::TRUCK->value,
        ]);
    }

    public function test_list_transport_units_by_type(): void
    {
        TransportUnit::factory()->create(['name' => 'Trailer 1', 'type' => TransportType::TRAILER->value]);
        TransportUnit::factory()->create(['name' => 'Truck 1', 'type' => TransportType::TRUCK->value]);

        $response = $this->getJson('/api/transport-units?type=trailer');

        $response->assertStatus(200)
            ->assertJsonCount(1);
    }

    public function test_validation_error_on_invalid_data(): void
    {
        $response = $this->postJson('/api/transport-units', [
            'name' => '',
            'type' => 'plane', // invalid type
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'type']);
    }

    public function test_can_search_transport_units(): void
    {
        TransportUnit::factory()->create(['name' => 'Truck Alpha', 'type' => TransportType::TRUCK->value]);
        TransportUnit::factory()->create(['name' => 'Trailer Bravo', 'type' => TransportType::TRAILER->value]);

        $response = $this->getJson('/api/transport-units?type=truck&search=alpha');

        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment(['name' => 'Truck Alpha']);
    }
}
