@extends('Layouts.master')

@section('content')
    <link rel="stylesheet" href="src/css/homePage.css">
    <section class="row new-post">

        <br>
        <h1>Stock Exchange</h1>
        <br><br>

            <div style="float:left; width:40%;"><br>
            <div class="btn-group-vertical" role="group">
                <a class="btn btn-success btn-lg btn-block" href="{{route('getPaddyRiceStockExchange')}}" role="button">Paddy Rice Stock Exchange </a><br>
                <a href="{{route('getRiceFlourStockExchange')}}" class="btn btn-success btn-lg btn-block" role="button">Rice Flour Stock Exchange</a><br>
            </div>


        </div>
            <div style="float:left; width:60%;">
                <img width="50%" src="src/img/download.jpg"/>
            </div>
    </section>
@endsection