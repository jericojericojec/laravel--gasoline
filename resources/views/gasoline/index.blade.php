@extends('layout')

@section('content')
<div class="container">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Gasoline Store</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris at orci ut velit sagittis malesuada in vitae nulla. Suspendisse potenti. Duis eget sem eu dolor efficitur pharetra.</p>
    </div>
    
    <div class="row">
        <div class="col-12">
            @include('gasoline.notifications')
        </div>
    </div>

    <div class="container mb-md-5 pb-5">
        <div class="row">
            <div class="col-12 text-right">
                <a href="{{route('view')}}" class="btn btn-light">View All Transactions</a>
            </div>
        </div>
        <form method="POST" action="" enctype="multipart/form-data" id="submit_transaction">
            {!!csrf_field()!!}

            <div class="form-group">
                <label for="name">Fuel Type</label>
                <select class="custom-select {{$errors->first('fuel_type') ? 'is-invalid' : NULL}}" name="fuel_type" id="gasoline_type">
                    <option selected value="">Select Here</option>
                    <option value="unleaded">Unleaded</option>
                    <option value="diesel">Diesel</option>
                    <option value="premium">Premium</option>
                </select>
                @if($errors->first('fuel_type'))
                <span class="text-danger" id="fuel_error">{{$errors->first('fuel_type')}}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="number_of_liters">Number of Liters</label>
                <input type="number" class="form-control {{$errors->first('number_of_liters') ? 'is-invalid' : NULL}}" id="number_of_liters" placeholder="Type number of liters" name="number_of_liters"> 
                
                @if($errors->first('number_of_liters'))
                <span class="text-danger" id="ltrs_error">{{$errors->first('number_of_liters')}}</span>
                @endif
            </div>

            <input type="hidden" name="price_per_ltr" id="fuel_price">
            <input type="hidden" name="vat" id="vat">
            <input type="hidden" name="purchase_amount" id="purchase_amount">
            <input type="hidden" name="total_amount" id="total_amount">

            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="button" value="Submit" id="submit_form_btn" data-toggle="modal" data-target="#confirm-submit"  class="btn btn-primary mb-2 mb-lg-0">Submit</button>
                </div>    
            <div>
        </form>
    </div>
</div>


<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    Order Information
                </div>

                <div class="modal-body">
                    <p class="font-weight-bold">Fuel Type: <span id="fuel_type" class="font-weight-normal text-capitalize"></span></p>
                    <p class="font-weight-bold">Price per Liter amount: <span class="font-weight-normal">P </span><span id="per_liter" class="font-weight-normal"></span></p>
                    <p class="font-weight-bold">Purchase amount: <span class="font-weight-normal">P </span><span id="modal_purchase_amount" class="font-weight-normal"></span></p>
                    <p class="font-weight-bold">VAT: <span class="font-weight-normal">P </span><span id="vat_modal" class="font-weight-normal"></span></p>
                    <p class="font-weight-bold">TOTAL AMOUNT: <span class="font-weight-normal">P </span><span id="total" class="font-weight-normal"></span></p>
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="close_modal">Cancel Order</button>
                    <a href="#" id="submit" class="btn btn-primary">Confirm and Print Receipt</a>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
<script>
    
    let fuel_price = $('#fuel_price');

    $('#gasoline_type').change(function(){
        switch($(this).val()){
            case 'unleaded':
            fuel_price.val(44);
            break;
            case 'diesel':
            fuel_price.val(38);
            break;
            case 'premium' : 
            fuel_price.val(50);
            break;
        }
    });

    let vat = (value) => {
        return value * 0.12;
    }

    let total_price = (price_1, price_2) => {
        return price_1 + price_2;
    }

    let purchase_amount_price = (value_1, value_2) => {
        return value_1 * value_2;
    }

    $('#submit_form_btn').click(function() {
        let purchase_total = purchase_amount_price(fuel_price.val(), $('#number_of_liters').val());
        let vat_amount = vat(purchase_total);

        $('#fuel_type').text($('#gasoline_type').val());
        $('#per_liter').text(parseFloat($('#fuel_price').val()).toFixed(2));
        $('#modal_purchase_amount').text(purchase_total.toFixed(2));
        $('#vat_modal').text(vat_amount.toFixed(2));
        $('#total').text(total_price(vat_amount, purchase_total).toFixed(2));

        $('#purchase_amount').val(purchase_total.toFixed(2));
        $('#vat').val(vat_amount.toFixed(2));
        $('#total_amount').val(total_price(vat_amount, purchase_total).toFixed(2));
    });

    $('#submit').click(function(){
        $('#submit_transaction').submit();
        $('#close_modal').click();
        $('#gasoline_type').val('');
        $('#number_of_liters').val('');
        $('#fuel_price').val('');
        $('#vat').val('');
        $('#total_amount').val('');
        $('#purchase_amount').val('');
    });
</script>
@endsection
