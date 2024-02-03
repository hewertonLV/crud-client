<?php

namespace Tests\Feature\client;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use DatabaseMigrations;

    public function test_create_login_with_success(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/client/store', [
            'name' => "João",
            'email' => "jsoaeo@gmail.com",
            'cpf' => "12449635895",
        ]);
        $response->assertRedirect();
        $followedResponse = $this->get($response->headers->get('Location'));
        $followedResponse->assertSee('Cliente adicionada com sucesso.');

    }

    public function test_delete_user(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $client = Client::factory()->create(['id' => $user->id]);
        $response = $this->delete("/client/destroy/{$client->id}");
        $response->assertRedirect('/client');
        $followedResponse = $this->get($response->headers->get('Location'));
        $followedResponse->assertSee('Cliente excluido');
    }

}
