@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">customer name</th>
                    <th scope="col">customer Address</th>
                    <th scope="col">flavor</th>
                    <th scope="col">price</th>
                    <th scope="col">total price</th>
                    <th scope="col">quantity</th>
                    <th scope="col">status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $index => $order)
                    <tr>
                        <th scope="row">{{$index + 1}}</th>
                        <td>{{$order['customer_name']}}</td>
                        <td>{{$order['customer_address']}}</td>
                        <td>{{$order['flavors']}}</td>
                        <td>{{$order['price']}}</td>
                        <td>{{$order['total_price']}}</td>
                        <td>{{$order['quantity']}}</td>
                        <td>{{$order['status']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
