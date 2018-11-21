<?php

namespace Webkul\Api\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webkul\Api\Http\Controllers\Controller;
use Auth;
use GuzzleHttp\Client;
use Webkul\Customer\Repositories\CustomerRepository as Customer;
use Webkul\Customer\Repositories\CustomerGroupRepository as CustomerGroup;


/**
 * Customer controlller
 *
 * @author    Rahul Shukla <rahulshukla.symfony517@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class LoginController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * CustomerRepository object
     *
     * @var array
     */
    protected $customer;

     /**
     * CustomerGroupRepository object
     *
     * @var array
     */
    protected $customerGroup;


     /**
     * Create a new controller instance.
     *
     * @param Webkul\Customer\Repositories\CustomerRepository as customer;
     * @param Webkul\Customer\Repositories\CustomerGroupRepository as customerGroup;
     * @param Webkul\Core\Repositories\ChannelRepository as Channel;
     * @return void
     */
    public function __construct(Customer $customer, CustomerGroup $customerGroup )
    {
        $this->_config = request('_config');

        $this->customer = $customer;

        $this->customerGroup = $customerGroup;
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        $customer = $this->customer->all();

        return response()->json($customer);
    }
}


