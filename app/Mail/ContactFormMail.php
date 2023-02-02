<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->user = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply.sikp@gmail.com')
            ->markdown('template.client.contactform')
            ->with([
                'nama' => $this->user['nama'],
                'nim' => $this->user['nim'],
                'email' => $this->user['email'],
                'perusahaan' => $this->user['perusahaan'],
                'proposal' => $this->user['proposal'],
                'dokumen' => $this->user['dokumen'],
                'sks' => $this->user['sks']
            ]);
    }
}
