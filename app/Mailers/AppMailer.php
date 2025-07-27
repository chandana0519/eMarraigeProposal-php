<?php

namespace App\Mailers;

use App\User;
use Illuminate\Contracts\Mail\Mailer;

class AppMailer
{

    /**
     * The Laravel Mailer instance.
     *
     * @var Mailer
     */
    protected $mailer;

    /**
     * The sender of the email.
     *
     * @var string
     */
    protected $fromNoReply = 'no-reply@emarriageproposal.com';

    /**
     * The recipient of the email.
     *
     * @var string
     */
    protected $to;

    /**
     * The subject of the email.
     *
     * @var string
     */
    protected $subject = 'eMarrriageProposal Alert';

    /**
     * The view for the email.
     *
     * @var string
     */
    protected $view;

    /**
     * The data associated with the view for the email.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Create a new app mailer instance.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Deliver the email confirmation.
     *
     * @param  User $user
     * @return void
     */
    public function sendEmailConfirmationTo(User $user)
    {
        $this->subject = 'Email Confirmation - eMarriageProposal';
        $this->to = $user->email;
        $this->view = 'email.emailverification';
        $this->data = ['username' => $user->username,
                       'token' => $user->token,
                       'link' => 'http://www.emarriageproposal.com'];

        $this->deliver();
    }

    /**
     * Resend email confirmation token.
     *
     * @param  User $user
     * @return void
     */
    public function resendEmailConfirmationToken(User $user)
    {
        $this->subject = 'Email Verification Code - eMarriageProposal';
        $this->to = $user->email;
        $this->view = 'email.resendtoken';
        $this->data = ['username' => $user->username,
                       'token' => $user->token,
                       'link' => 'http://www.emarriageproposal.com'];

        $this->deliver();
    }

    /**
     * Send new mail alert
     *
     * @param  User $user
     * @return void
     */
    public function sendNewMailAlert(User $user, $toUser)
    {
        $this->subject = 'You have a new Mail - eMarriageProposal';
        $this->to = $user->email;
        $this->view = 'email.newmail';
        $this->data = ['username' => $toUser,
                        'fromuser' => $user->username,
                       'pathToImage' => public_path("/p/".$user->profileimage),
                       'link' => 'http://www.emarriageproposal.com'];

        $this->deliver();
    }

    /**
     * Send mail reply alert
     *
     * @param  User $user
     * @return void
     */
    public function sendNewReplyAlert(User $user, $toUser)
    {        
        $this->subject = 'You have a new Reply - eMarriageProposal';
        $this->to = $user->email;
        $this->view = 'email.newreply';
        $this->data = ['username' => $toUser,
                        'fromuser' => $user->username,
                       'pathToImage' => public_path("/p/".$user->profileimage),
                       'link' => 'http://www.emarriageproposal.com'];

        $this->deliver();
    }

    /**
     * Send new interest alert
     *
     * @param  User $user
     * @return void
     */
    public function sendNewInterestAlert(User $user, $toUser)
    {
        $this->subject = 'You got a new Interest - eMarriageProposal';
        $this->to = $user->email;
        $this->view = 'email.newinterest';
        $this->data = ['username' => $toUser,
                        'fromuser' => $user->username,
                       'pathToImage' => public_path("/p/".$user->profileimage),
                       'link' => 'http://www.emarriageproposal.com'];

        $this->deliver();
    }

    /**
     * Deliver the email.
     *
     * @return void
     */
    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function ($message) {
            $message->from($this->fromNoReply, 'eMarriageProposal')
                    ->to($this->to)->subject($this->subject);
        });
    }
}
