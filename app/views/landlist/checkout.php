<?php $this->view("landlist/header", $data); ?>

 <!-- Header -->
    <header class="header">
        <div class="row">
            <h2><?=$data['page_title']?></h2>
        </div>
    </header>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">
                        <h3><?=$data['page_title']?></h3>    
                        <div class="row">
                            <div class="col">
                                <div class="jumbotron jumbotron-fluid">
                                  <div class="container">
                                    <p class="lead">
                                      <!-- <form action="/posting/s1" method="post"> -->
                                        <div class="form-group">
                                          <div class="container px-4">
                                            <div class="row gx-5">
                                              <div class="col">
                                                <div class="p-3 border bg-light text-left">
                                                  <label class="font-weight-bold" for="exampleInputEmail1">Company Name</label>
                                                  <input type="company" class="form-control" id="company" name="company" aria-describedby="emailHelp" placeholder="Name" required="">
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          
                                        </div>                                        
                                        <!-- <button type="submit" class="btn btn-primary" name="submit" value="Submit">Save and Continue</button> -->
                                        <button onclick="p1()" class="btn btn-primary">Save and Continue</button>
                                        <div id="tks"></div>
                                      <!-- </form> -->
                                    </p>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->            
        </div> <!-- end of container -->

    </header> <!-- end of header -->

    <!-- end of header -->
    <script src="https://js.stripe.com/v3/"></script>
    <div class="container">
      <div class="row g-5">
        <form action="//httpbin.org/post" method="POST">
          <input type="hidden" name="token" />
          <div class="group">
            <label>
              <span>Card</span>
              <div id="card-element" class="field"></div>
            </label>
          </div>
          <div class="group">
            <label>
              <span>First name</span>
              <input id="first-name" name="first-name" class="field" placeholder="Manoj" />
            </label>
            <label>
              <span>Last name</span>
              <input id="last-name" name="last-name" class="field" placeholder="Halugona" />
            </label>
          </div>
          <div class="group">
            <label>
              <span>Address</span>
              <input id="address-line1" name="address_line1" class="field" placeholder="77 Winchester Lane" />
            </label>
            <label>
              <span>Address (cont.)</span>
              <input id="address-line2" name="address_line2" class="field" placeholder="" />
            </label>
            <label>
              <span>City</span>
              <input id="address-city" name="address_city" class="field" placeholder="Coachella" />
            </label>
            <label>
              <span>State</span>
              <input id="address-state" name="address_state" class="field" placeholder="SA" />
            </label>
            <label>
              <span>ZIP</span>
              <input id="address-zip" name="address_zip" class="field" placeholder="92236" />
            </label>
            <label>
              <span>Country</span>
              <select name="address_country" id="address-country" class="field">
                <option value="IN">India</option>
                <option value="SG" selected>Singapore</option>
              </select>
            </label>
          </div>
          <button type="submit">Pay $25</button>
          <div class="outcome">
            <div class="error"></div>
            <div class="success">
              Success! Your Stripe token is <span class="token"></span>
            </div>
          </div>
        </form>
      </div>
    </div>
    <script>
      var stripe = Stripe('pk_test_51LOPKYAujs3mwwZevLsgw4A6CpA7oDfYReFkuiGZrN0he1FPmtHJSjyLg0SeeZtlPg7yB8F9PcjDdsBfvzpDtxRQ00fwoubXCn');
      var elements = stripe.elements();

      var card = elements.create('card', {
        hidePostalCode: true,
        style: {
          base: {
            iconColor: '#666EE8',
            color: '#31325F',
            lineHeight: '40px',
            fontWeight: 300,
            fontFamily: 'Helvetica Neue',
            fontSize: '15px',

            '::placeholder': {
              color: '#CFD7E0',
            },
          },
        }
      });
      card.mount('#card-element');

      function setOutcome(result) {
        var successElement = document.querySelector('.success');
        var errorElement = document.querySelector('.error');
        successElement.classList.remove('visible');
        errorElement.classList.remove('visible');

        if (result.token) {
          // In this example, we're simply displaying the token
          successElement.querySelector('.token').textContent = result.token.id;
          successElement.classList.add('visible');

          // In a real integration, you'd submit the form with the token to your backend server
          //var form = document.querySelector('form');
          //form.querySelector('input[name="token"]').setAttribute('value', result.token.id);
          //form.submit();
        } else if (result.error) {
          errorElement.textContent = result.error.message;
          errorElement.classList.add('visible');
        }
      }

      card.on('change', function(event) {
        setOutcome(event);
      });

      document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        var options = {
          name: document.getElementById('first-name').value + " " + document.getElementById('last-name').value,
          address_line1: document.getElementById('address-line1').value,
          address_line2: document.getElementById('address-line2').value,
          address_city: document.getElementById('address-city').value,
          address_state: document.getElementById('address-state').value,
          address_zip: document.getElementById('address-zip').value,
          address_country: document.getElementById('address-country').value,
        };
        stripe.createToken(card, options).then(setOutcome);
      });


    </script>
<?php $this->view("landlist/footer", $data); ?>

