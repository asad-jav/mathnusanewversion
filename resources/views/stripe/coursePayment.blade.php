@extends('layouts.landingPage')
@section('title', 'Submit Payment')

@section('css')
<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  box-sizing: border-box;

  height: 40px;

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>
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
                                    Billing Information
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="collapse show">
                            <div class="card-body">
                                <form action="{{ route('course.payment.submit') }}" method="POST" id="payment-form">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label class="font-weight-bold text-dark text-2">Card holder Name</label>
                                            <input class="form-control" name="amount" id="amount" type="hidden" value="{{ App\Models\User::countrySpecificAmount($course) }}">
                                            <input type="hidden" name="product_name" value="{{ $course->title }}">
                                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                                            <input type="hidden" name="type"  value="{{ App\Models\Payment::COURSE }}">
                                            <input type="hidden" name="course_grade" value="{{ $course->grade->id }}">
                                            <input type="hidden" name="section_id" id="section_id" value="{{$section_id}}">
                                            <input type="text" name="card_holder_name" id="card_holder_name" class="form-control" placeholder="Enter card holder name here">
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
                                    <div id="card-errors" role="alert"></div>
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
                                        <tr class="cart_table_item">
                                            <td class="product-thumbnail">
                                                <a href="shop-product-sidebar-left.html">
                                                    <img width="100" height="100" alt="" class="img-fluid" src="{{ asset('public/courses_images/'.$course->image) }}">
                                                </a>
                                            </td>
                                            <td class="product-name">
                                                {{ $course->title }}
                                            </td>
                                            <td class="product-price text-right">
                                                <span class="amount">
                                                    {{ App\Models\User::countrySpecificAmount($course) }}
                                                    {{ App\Models\User::countrySpecificSymbol() }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <hr class="solid my-5">

                                <h4 class="text-primary">Cart Totals</h4>
                                <table class="cart-totals">
                                    <tbody>
                                        <tr class="total">
                                            <th><strong class="text-dark">Amount</strong></th>
                                            <td>
                                                <strong class="text-dark">
                                                    <span class="amount">
                                                        {{ App\Models\User::countrySpecificAmount($course) }}
                                                        {{ App\Models\User::countrySpecificSymbol() }}
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
                        <tr class="total">
                            <th>
                                <strong class="text-dark">Amount</strong>
                            </th>
                            <td>
                                <strong class="text-dark">
                                    <span class="amount">
                                        {{ App\Models\User::countrySpecificAmount($course) }}
                                        {{ App\Models\User::countrySpecificSymbol() }}
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
        var stripe = Stripe('pk_test_51GwxpWC4TmetQIXp32jTVzGHZSPGHU7ymtUdrCGklqgHM04q393b6GS2W0xdeWkrGW842lwOGEFXwLUOcF7qNN4M00mLxAgYEy');

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