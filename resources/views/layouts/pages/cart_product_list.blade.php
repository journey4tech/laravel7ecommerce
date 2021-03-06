@extends('layouts.app')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('Frontend/styles/cart_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('Frontend/styles/cart_responsive.css') }}">

@endpush
@section('content')
	<!-- Cart -->

	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="cart_container">
						<div class="cart_title">Shopping Cart</div>
						<div class="cart_items">
							<ul class="cart_list">
                                @foreach($cartList as $row)
								<li class="cart_item clearfix">
									<div class="cart_item_image"><img height="100" src="{{ asset('Backend/assets/images/product/'.$row->options->image) }}" alt=""></div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Name</div>
											<div class="cart_item_text">{{ $row->name }}</div>
										</div>
										<div class="cart_item_color cart_info_col">
											<div class="cart_item_title">Color</div>
											<div class="cart_item_text">{{ $row->options->color }}</div>
										</div>
										@if($row->options->size == NULL)
										@else
										<div class="cart_item_color cart_info_col">
											<div class="cart_item_title">Size</div>
											<div class="cart_item_text">{{ $row->options->size }}</div>
										</div>
										@endif
										<div class="cart_item_quantity cart_info_col">
                                            <div class="cart_item_title mt-3">Quantity</div>
                                            <br>
                                            <form method="POST" action="{{ route('cart.product.update', $row->rowId) }}">
                                                @csrf
                                                <input name="qty" style="width: 50px; height:30px;" type="number" value="{{ $row->qty }}">
                                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check-square"></i></button>
                                            </form>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Price</div>
											<div class="cart_item_text">${{ $row->price }}</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Total</div>
											<div class="cart_item_text">${{ $row->price*$row->qty }}</div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_title mt-3">Action</div>
                                            <br>
											<a href="{{ route('cart.product.remove', $row->rowId) }}" class="btn btn-danger btn-sm">X</a>
										</div>
									</div>
                                </li>
                                @endforeach
							</ul>
						</div>
						
						<!-- Order Total -->
						<div class="order_total">
							<div class="order_total_content text-md-right">
								<div class="order_total_title">Order Total:</div>
								<div class="order_total_amount">${{ Cart::Subtotal() }}</div>
							</div>
						</div>

						<div class="cart_buttons">
							<button type="button" class="button cart_button_clear">Cancle All</button>
							<a href="{{ route('user.checkout') }}" type="button" class="button cart_button_checkout">Checkout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
@push('js')
<script src="{{ asset('Frontend/js/cart_custom.js') }}"></script>   
@endpush