@extends('shop::layouts.master')

@section('content-wrapper')

<div class="account-content">
    @inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')

    @include('shop::customers.account.partials.sidemenu')

    <div class="account-layout">

        <div class="account-head mb-15">
            <span class="account-heading">{{ __('shop::app.wishlist.title') }}</span>

            @if(count($items))
            <div class="account-action">
<<<<<<< HEAD
                <a href="" style="margin-right: 15px;">{{ __('shop::app.wishlist.deleteall') }}</a>
                <a href="">{{ __('shop::app.wishlist.moveall') }}</a>
=======
                <a href="{{ route('customer.wishlist.removeall') }}" style="margin-right: 15px;">{{ __('shop::app.wishlist.deleteall') }}</a>
>>>>>>> 1c274447057da2b16e13a1b849e727667069c5aa
            </div>
            @endif
            <div class="horizontal-rule"></div>
        </div>

        <div class="account-items-list">

<<<<<<< HEAD
            @if(count($items))
=======
            @if($items->count())
>>>>>>> 1c274447057da2b16e13a1b849e727667069c5aa
            @foreach($items as $item)
                <div class="account-item-card mt-15 mb-15">
                    <div class="media-info">
                        @php
<<<<<<< HEAD
                            $image = $productImageHelper->getProductBaseImage($item);
                        @endphp
                        <img class="media" src="{{ $image['small_image_url'] }}" />

                        {{--  {{ dd($item['url_key'])}}  --}}

                        <div class="info mt-20">
                            <div class="product-name">
                                {{--  <a href="{{ url()->to('/').'/products/'.$item->product->url_key }}" title="{{ $item->product->name }}">  --}}
                                    {{$item->name}}
                                {{--  </a>  --}}
                            </div>
=======
                            $image = $productImageHelper->getProductBaseImage($item->product);
                        @endphp
                        <a href="{{ url()->to('/').'/products/'.$item->product->url_key }}" title="{{ $item->product->name }}">
                            <img class="media" src="{{ $image['small_image_url'] }}" />
                        </a>
                        <div class="info">
                            <div class="product-name">
                                <a href="{{ url()->to('/').'/products/'.$item->product->url_key }}" title="{{ $item->product->name }}">
                                    {{$item->product->name}}
                                </a>
                            </div>
                            @inject ('reviewHelper', 'Webkul\Product\Helpers\Review')
                            <span class="stars" style="display: inline">
                                @for($i=1;$i<=$reviewHelper->getAverageRating($item->product);$i++)
                                    <span class="icon star-icon"></span>
                                @endfor
                            </span>
>>>>>>> 1c274447057da2b16e13a1b849e727667069c5aa
                        </div>
                    </div>

                    <div class="operations">
                        <a class="mb-50" href="{{ route('customer.wishlist.remove', $item->id) }}"><span class="icon trash-icon"></span></a>

                        <a href="{{ route('customer.wishlist.move', $item->id) }}" class="btn btn-primary btn-md">{{ __('shop::app.wishlist.move-to-cart') }}</a>
                    </div>
                </div>
                <div class="horizontal-rule mb-10 mt-10"></div>
            @endforeach
            @else
                <div class="empty">
                    {{ __('customer::app.wishlist.empty') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection