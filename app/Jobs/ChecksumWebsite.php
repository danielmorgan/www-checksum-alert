<?php

namespace App\Jobs;

use App\Checker;
use App\Notifications\WebsiteChanged;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;

class ChecksumWebsite implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\Checker
     */
    public $checker;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Create a new job instance.
     */
    public function __construct(Checker $checker)
    {
        $this->checker = $checker;
        $this->client = new Client();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $response = $this->client->request('GET', $this->checker->url);
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
        }

        $checksum = sha1($response->getBody());

        $this->checker->user->notify(new WebsiteChanged($this->checker));

        $this->checker->update([
            'checksum' => $checksum,
        ]);
    }
}
