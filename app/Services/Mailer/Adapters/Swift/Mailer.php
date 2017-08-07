<?php
namespace app\Services\Mailer\Adapters\Swift;

use app\Services\Mailer\Adapters\AbstractMailer;

require_once BASE_DIR.'/vendor/swiftmailer/swiftmailer/lib/swift_required.php';

class Mailer extends AbstractMailer
{
    private $mailer;

    private $body;
    private $from;
    private $to;
    private $subject;

    public function __construct()
    {
        // Create the Transport
        $transport = \Swift_SendmailTransport::newInstance();
        // Create the Mailer using your created Transport
        $this->mailer = \Swift_Mailer::newInstance($transport);
    }

    public function send()
    {
        $message = \Swift_Message::newInstance($this->subject)
            ->setFrom($this->from)
            ->setTo($this->to)
            ->setBody($this->body)
            ->addReplyTo($this->from)
        ;

        return $this->mailer->send($message);
    }

    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @param array $from ['email' => 'name']
     * @return $this
     */
    public function setFrom(array $from)
    {
        $this->from = $from;
        return $this;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @param array $to ['email1', 'email2' => 'name2']
     * @return $this
     */
    public function setTo(array $to)
    {
        $this->to = $to;
        return $this;
    }

}