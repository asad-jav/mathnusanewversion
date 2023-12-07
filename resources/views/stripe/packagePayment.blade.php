@extends('layouts.landingPage')
@section('title', 'Submit Payment')

@section('css')
@endsection

@section('content')
    <!-- Checkout start here -->
    <div class="container shop py-3 mt-5">
        <div class="row pb-4">
            <div class="col-lg-8">
                <div class="accordion accordion-modern" id="accordion">
                    <div class="card card-default">
                        <div class="card-header">
                            <h4 class="card-title m-0">
                                <a class="accordion-toggle text-uppercase" data-toggle="collapse"
                                    data-parent="#accordion" href="#collapseOne">
                                    Billing &nbsp; Information
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="collapse show">
                            <div class="card-body">
                                <form action="{{ route('payment.submit') }}" method="POST" id="payment-form">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label class="font-weight-bold text-dark text-2">Card holder Name</label>
                                            <input class="form-control" name="amount" id="amount" type="hidden" value="{{ App\User::countrySpecificAmount($package) }}">
                                            <input type="hidden" name="type"  value="{{ App\Payment::PACKAGE }}">
                                            <input type="hidden" name="product_name" value="{{ $package->title }}">
                                            <input type="hidden" name="package_id" value="{{ $package->id }}">

                                            <input type="text" id="card-holder-name" class="form-control" placeholder="Enter card holder name here">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label class="font-weight-bold text-dark text-2">Card Number</label>
                                            <div id="card-element" class="form-control"></div>
                                        </div>
                                    </div>
                                    <div class="actions-continue">
                                        <button class="btn btn-rounded btn-primary btn-modern font-weight-bold text-uppercase mt-2 mb-5 px-5 text-3 mb-lg-2">
                                            Process Payment
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card card-default">
                        <div class="card-header">
                            <h4 class="card-title m-0">
                                <a class="accordion-toggle text-uppercase" data-toggle="collapse"
                                    data-parent="#accordion" href="#collapseThree">
                                    Review &amp; Payment
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="collapse">
                            <div class="card-body">
                                <h4>{{ $package->title }}</h4>
                                <table class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">
                                                &nbsp;
                                            </th>
                                            <th class="product-name">
                                                Product
                                            </th>
                                            <th class="product-price text-right">
                                                Price
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($package->courses as $course)
                                            <tr class="cart_table_item">
                                                <td class="product-thumbnail">
                                                    <a href="shop-product-sidebar-left.html">
                                                        <img width="100" height="100" alt="" class="img-fluid"
                                                            src="{{ asset('public/courses_images/'.$course->image) }}">
                                                    </a>
                                                </td>
                                                <td class="product-name">
                                                    {{ $course->title }}
                                                </td>
                                                <td class="product-subtotal text-right">
                                                    {{ App\User::countrySpecificAmount($course) }}
                                                    {{ App\User::countrySpecificSymbol() }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <hr class="solid my-5">

                                <h4 class="text-primary">Cart Totals</h4>
                                <table class="cart-totals">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>
                                                <strong class="text-dark">Courses Total Amount</strong>
                                            </th>
                                            <td>
                                                <strong class="text-dark">
                                                    <span class="amount">
                                                        <del>
                                                            {{ App\Package::totalCoursesAmount($package->id) }}
                                                            {{ App\User::countrySpecificSymbol() }}
                                                        </del>
                                                    </span>
                                                </strong>
                                            </td>
                                        </tr>
                                        <tr class="total">
                                            <th><strong class="text-dark">Package Amount</strong></th>
                                            <td>
                                                <strong class="text-dark">
                                                    <span class="amount">
                                                        {{ App\User::countrySpecificAmount($package) }}
                                                        {{ App\User::countrySpecificSymbol() }}
                                                    </span>
                                                </strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h4 class="text-primary text-uppercase">Cart Totals</h4>
                <table class="cart-totals">
                    <tbody>
                        <tr class="cart-subtotal">
                            <th>
                                <strong class="text-dark">Actual Amount</strong>
                            </th>
                            <td>
                                <strong class="text-dark">
                                    <span class="amount">
                                        <del>
                                            {{ App\Package::totalCoursesAmount($package->id) }}
                                            {{ App\User::countrySpecificSymbol() }}
                                        </del>
                                    </span>
                                </strong>
                            </td>
                        </tr>
                        
                        <tr class="total">
                            <th>
                                <strong class="text-dark">Pkg Amount</strong>
                            </th>
                            <td>
                                <strong class="text-dark">
                                    <span class="amount">
                                        {{ App\User::countrySpecificAmount($package) }}
                                        {{ App\User::countrySpecificSymbol() }}
                                    </span>
                                </strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Create a Stripe client.
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
            color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
    </script>
        
@endsection