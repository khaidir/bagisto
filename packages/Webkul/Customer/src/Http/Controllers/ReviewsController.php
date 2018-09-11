<?php

namespace Webkul\Customer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webkul\Customer\Repositories\CustomerReviewRepository as CustomerReview;

class ReviewsController extends Controller
{
        /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * CustomerReviewRepository object
     *
     * @var array
     */
    protected $customerReview;

    /**
     * Create a new controller instance.
     *
     * @param  Webkul\Customer\Repositories\CustomerReviewRepository  $CustomerReview
     * @return void
     */
    public function __construct(CustomerReview $customerReview)
    {
        $this->customerReview = $customerReview;

        $this->_config = request('_config');
    }
    /**
     * Display a listing of the resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function index()  {
        $id = auth()->guard('customer')->user()->id;
        //$customerReviews = Reviews::where('customer_id', $id)->with('with_product')->get();
        $customerReviews = $this->customerReview->findCustomerReview($id);
        //dd($customerReviews);
        return view($this->_config['view'], compact('customerReviews'));
    }

}
?>