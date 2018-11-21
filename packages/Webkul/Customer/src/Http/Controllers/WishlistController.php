<?php

namespace Webkul\Customer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Customer\Repositories\WishlistRepository;
use Cart;
use Auth;

/**
 * Customer controlller for the customer basically for the tasks of customers which will be done
 *  after customer authenticastion.
 *
 * @author    Prashant Singh <prashant.singh852@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */

class WishlistController extends Controller
{
    protected $_config;

    protected $customer;

    protected $wishlist;

    protected $product;

    /**
     * Initializes the required repository instances.
     *
     * @param $customer
     * @param $wishlist
     */
    public function __construct(CustomerRepository $customer, WishlistRepository $wishlist, ProductRepository $product)
    {
        $this->middleware('customer');

        $this->_config = request('_config');

        $this->customer = $customer;

        $this->wishlist = $wishlist;

        $this->product = $product;
    }

    /**
     * Displays the listing resources if the customer having items in wishlist.
     */
    public function index() {
<<<<<<< HEAD
        $wishlists = $this->wishlist->findWhere([
                'channel_id' => core()->getCurrentChannel()->id,
                'customer_id' => auth()->guard('customer')->user()->id]
            );

        $wishlistItems = array();

        foreach($wishlists as $wishlist) {
            array_push($wishlistItems, $this->wishlist->getItemsWithProducts($wishlist->id));
        }

=======
        $wishlistItems = $this->wishlist->findWhere([
            'channel_id' => core()->getCurrentChannel()->id,
            'customer_id' => auth()->guard('customer')->user()->id]
        );
        // dd($wishlistItems->count());
>>>>>>> 1c274447057da2b16e13a1b849e727667069c5aa
        return view($this->_config['view'])->with('items', $wishlistItems);
    }

    /**
     * Function to add item to the wishlist.
     *
     * @param integer $itemId
     */
    public function add($itemId) {
        $product = $this->product->findOneByField('id', $itemId);

<<<<<<< HEAD
        if($product->type == "configurable") {
            $slug = $product->url_key;

            session()->flash('warning', trans('customer::app.wishlist.select-options'));

            return redirect()->route('shop.products.index', $slug);
        }

=======
>>>>>>> 1c274447057da2b16e13a1b849e727667069c5aa
        $data = [
            'channel_id' => core()->getCurrentChannel()->id,
            'product_id' => $itemId,
            'customer_id' => auth()->guard('customer')->user()->id
        ];

        $checked = $this->wishlist->findWhere(['channel_id' => core()->getCurrentChannel()->id, 'product_id' => $itemId, 'customer_id' => auth()->guard('customer')->user()->id]);

        if($checked->isEmpty()) {
            if($this->wishlist->create($data)) {
                session()->flash('success', trans('customer::app.wishlist.success'));

                return redirect()->back();
            } else {
                session()->flash('error', trans('customer::app.wishlist.failure'));

                return redirect()->back();
            }
        } else {
            session()->flash('warning', trans('customer::app.wishlist.already'));

            return redirect()->back();
        }
    }

    /**
     * Function to remove item to the wishlist.
     *
     * @param integer $itemId
     */
    public function remove($itemId) {
<<<<<<< HEAD

        if($this->wishlist->deleteWhere(['customer_id' => auth()->guard('customer')->user()->id, 'channel_id' => core()->getCurrentChannel()->id, 'product_id' => $itemId])) {
            session()->flash('success', trans('customer::app.wishlist.remove'));
=======
        $result = $this->wishlist->deleteWhere(['customer_id' => auth()->guard('customer')->user()->id, 'channel_id' => core()->getCurrentChannel()->id, 'id' => $itemId]);

        if($result) {
            session()->flash('success', trans('customer::app.wishlist.removed'));
>>>>>>> 1c274447057da2b16e13a1b849e727667069c5aa

            return redirect()->back();
        } else {
            session()->flash('error', trans('customer::app.wishlist.remove-fail'));

            return redirect()->back();
        }
    }

    /**
<<<<<<< HEAD
     * Add the configurable product
     * to the wishlist.
     *
     * @return response
     */
    public function addconfigurable($urlkey) {
        session()->flash('warning', trans('Select options before adding to wishlist'));
        return redirect()->route('shop.products.index', $urlkey);
    }

    /**
=======
>>>>>>> 1c274447057da2b16e13a1b849e727667069c5aa
     * Function to move item from wishlist to cart.
     *
     * @param integer $itemId
     */
<<<<<<< HEAD
    public function moveAll() {
        Cart::moveAllToCart();
    }

    /**
     * Function to move item from wishlist to cart.
     *
     * @param integer $itemId
     */
    public function move($productId) {
        $result = Cart::moveToCart($productId);

        if($result) {
            $wishlist = $this->wishlist->findWhere(['customer_id' => auth()->guard('customer')->user()->id, 'product_id' => $productId]);

            if($this->wishlist->delete($wishlist[0]->id)) {
                Cart::collectTotals();

                session()->flash('success', 'Item Moved To Cart Successfully');

                return redirect()->back();
            } else {
                session()->flash('error', 'Item Cannot Be Moved To Cart Successfully');

                return redirect()->back();
            }
        } else {
            Session('error', 'Cannot Add The Product To Wishlist Due To Unknown Problems, Please Checkback Later');

            return redirect()->back();
        }
    }
=======
    public function move($itemId) {
        $wishlistItem = $this->wishlist->findOneByField('id', $itemId);
        $result = Cart::moveToCart($wishlistItem);

        if($result == 1) {
            if($wishlistItem->delete()) {
                session()->flash('success', trans('shop::app.wishlist.moved'));

                Cart::collectTotals();

                return redirect()->back();
            } else {
                session()->flash('error', trans('shop::app.wishlist.move-error'));

                return redirect()->back();
            }
        } else if($result == 0) {
            Session('error', trans('shop::app.wishlist.error'));

            return redirect()->back();
        } else if($result == -1) {
            if(!$wishlistItem->delete()) {
                session()->flash('error', trans('shop::app.wishlist.move-error'));

                return redirect()->back();
            }

            session()->flash('warning', trans('shop::app.checkout.cart.add-config-warning'));

            return redirect()->route('shop.products.index', $wishlistItem->product->url_key);
        }
    }

    /**
     * Function to remove all of the items items in the customer's wishlist
     *
     * @return Mixed Response & Boolean
     */
    public function removeAll() {
        $wishlistItems = auth()->guard('customer')->user()->wishlist_items;

        if($wishlistItems->count() > 0) {
            foreach($wishlistItems as $wishlistItem) {
                $this->wishlist->delete($wishlistItem->id);
            }
        }

        session()->flash('success', trans('customer::app.wishlist.remove-all-success'));
        return redirect()->back();
    }
>>>>>>> 1c274447057da2b16e13a1b849e727667069c5aa
}