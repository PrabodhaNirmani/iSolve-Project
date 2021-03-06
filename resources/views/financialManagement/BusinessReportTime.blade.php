@extends('Layouts.master')


@section('style')
    <style>
        h1{
            text-align: center;
            font-family: Times;

        }

    </style>

@endsection

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

    <section class="row new-post">


        <div class="page-header">
            <h1>Business Report </h1>
        </div>

        @if($wrong!=null)
            <div class="alert alert-warning" role="alert">{{$wrong}}</div>
        @endif
        <form action="{{route('submitDate')}}" class="form-horizontal" role="form" method="post">
            <?php
            {{$date=date("Y-m-d");}}
            ?>
            <div class="form-group">
                <label class="control-label col-sm-2" for="from">From :</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control" name="from" id="from" required max="{{date("Y-m-d")}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="to">To :</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control" name="to" id="to" required max="{{date("Y-m-d")}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">submit</button>
                    <input type="hidden" name="_token" value="{{Session::token()}}">

                </div>
            </div>
        </form>
    </section>
@endsection