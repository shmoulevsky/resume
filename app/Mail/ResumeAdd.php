<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Resume\Resume;


class ResumeAdd extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Resume $resume, $url, $pdf)
    {
        $this->resume = $resume;
        $this->url = $url;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.resume.add',['resume' => $this->resume, 'url' => $this->url])->subject('Новое резюме от '.$this->resume->fullname)->attachData($this->pdf->output(), 'resume.pdf', [
            'mime' => 'application/pdf',
        ]);
    }
}
