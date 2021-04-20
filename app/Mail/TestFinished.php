<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Resume\Resume;
use App\Models\Test\Test;
use App\Models\Test\TestResult;

class TestFinished extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Resume $resume,Test $test,TestResult $test_result, $url)
    {
        $this->resume = $resume;
        $this->test = $test;
        $this->test_result = $test_result;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.test.finished',
        ['resume' => $this->resume, 
        'test' => $this->test, 
        'test_result' => $this->test_result, 
        'url' => $this->url]
        )->subject('Результат тестирования '.$this->resume->fullname);
    }
}
