<?php

namespace Webkul\Shop\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webkul\Shop\Mail\SendSubscription;

use Mail;

/**
 * Subscribe controller
 *
 * @author    Pallavi Mishra <pallavi.mishra781@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $_config;

    public function __construct()
    {
        $this->_config = request('_config');
    }

    public function send()
    {
        $this->validate(request(), [
            'email' => 'required|email',
        ]);

        $title = "Send Mail";
        $content = "Test Mail";
        $mailsubject = "SUBSCRIBE NEWSLETTER";
        Mail::send('admin::mail/customer/newsletter_signup', ['title' => $title, 'content' => $content], function ($message)
        {

            $message->from('no-reply@bagisto.com', 'Bagisto');

            $message->to(request()->input('email'));

            $message->subject("SUBSCRIBE NEWSLETTER");

        });
        session()->flash('success', ' Thank you for signing up.');
        return redirect()->back();
    }
}
