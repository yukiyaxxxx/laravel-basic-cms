<?php

namespace App\Mails\Inquiry;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $content;
    // 添付ファイル
    protected $attachFile;
    protected $attachFileOption;

    /**
     * AdminMail constructor.
     * @param array $content
     * @param string|null $attachFile
     * @param array $attachFileOption
     */
    public function __construct(array $content, string $attachFile = null, array $attachFileOption = [])
    {
        $this->content = $content;
        $this->attachFile = $attachFile;
        $this->attachFileOption = $attachFileOption;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from(
            config('mail.from.address'),
            config('mail.from.name')
        )
            ->subject('お問い合わせがありました。')
            ->text('Inquiry.Admin')
            ->with([
                'content' => $this->content
            ])
        ;

        // 添付ファイルあれば
        if (null != $this->attachFile) {
            $this->attach($this->attachFile, $this->attachFileOption);
        }

        return $this;
    }
}
