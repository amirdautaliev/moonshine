<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    private $code, $type;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $code, int $type)
    {
        $this->code = $code;
        $this->type = $type == 1 ? 'подтверждения почты' : 'восстановления пароля';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('send-code-mail', ['code' => $this->code, 'type' => $this->type]);
    }
}
