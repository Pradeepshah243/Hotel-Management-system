<?php include 'Header.php';

?>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1
/crypto-js.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1
/hmac-sha256.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1
/enc-base64.min.js"></script>
</head>
<div id="information" class="spacer reserve-info ">
<div class="container">
<div class="row">
<h3>Reservation</h3>
<form role="form" method="post" action="connect.php">
        <div class="form-group">
            <input type="text" class="form-control"  placeholder="Name" name="name">
        </div>
        <div class="form-group">
            <input type="email" class="form-control"  placeholder="Email" name="mail">
        </div>
        <div class="form-group">
            <input type="Phone" class="form-control"  placeholder="Phone" name="phone">
        </div>        
        <div class="form-group">
            <div class="row">
            <div class="col-xs-4">
            <select class="form-control" name="room_type">
              <option>Type of Rooms</option>
              <option>Single Room</option>
              <option>Double Room</option>
              <option>Deluxe Room</option>
            </select>
            </div>
            <div class="col-xs-4">
            <select class="form-control" name="adult">
              <option>No. of Adult</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
            </select>
            </div>
                <div class="col-xs-4">
            <select class="form-control" name="children">
              <option>No. of Children</option>
              <option>0</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
            </select>
            </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
            <div class="col-xs-4">
                <label for="datein">Check-in Date</label>
              <input type='date' placeholder="dd-mm-yyyy" name='datein'>
            </div>
            <div class="col-xs-4">
                <label for="dateout">Check-out Date</label>
              <input type='date' placeholder="dd-mm-yyyy" name='dateout'>
            </div>
          <div class="col-xs-4">
              <input type="number" min ="1" name="days_of_stay" placeholder="Days of Stay" class="form-control">
            </div>
            </div>
        </div>
        <div class="form-group">
            <textarea class="form-control"  placeholder="Message" rows="4" name="message"></textarea>
        </div>
        <button class="btn btn-default">Submit</button>
        <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
        <input type="hidden" id="amount" name="amount" value="1000" required>
        <input type="hidden" id="tax_amount" name="tax_amount" value ="100" required>
        <input type="hidden" id="total_amount" name="total_amount" value="110" required>
        <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="241028" required>
        <input type="hidden" id="product_code" name="product_code" value ="EPAYTEST" required>
        <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
        <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
        <input type="hidden" id="success_url" name="success_url" value="https://developer.esewa.com.np/success" required>
        <input type="hidden" id="failure_url" name="failure_url" value="https://developer.esewa.com.np/failure" required>
        <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
        <input type="hidden" id="signature" name="signature" value="i94zsd3oXF6ZsSr/kGqT4sSzYQzjj1W/waxjWyRwaME=" required>
        <input value="Submit" type="submit" hidden>
 </form>
    </form>    
</div>
</div>  
</div>


<?php include 'footer.php'; ?>

