<!-- Add New Credit Card Modal -->
<div class="modal fade" id="addNewCCModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">Add New Card</h3>
          <p class="text-muted">Add new card to complete payment</p>
        </div>
        <form id='checkout-form' method='post' action="{{ route('stripe.post') }}">
          @csrf
          <input type='hidden' name='stripeToken' id='stripe-token-id'>                              
          <br>
          <div id="card-element" class="form-control mb-2" ></div>
          <div class="col-12 text-center">
            <button type="button" class="btn btn-primary me-sm-3 me-1" id="pay-btn" onclick="createToken()">Submit</button>
            <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--/ Add New Credit Card Modal -->


<script src="https://js.stripe.com/v3/"></script>

<script type="text/javascript">
    var stripe = Stripe('{{ env('STRIPE_KEY') }}')
    var elements = stripe.elements();
    var cardElement = elements.create('card');

    cardElement.mount('#card-element');

    function createToken() {
        document.getElementById("pay-btn").disabled = true;

        stripe.createToken(cardElement).then(function(result) {
            if(typeof result.error != 'undefined') {
                document.getElementById("pay-btn").disabled = false;
                alert(result.error.message);
            }
            /* creating token success */
            if(typeof result.token != 'undefined') {
              document.getElementById("stripe-token-id").value = result.token.id;
              document.getElementById('checkout-form').submit();
            }
        });
    }
</script>