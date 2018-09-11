@component('admin::mail_layouts/layout')
    {{-- Header --}}
    {{--  @slot('header')
    @component('admin::mail_layouts/header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot  --}}

    {{-- Body --}}
    <div class="container-body">
        <div class="heading"><span>Order Confirmation!</span> <br>
            <p >Dear John Deo,</p>
            <p >Thanks for Confirmation your Order <span style="color:blue">#1234567</span> placed on 7-09-2018 11:00</p>
        </div>

        <div class="heading heading-sub"><span>Summary of Order</span></div>

        <div class="addresses">

            <div class="shipping-addrerss">
                <div class="title">
                    <span> Shipping Address</span>
                </div>

                <div class="address-detail">
                    <span> John Doe</span>
                </div>
                <div>
                    <span>25, Washington </span>
                </div>
                <div>
                        <span >USA, 575124</span> <br>
                </div>
                <div>
                    <span>---</span>
                </div>
                <div class="contact">
                        <span >Contact : 9876543210</span>
                </div>
                <div class="field">
                    <span class="details-info" style="">Shipped By</span>
                </div>
                <div class="field-value">
                    <span class="details-info" >FedEx</span>
                </div>
            </div>

            <div class="billing-address">
                <div class="title">
                    <span>Billing Address</span>
                </div>
                <div class="address-detail">
                        <span> John Doe</span>
                    </div>
                    <div>
                        <span>25, Washington </span>
                    </div>
                    <div>
                            <span >USA, 575124</span> <br>
                    </div>
                    <div>
                        <span>---</span>
                    </div>
                    <div class="contact">
                            <span >Contact : 9876543210</span>
                    </div>
                    <div class="field">
                        <span class="details-info" style="">Payment Mode</span>
                    </div>
                    <div class="field-value">
                            <span class="details-info">NetBanking</span>
                    </div>
            </div>
        </div>
        <div class="productbox item" >
            <div class="productimg">
                <img src="{{ bagisto_asset('images/jeans_big.jpg') }}" >
            </div>
            <div  class="productdetail">
                <p >Rainbow Creation Embroidered</p>
                <label >Price</label> <span>$40</span></br>
                <label >Quantity</label> <span >1</span></br>
                <label >Color : Gray, Size  : S, Sleev Type: Puffed Sleeves</label>
            </div>
        </div>
        <div class="productbox subitem" >
            <div class="productimg">
                <img src="{{ bagisto_asset('images/jeans_big.jpg') }}" >
            </div>
            <div class="productdetail">
                <p >Rainbow Creation Embroidered</p>
                <label >Price</label>  <span >$40</span></br>
                <label >Quantity</label> <span >1</span></br>
                <label >Color : Gray, Size  : S, Sleev Type: Puffed Sleeves</label>
            </div>
        </div>
        <div class="product-total">
            <div class="sub-total">
                <span>Subtotal</span>
                <span class="vlaue"> $800.00</span>
            </div>
            <div class="sub-total1">
                <span>Delivery Change</span>
                <span class="vlaue"> $40.00</span>
            </div>
            <div class="coupon-discount">
                <span>Coupon Discount</span>
                <span class="vlaue"> $20.00</span>
            </div>
            <div class="amount-payable">
                <span>Amount Payable</span>
                <span class="vlaue"> $820.00</span>
            </div>
        </div>
        <div class="hr"></div>
        <div class="other-content" style="">
                <p>
                    Thanks for showing your intrest in our store. we will senr you track number once it shiped.
                </p>
                <p>
                    If you need any kind of help please contact us at <span style="color:blue">support@blisss.com</span>
                </p>
                <p>
                    Thanks!
                </p>
                <p>
                    Blisss Support Team
                </p>
        </div>

    </div>


    {{-- Footer --}}
    @slot('footer')
        @component('admin::mail_layouts/footer')
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
