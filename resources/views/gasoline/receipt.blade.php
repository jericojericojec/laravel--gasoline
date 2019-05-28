<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gasoline Store Receipt</title>
    </head>
    <body>
        <div>
            <div style="text-align: center">
                <h2 class="">Gasoline Store</h2>
            </div>
            <div style="text-align: center">
                <div>
                    <p>
                        Address : street city, state 0000 <br />
                        Email : JohnDoe@gmail.com <br />
                        Phone : 555-555-5555 <br />
                    </p>
                </div>
            </div>
            <div class="w-100 mb-5" style="border-bottom: 1px dashed #000; width: 100%; margin-bottom: 3em;"></div>
            <div>
                <table style="width: 100%">
                    <tr>
                        <th colspan="2">Gasoline Type</th>
                        <th colspan="2">Liters</th>
                        <th colspan="2">Sub Total</th>
                    </tr>
                    <tr>
                        <td colspan="2">{{ucfirst($transaction->fuel_type)}}</td>
                        <td colspan="2">{{$transaction_liters}}</td>
                        <td colspan="2">PHP {{$transaction->purchase_amount}}</td>
                    </tr>
                </table>
                <div style="border-bottom: 1px dashed #000; margin-bottom: 3em; width: 100%"></div>
                <table style="width: 100%">

                    <tr>
                        <td colspan="3">VAT</td>
                        <td colspan="3">PHP {{$transaction->vat}}</td>
                    </tr>

                    <tr>
                        <td colspan="3" style="font-size: 2em;">TOTAL</td>
                        <td colspan="3" style="font-size: 2em;">PHP {{$transaction->total_amount}}</td>
                    </tr>
                </table>
                <p class="text-center font-weight-bold mt-5" style="text-align: center; font-weight: 600; margin-top: 3em;">Thank you for your business!</p>
                <p style="text-align: center;">This served as an official receipt valid for 5 years.</p>
            </div>
        </div>
    </body>
</html>