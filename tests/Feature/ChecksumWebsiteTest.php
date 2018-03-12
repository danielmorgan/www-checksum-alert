<?php

namespace Tests\Feature;

use App\Checker;
use App\Jobs\ChecksumWebsite;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChecksumWebsiteTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function it_sets_checksum_on_checker()
    {
        $checker = factory(Checker::class)->create();

        $job = new ChecksumWebsite($checker);
        $job->handle();

        $this->assertNotNull($checker->checksum);
    }
}
