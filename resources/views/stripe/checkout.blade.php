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
    <div class="container" style="height:100vh">
        <div class="row">
            <div class="col-md-6 offset-3 mt-5" id="checkout-form">
                <h1 class="text-center display-4">Plan Subscription</h1>
                
                <div class="form-group">
                    <label for="card-holder-name">Amount</label>
                    <div class="input-group">
                        <input id="card-holder-name" class="form-control" type="text" value="{{ $amount }}" readonly>
                        <div class="input-group-append">
                          <span class="input-group-text">$</span>
                        </div>
                      </div>
                </div>
                <div class="form-group">
                    <label for="card-holder-name">Plan</label>
                    <input type="hidden" id="plan_id" class="form-control" value="{{ $plan }}">
                    <input type="text" id="interval" class="form-control" value="{{ ucFirst($interval) }}" readonly>
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
    </div>
@endsection

@section('script')
<script src="https://js.stripe.com/v3/"></script>

<script>
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
            var plan = $('#plan_id').val();
            subscribe(setupIntent.payment_method, plan);
        }
    });

</script>

<script>
    
    function subscribe(pm, plan) {

        $.ajax({
            type: 'POST',
            url: '{{ route('user.subscribe') }}',
            data: {payment_method: pm, plan:plan, _token: '{{ csrf_token() }}'},
            success: function(data) {
                console.log('subscription success:', data);
                $('#alert').text('{{ __('messages.plan success') }}');
                window.location.replace("{{ url('profile') }}");
            }
        });
    }
</script>
@endsection
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script> --}}