<?php

namespace Tests\Feature;

use App\Checker;
use App\Jobs\ChecksumWebsite;
use App\Notifications\WebsiteChanged;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChecksumWebsiteTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        Notification::fake();
    }

    /** @test */
    function it_sets_checksum_on_checker()
    {
        $checker = factory(Checker::class)->create();
        $job = new ChecksumWebsite($checker);

        $job->handle();

        $this->assertNotNull($checker->checksum);
    }

    /** @test */
    function triggers_notification_if_checksum_changes()
    {
        $user = factory(User::class)->create();
        $checker = factory(Checker::class)->create([
            'user_id' => $user->id,
        ]);
        $job = new ChecksumWebsite($checker);

        $job->handle();

        Notification::assertSentTo($user, WebsiteChanged::class);
    }
}
