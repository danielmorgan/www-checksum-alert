<?php

namespace Tests\Feature;

use App\Checker;
use App\Jobs\ChecksumWebsite;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotifiesWebsiteChangedTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        Bus::fake();
        $this->actingAs(factory(User::class)->create());
    }

    /** @test */
    function can_create_a_checker()
    {
        $response = $this->post('/checker', [
            'url'     => route('test1'),
        ]);

        $response->assertRedirect('/checker');
        $this->assertDatabaseHas('checkers', ['user_id' => 1, 'url' => route('test1')]);
    }

    /** @test */
    function a_job_is_queued()
    {
        $this->post('/checker', [
            'url'     => route('test1'),
        ]);

        $checker = Checker::firstOrFail();

        Bus::assertDispatched(ChecksumWebsite::class, function ($job) use ($checker) {
            return $job->checker->id === $checker->id;
        });
    }
}
