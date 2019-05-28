@extends('layout')

@section('content')
<div class="container">
    
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Transactions</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris at orci ut velit sagittis malesuada in vitae nulla. Suspendisse potenti. Duis eget sem eu dolor efficitur pharetra.</p>
    </div>
    
    <div class="container mb-md-5 pb-5">
        <div class="row mb-4">
            <div class="col-12 text-right">
                    <a href="{{route('homepage')}}" class="btn btn-secondary mb-2 mb-lg-0 mr-lg-1 mr-0">Back</a>
                <a href="{{route('export')}}" class="btn btn-primary mb-2 mb-lg-0">Export Transaction CSV</a>
            </div>
        </div>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Fuel Type</th>
                    <th scope="col">Price per liter</th>
                    <th scope="col">Purchase Amount</th>
                    <th scope="col">VAT</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Date of Transaction</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $index => $transaction)
                    <tr>
                        <th scope="row">{{ucfirst($transaction->fuel_type)}}</th>
                        <td>PHP {{$transaction->price_per_ltr}}</td>
                        <td>PHP {{$transaction->purchase_amount}}</td>
                        <td>PHP {{$transaction->vat}}</td>
                        <td>PHP {{$transaction->total_amount}}</td>
                        <td>{{date_format($transaction->created_at,"m/d/Y")}}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="6"><p>No data found</p></td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
@endsection
