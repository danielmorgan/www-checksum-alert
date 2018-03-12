<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotifiesWebsiteChangedTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_user_can_schedule_a_checksum_to_be_run_on_a_website()
    {
        $user = factory(User::class)->create();

        $response = $this->post('/checker', [
            'user_id' => $user->id,
            'url'     => route('test1'),
        ]);

        $response->assertRedirect('/checker');
        $this->assertDatabaseHas('checkers', ['user_id' => 1, 'url' => route('test1')]);
    }
}
