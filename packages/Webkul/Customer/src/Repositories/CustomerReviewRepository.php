<?php

namespace Webkul\Customer\Repositories;

use Webkul\Core\Eloquent\Repository;
//use Webkul\Product\Models\Product;
use Webkul\Customer\Models;

/**
 * Product Review Repository
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class CustomerReviewRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\Customer\Models\CustomerReview';
    }

    public function findCustomerReview ($id)
    {
        return $this->model->where('customer_id', $id)->with('with_product')->get();
    }
}



