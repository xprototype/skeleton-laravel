<?php

namespace App\Domains\Mail;

use App\Domains\Util\Instance;
use App\Domains\Common\Prototype;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;
use stdClass;

/**
 * Class MailModel
 * @package App\Domains\Mail
 */
class MailModel extends Mailable
{
    /**
     * @trait
     */
    use Queueable, SerializesModels, Instance;

    /**
     * @var Prototype
     */
    public $data;

    /**
     * @var string
     */
    protected $template;

    /**
     *
     * Create a new message instance.
     *
     * @param string $template
     * @param stdClass $data
     */
    public function __construct(string $template, stdClass $data)
    {
        $locale = Lang::getLocale();
        $this->template = "mail.{$locale}.{$template}";
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->template);
    }
}
