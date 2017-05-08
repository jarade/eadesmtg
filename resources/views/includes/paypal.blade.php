<div id="paypal-button-container" class="row pull-right">
        <p>Postage: <b>${{ number_format(session('postage'), 2) }}</b></p>
        <p>Total: <b>${{ number_format(session('totalPrice'), 2) }}</b></p>
</div>
<div id="confirm" style="display:none" class="row col-sm-12 pull-center">
    <div class='row pull-left'>
        <div>Ship to:</div>
        <div><span id="recipient"></span>, <span id="line1"></span>, <span id="city"></span></div>
        <div><span id="state"></span>, <span id="zip"></span>, <span id="country"></span></div>
    </div>
    <div class='row pull-right'>
        <p>The final total comes to:</p>
        <p><b>${{ number_format(session('totalPrice'), 2) }}</b>.</p>
        <button id="confirmButton" class='btn btn-color'>Complete Payment</button>
    </div>
</div>

<div id="thanks" style="display:none">
    Thanks, <span id="thanksname"></span>!
</div>
@php
    $cartArr = session()->get('cart');
    
@endphp
{{ json_encode($cartArr) }}
<script>
    var json = "{{ json_encode($cartArr) }}";
    
    // Render the PayPal button
    paypal.Button.render({

        // Set your environment
        env: 'sandbox', // sandbox | production

        // Style Options
        style: {
            label: 'checkout',
            size: 'medium',
            shape: 'rect'
        },

        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create
        client: {
            sandbox:'ARvx69ORsc2fwU3MDzWxzfi-kDN7oZhfep39SW2XLohUst63tqkTv2ebbYXyNrLcozZXok4J0LOvp_3u',
            production: 'ARvx69ORsc2fwU3MDzWxzfi-kDN7oZhfep39SW2XLohUst63tqkTv2ebbYXyNrLcozZXok4J0LOvp_3u'
        },

       

        // Wait for the PayPal button to be clicked

        payment: function() {

            // Make a client-side call to the REST api to create the payment
            return paypal.rest.payment.create(this.props.env, this.props.client, {
                transactions: [
                    {
                        amount: { 
                            'total': '{{ session("totalPrice") }}', 
                            'currency': 'AUD',
                        }
                    }
                ]
            });
        },

         onAuthorize: function(data, actions) {

            // Get the payment details

            return actions.payment.get().then(function(data) {

                // Display the payment details and a confirmation button

                var shipping = data.payer.payer_info.shipping_address;

                document.querySelector('#recipient').innerText = shipping.recipient_name;
                document.querySelector('#line1').innerText     = shipping.line1;
                document.querySelector('#city').innerText      = shipping.city;
                document.querySelector('#state').innerText     = shipping.state;
                document.querySelector('#zip').innerText       = shipping.postal_code;
                document.querySelector('#country').innerText   = shipping.country_code;

                document.querySelector('#paypal-button-container').style.display = 'none';
                document.querySelector('#confirm').style.display = 'block';

                $('.cartQuantity').each(function(i, obj){
                    $(this).attr('disabled', true);
                });
                $('.updateCart').each(function(i, obj){
                    $(this).remove();
                });
                // Listen for click on confirm button
                document.querySelector('#confirmButton').addEventListener('click', function() {

                    // Disable the button and show a loading message

                    document.querySelector('#confirm').innerText = 'Loading...';
                    document.querySelector('#confirm').disabled = true;

                    // Execute the payment

                    return actions.payment.execute().then(function() {

                        // Show a thank-you note

                        document.querySelector('#thanksname').innerText = shipping.recipient_name;

                        document.querySelector('#confirm').style.display = 'none';
                        document.querySelector('#thanks').style.display = 'block';

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        
                        $.ajax({
                            type: "POST",
                            url: "receipt",
                            dataType: 'json',
                            data: {
                                items: json
                            },
                            success: function(data){
                                window.location.href = "{{ url('/receipt') }}";
                            }
                        });
                        
                    });
                });
            });
        }

    }, '#paypal-button-container');

</script>