<?php

namespace App\Listeners;

use App\Mail\FirstAccessMail;
use App\Models\FirstAccess;
use Faker\Generator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

class SendEmailFirstAccessMail
{
    public function __construct(private Generator $generator)
    {
    }

    /**
     * Handle the event.
     *
     * @param Registered $event
     * @return void
     * @throws \Exception
     */
    public function handle(Registered $event, )
    {
        try {

            $firstAccess = FirstAccess::create([
                'token' => $this->generator->uuid,
                'user_id' => $event->user->id,
            ]);

            $firstAccess->user = $event->user;

            Mail::to($event->user)->send(new FirstAccessMail($firstAccess));
        } catch (\Swift_TransportException $e) {
            redirect()->back()->withErrors([
                'email' => 'Envio de e-mail não configurado no servidor. Por favor contacte a administração.'
            ]);
        } catch (\Exception $e) {
            logger()->error(__CLASS__, [
                'message' => $e->getMessage(),
            ]);
        }
    }
}
