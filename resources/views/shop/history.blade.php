@extends('layouts.app_black')

@section('content')

<section id="shop-section">
    <div id="card-shop">
        <nav class="nav-cart">
            <div class="location">
                <p>Shop History</p>
            </div>
        </nav>
    </div>
</section>

<div id="shoppingcart-main">
    <div class="align-shop">
        @foreach($history as $h)
        <div class="cart-item">
            <div tabindex="5" class="shoppingcart-image-desc">
                <img alt="history image item" src="{{$h->image }}" />
            </div>
            <div tabindex="5" class="shoppingcart-title">
                <p>{{$h->name }}</p>
            </div>
            <div tabindex="5" class="shoppingcart-amount">
                <p>{{$h->price }}€</p>

            </div>
            <div tabindex="5" class="shoppingcart-price">
                <p>{{ $h->created_at }}</p>
            </div>

        </div>
        @endforeach

        </div>
    </div>

</div>
@endsection
