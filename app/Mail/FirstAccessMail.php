<?php

namespace App\Mail;

use App\Models\FirstAccess;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FirstAccessMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param FirstAccess $firstAccess
     */
    public function __construct(private FirstAccess $firstAccess)
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $time = Carbon::now()->addMinutes(config('auth.first_access.expire'));
        $url = route('first-access.create', ['token' => $this->firstAccess->token], absolute: true);

        return $this->view('mail.first-access')->with([
            'user' => $this->firstAccess->user,
            'url' => $url,
            'expires' => $time->longAbsoluteDiffForHumans()
        ]);
    }
}
