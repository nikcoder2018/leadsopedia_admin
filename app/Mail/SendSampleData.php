<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendSampleData extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $template;
    public $attachment;
    public $filename;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($template, $data, $attachment, $filename)
    {
        $this->data = $data;
        $this->template = $template;
        $this->attachment = $attachment;
        $this->filename = $filename;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->data['subject'])->markdown($this->template)->with($this->data)->attachData($this->attachment, $this->filename);
    }
}
