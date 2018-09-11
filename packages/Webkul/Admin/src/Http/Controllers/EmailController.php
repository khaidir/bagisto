<?php

namespace Webkul\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
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
   /* protected $_config;

    public function __construct()
    {
        $this->_config = request('_config');
    }*/

    public function send()
    {
        $title = "Send Mail";
        $content = "Test Mail";

        Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message)
        {

            $message->from('pallavi.mishra781@webkul.com', 'Pallavi Mishra');

            $message->to('pallavi.mishra781@webkul.com');

        });


        return response()->json(['message' => 'Request completed']);
    }
}
