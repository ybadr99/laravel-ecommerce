@extends('layout')

@section('title', 'Shopping Cart')

@section('extra-css')

@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <a href="#">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>Shopping Cart</span>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="cart-section container">
        <div>
            @include('partials.message')

            @if (Cart::Count() > 0)
                

            <h2>{{Cart::Count()}} items in Shopping Cart</h2>

            <div class="cart-table">

                @foreach (Cart::content() as $item)
                    <div class="cart-table-row">
                        <div class="cart-table-row-left">
                        <a href="{{route('shop.show',$item->model->id)}}"><img src="/img/macbook-pro.png" alt="item" class="cart-table-img"></a>
                            <div class="cart-item-details">
                            <div class="cart-table-item"><a href="{{route('shop.show',$item->model->id)}}">{{$item->model->name}}</a></div>
                                <div class="cart-table-description">{{$item->model->details}}</div>
                            </div>
                        </div>
                        <div class="cart-table-row-right">
                            <div class="cart-table-actions">
                                <form action="{{route('cart.destroy',$item->rowId )}}" method="POST">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="cart-options">Remove</button>
                                </form>
                                <br>
                                <form action="{{route('cart.savelater',$item->rowId )}}" method="POST">
                                    {{csrf_field()}}
                                    
                                    <button type="submit" class="cart-options">Save For Later</button>
                                </form>
                            
                            </div>
                            <div>
                                <select class="quantity">
                                    <option selected="">1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div>${{$item->model->presentPrice()}}</div>
                        </div>
                    </div> <!-- end cart-table-row -->
                @endforeach


            </div> <!-- end cart-table -->

            <a href="#" class="have-code">Have a Code?</a>

            <div class="have-code-container">
                <form action="#">
                    <input type="text">
                    <input type="submit" class="button" value="Apply">
                </form>
            </div> <!-- end have-code-container -->

            <div class="cart-totals">
                <div class="cart-totals-left">
                    Shipping is free because we’re awesome like that. Also because that’s additional stuff I don’t feel like figuring out :).
                </div>

                <div class="cart-totals-right">
                    <div>
                        Subtotal <br>
                        Tax (14%)<br>
                        <span class="cart-totals-total">Total</span>
                    </div>
                    <div class="cart-totals-subtotal">
                        ${{Cart::subtotal()}} <br>
                        ${{presentPrice(Cart::tax())}}<br>
                        <span class="cart-totals-total">${{Cart::total()}}</span>
                    </div>
                </div>
            </div> <!-- end cart-totals -->

            <div class="cart-buttons">
                <a href="#" class="button">Continue Shopping</a>
                <a href="#" class="button-primary">Proceed to Checkout</a>
            </div>

            @else
                <h3>No Items in Cart</h3>
                <br><br>
                <a href="{{route('shop')}}" class="button">Continue Shopping</a>
                <br><br>

            @endif
            



            @if (Cart::instance('savelater')->count() > 0)
                <h2> {{Cart::instance('savelater')->count()}} items Saved For Later</h2>

            <div class="saved-for-later cart-table">
                
                @foreach (Cart::instance('savelater')->content() as $item)
                    
                <div class="cart-table-row">
                    <div class="cart-table-row-left">
                        <a href="{{route('shop.show',$item->id)}}"><img src="/img/macbook-pro.png" alt="item" class="cart-table-img"></a>
                        <div class="cart-item-details">
                        <div class="cart-table-item"><a href="{{route('shop.show',$item->id)}}">{{$item->name}}</a></div>
                            <div class="cart-table-description">{{$item->model->details}}</div>
                        </div>
                    </div>
                    <div class="cart-table-row-right">
                        <div class="cart-table-actions">

                        <form action="{{route('savelater.destroy',$item->rowId)}}" method="POST">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" class="cart-options">Remove</button>
                        </form>

                        <form action="{{route('savelater.movetocart',$item->rowId)}}" method="POST">
                            {{csrf_field()}}
                            <button type="submit" class="cart-options">Move to cart</button>
                        </form>


                        </div>
                        {{-- <div>
                            <select class="quantity">
                                <option selected="">1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div> --}}
                        <div>${{$item->model->presentPrice()}}</div>
                    </div>
                </div> <!-- end cart-table-row -->
                @endforeach

            </div> <!-- end saved-for-later -->
            
            @else

                <h3>You have no items save for later</h3>

            @endif

        </div>

    </div> <!-- end cart-section -->

    @include('partials.might-like')


@endsection
