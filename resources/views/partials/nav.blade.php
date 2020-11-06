<header>
    <div class="top-nav container">
        <div class="logo"><a href="/">Laravel Ecommerce</a></div>
        @if (! request()->is('checkout'))
        <ul>
        <li><a href="{{route('shop')}}">Shop</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="#">Blog</a></li>
        <li><a href="/cart">Cart <span class="cart-count">
            @if (Cart::count() > 0)
                <span>{{Cart::count()}}</span>
            @endif
        </span></a></li>
        </ul>
        @endif
    </div> <!-- end top-nav -->
</header>
