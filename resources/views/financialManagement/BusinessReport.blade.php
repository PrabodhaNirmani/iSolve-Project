@extends('Layouts.master')


@section('style')
<style>
    h1{
        text-align: center;
        font-family: Times;

    }

    .amount{
        text-align: right;

    }

    td{
        text-align: center;

    }

    .foobar{
        text-align: left;

    }
    label{

        font-size: large;


    }
    .subTitle{
        font-size: x-large;
        text-align: left;
    }
</style>

@endsection
@section('content')

    <section class="row new-post">

        <br>
        <h1>Business Report </h1>
        <br>

    <?php
        $from=$details[0];
        $to=$details[1];
        $purchases=$details[2];
        $orders=$details[3];
        $payableCheques=$details[4];
        $recievableCheques=$details[5];
        $salaryAmount=$details[6];


    ?>
    @if($purchases!=null or $payableCheques!=null or $orders!=null or $recievableCheques!=null or $salaryAmount!=null)
        <?php
            $totalOrder=0;
            $totalPayableCheque=0;
            $totalRecievableCheque=0;
            $totalPurchase=0;
            $totalExpenditure=0;
            $totalIncome=0;
        ?>
        <div>

            <div class="form-group">
                <label class="control-label col-sm-1 " for="from">From :</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control" name="from" id="from" value="{{$from}}" readonly>
                </div>

            </div>
            <div class="form-group">
                <label class="control-label col-sm-1" for="to">To :</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control" name="to" id="to" value="{{$to}}" readonly>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm col-sm-6">
                    <a class="btn btn-primary " href="{{route('formBack')}} " role="button">Back</a>
                </div>
            </div>

        </div>
<br><br><br>


        <h2>Expenditures</h2>
        <br>
            <table class="table table-bordered">
                <tbody>


        {{--purchases--}}


                @if($purchases!=null)
                    <tr>
                        <td class="subTitle"  colspan="4">Purchases</td>
                    <tr>

                    <tr>
                        <td>Purchase id</td>
                        <td>Purchase date</td>
                        <td>Purchase item</td>
                        <td>Cash amount</td>


                    </tr>
                    @foreach($purchases as $purchase)
                        <tr>
                            <td>{{$purchase->id}}</td>
                            <td>{{$purchase->date}}</td>
                            <td>{{$purchase->purchase_item}}</td>
                            <td class="amount">{{$purchase->cash_amount}}</td>


                        </tr>

                        <?php
                        $totalPurchase+=$purchase->cash_amount;
                        ?>
                    @endforeach
                    <tr>
                        <td class="foobar" colspan="3">Total Amount</td>
                        <td class="amount">{{$totalPurchase}}</td>

                    </tr>

                @endif


    {{--payable cheques--}}
                @if($payableCheques!=null)

                    <tr>
                        <td class="subTitle" colspan="4">Payable Cheques</td>
                    <tr>

                    <tr>
                        <td>Cheque No</td>
                        <td>Bank</td>
                        <td>Branch</td>
                        <td>Amount</td>


                    </tr>
                    @foreach($payableCheques as $cheque)
                        <tr>
                            <td>{{$cheque->cheque_no}}</td>
                            <td>{{$cheque->bank}}</td>
                            <td>{{$cheque->branch}}</td>
                            <td class="amount">{{$cheque->amount}}</td>


                        </tr>
                        <?php
                        $totalPayableCheque+=$cheque->amount;
                        ?>

                    @endforeach
                    <tr>
                        <td class="foobar" colspan="3">Total Amount</td>
                        <td class="amount">{{$totalPayableCheque}}</td>

                    </tr>
                @endif
        {{--employee salary--}}

                @if($salaryAmount!=null)


                        <tr><td class="subTitle" colspan="4"> Salories of Employees</td></tr>
                        <tr>
                            <td class="foobar" colspan="3">Amount</td>
                            <td class="amount">{{$salaryAmount}}</td>

                        </tr>
                @endif

        {{--total expenditure--}}


                    <?php $totalExpenditure=$totalPayableCheque+$totalPurchase+$salaryAmount;?>
                    <tr>
                        <td class="foobar" colspan="3">Total amount of expenditure</td>
                        <td class="amount">{{$totalExpenditure}}</td>

                    </tr>
                </tbody>






            </table>


            {{--Income--}}
<br><br>
            <h2>Income</h2>
            <br>
            <table class="table table-bordered">
                <tbody>

            {{--orders--}}

                @if($orders!=null)
                    <tr>
                        <td class="subTitle" colspan="4">Orders</td>
                    <tr>

                    <tr>
                        <td>Order id</td>
                        <td colspan="2">Order date</td>
                        {{--<td>Order item</td>--}}
                        <td>Cash amount</td>


                    </tr>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td colspan="2" >{{$order->date}}</td>

                            <td class="amount">{{$order->cash_amount}}</td>


                        </tr>
                        <?php
                        $totalOrder+=$order->cash_amount;
                        ?>

                    @endforeach

                    <tr>
                        <td class="foobar" colspan="3">Total Amount</td>
                        <td class="amount">{{$totalOrder}}</td>

                    </tr>

                @endif


            {{--recievalbe cheque--}}



                @if($recievableCheques!=null)

                    <tr>
                        <td class="subTitle" colspan="4">Recievable Cheques</td>
                    <tr>

                    <tr>
                        <td>Cheque No</td>
                        <td>Bank</td>
                        <td>Branch</td>
                        <td>Amount</td>


                    </tr>
                    @foreach($recievableCheques as $cheque)
                        <tr>
                            <td>{{$cheque->cheque_no}}</td>
                            <td>{{$cheque->bank}}</td>
                            <td>{{$cheque->branch}}</td>
                            <td class="amount">{{$cheque->amount}}</td>


                        </tr>
                        <?php
                        $totalRecievableCheque+=$cheque->amount;
                        ?>

                    @endforeach
                    <tr>
                        <td class="foobar" colspan="3">Total Amount</td>
                        <td class="amount">{{$totalRecievableCheque}}</td>

                    </tr>
                @endif



{{--total income--}}

                <?php $totalIncome=$totalRecievableCheque+$totalOrder;?>
                <tr>
                    <td class="foobar" colspan="3">Total amount of income</td>
                    <td class="amount">{{$totalIncome}}</td>

                </tr>
                </tbody>

            </table>
        <br><br>
            <div class="form-group">
                <label class="control-label col-sm-2 " for="profit">Net profit :</label>
                <div class="input-group col-sm-2">
                    <div class="input-group-addon">Rs</div>
                    <input type="number" style="text-align: right" class="form-control" name="profit" id="profit" value="{{$totalIncome-$totalExpenditure}}" readonly>
                </div>

            </div><br><br><br>


    @endif

        <br><br><br><br><br>
    </section>
@endsection