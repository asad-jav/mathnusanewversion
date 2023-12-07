@extends('layouts.landingPage')
@section('title', 'Online Math Tutoring | MATHNUSA')

@section('css')
    <style>
        html{
            scroll-behavior: smooth;
        }
    </style>
@endsection

@section('content')
    {{-- <div class="container" style="height:100vh">
        <div class="row">
            <div class="col-md-6 offset-3 mt-5" id="checkout-form">
                <h1 class="text-center display-4">Plan Subscription</h1>
                
                <div class="form-group">
                    <label for="card-holder-name">Amount</label>
                    <div class="input-group">
                        <input id="amount" class="form-control" type="text" value="{{ $amount }}" readonly>
                        <div class="input-group-append">
                          <span class="input-group-text">$</span>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="card-holder-name">Card Holder Name</label>
                    <input id="card-holder-name" class="form-control" type="text">
                </div>
                <div class="form-group">
                    <label for="card-element">Card Number</label>
                    <div id="card-element" class="form-control"></div>
                </div>
                <div class="form-group">
                    <button id="card-button" class="btn btn-primary" data-secret="{{ $intent->client_secret }}">
                        Process Payment
                    </button>
                </div>
               <div class="lead text-center" id="alert" style="color:green;"></div>
            </div>
        </div>
    </div> --}}
    <input id="card-holder-name" type="text">

    <!-- Stripe Elements Placeholder -->
    <div id="card-element"></div>

    <button id="card-button" data-secret="{{ $intent->client_secret }}">
        Update Payment Method
    </button>
@endsection

@section('script')
<script src="https://js.stripe.com/v3/"></script>

<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('stripe-public-key');

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('card-button');
const clientSecret = cardButton.dataset.secret;

cardButton.addEventListener('click', async (e) => {
    const { setupIntent, error } = await stripe.confirmCardSetup(
        clientSecret, {
            payment_method: {
                card: cardElement,
                billing_details: { name: cardHolderName.value }
            }
        }
    );

    if (error) {
        // Display "error.message" to the user...
        alert(error);
    } else {
        // The card has been verified successfully...
        alert('card verified');
    }
});
</script>


{{-- <script>
     $('#card-button').click(function(){
        $(this).text('Loading...');
        $(this).prop('disabled', true);
    });
    
    const stripe = Stripe('{{ env('STRIPE_KEY') }}');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;
       
    

    cardButton.addEventListener('click', async (e) => {
        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: { name: cardHolderName.value }
                }
            }
        );

        if (error) {
            console.log('payment error');
        } else {
            // var plan = $('#plan_id').val();
            // alert('This section is underdevelopment');
            $('#card-button').text('Process Payment');
            subscribe(setupIntent.payment_method);
        }
    });

</script> --}}

{{-- <script>
    
    function subscribe(pm) {

        $.ajax({
            type: 'POST',
            url: '{{ route('payment.submit') }}',
            data: {payment_method: pm, amount:{{ $amount }}, _token: '{{ csrf_token() }}'},
            success: function(data) {
                console.log('subscription success:', data);
                
            }
        });
    }
</script> --}}
@endsection
