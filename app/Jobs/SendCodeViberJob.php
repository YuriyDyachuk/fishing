<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Bots\Telegram;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendCodeViberJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $codeVerify;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $codeVerify)
    {
        $this->codeVerify = $codeVerify;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        Http::post( 'https://api.tlgr.org/bot5396734837:AAE9la1EnBgayYi4wRFujpfJVV3VYNwFKtM/sendMessage', [
//            'chat_id' => '472237790',
//            'text' => $this->codeVerify
//        ]);
    }
}
