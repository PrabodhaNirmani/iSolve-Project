@extends('Layouts.master')
@section('header')
    <?php $users = \App\User::all();?>
    @foreach($users as $user)

        @if($user->username=="admin" and $user->user_type=="currentUser")
            @include('includes.header')
        @elseif($user->username=="clerk" and $user->user_type=="currentUser")
            @include('includes.headerClerk')

        @endif
    @endforeach
@endsection

@section('content')
    <h2>Non Settled Orders</h2>
    <br>
    <div class="col-md-10 col-md-offset-1">
        <table class="table table-hover">
            <tr>
                <th>Date</th>
                <th>Order ID</th>
                <th>Type</th>
                <th>Total Amount</th>
                <th>Amount Settled By Cash</th>
                <th>Amount Settled By Cheques</th>
                <th>Total Amount Paid</th>
                <th></th>
            </tr>
            <?php
            foreach ($nonSettledOrders as $order){
            $cheques = $order->cheques;
            $chequeAmount = 0;
            ?>
            <tr class="warning" onclick="document.location ='/iSolve-project/public/orderManagement/showSettledOrders/{{$order->id}}'" >
                <td>{{$order->date}}</td>
                <td>{{$order->id}}</td>
                <?php if ($order->is_rice){
                    $description = "A Rice Order";
                }
                else{
                    $description = "A Flour Order";
                }
                ?>
                <td>{{$description}}</td>
                <td>{{$order->total_price}}</td>
                <td>{{$order->cash_amount}}</td>
                <?php
                if ($cheques == null){
                    $chequeAmount = 0;
                }
                else{
                    foreach ($cheques as $cheque){
                        $chequeAmount += $cheque->amount;
                    }
                }
                ?>
                <td>{{$chequeAmount}}</td>
                <td>{{$order->cash_amount + $chequeAmount}}</td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>

@endsection