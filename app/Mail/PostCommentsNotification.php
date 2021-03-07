<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostCommentsNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $commenter;
    public $post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($commenter,$post)
    {
        $this->commenter = $commenter;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.post.PostCommentsNotfication')
        ->subject("Hey ".$this->post->user->name." Someone Commented Your Post");
    }
}
