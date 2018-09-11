@extends('shop::layouts.master')

@section('content-wrapper')
    <div class="account-content">

        @include('shop::customers.account.partials.sidemenu')

        <div class="review-form-content">
            <div class="review-text">Reviews</div>
            @if ($customerReviews)
            @foreach ($customerReviews as $customerReview)


            <div class="review-product">
                <div class="product-image" style="">
                    <img src="{{ bagisto_asset('images/jeans_big.jpg') }}" class="productimg" style=""/>
                </div>
                <div class="product-detail" style="">
                    <p class="title" style="">{{ $customerReview['with_product']['name'] }}</p>
                    <img src="{{ bagisto_asset('images/Icon-Trash.png') }}" class="action"/>
                    <p class="rating" style="">
                        @for ($i=0;$i<$customerReview['rating']; $i++)
                             <span class="icon star-icon rate" style=""></span>
                        @endfor
                    </p>
                    <p class="description"style="">{{ $customerReview['comment'] }}</p>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        </div>

    </div>
@endsection
