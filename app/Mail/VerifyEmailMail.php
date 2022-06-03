<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    private int $userId;
    private string $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $userId, string $token)
    {
        $this->userId = $userId;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->subject('Верификайция електронной почты.')
                    ->view('sites.emails.verify-form')
                    ->with([
                        'userId' => $this->userId,
                        'token' => $this->token
                    ]);
    }
}