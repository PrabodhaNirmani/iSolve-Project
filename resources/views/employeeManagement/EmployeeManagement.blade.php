@extends('Layouts.master')
@section('style')
    <style>
        h1{
            text-align: center;
            font-family: Times;

        }
        .image{
            float:left;
            width:20%;
            height:35px;

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
    <link rel="stylesheet" href="src/css/homePage.css">
    <section class="row new-post">

        <div class="page-header">
        <h1 align="center">Employee Management</h1>
        </div>
    </section>
    <section class="row new-post">
        <div style="float:left; width:30%;">
        <div class="btn-group-vertical" role="group">
            <form action="{{route('linkAddEmployee')}}" method="get">

                <button type="submit" class="btn btn-success btn-lg btn-block"><img class="image" src="src/img/icon6.png" alt="Save icon"/> Add/Edit Employee</button>
                <br>
                <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>
            <form action="{{route('linkDeleteEmployee')}}" method="get">

                <button type="submit" class="btn btn-success btn-lg btn-block"><img class="image" src="src/img/icon7.jpg" alt="Save icon"/> Delete Employee</button>
                <br>
                <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>

            <form action="{{route('linkSearchEmployee')}}" method="get">

                <button type="submit" class="btn btn-success btn-lg btn-block"><img class="image" src="src/img/icon8.jpg" alt="Save icon"/> Search Employee</button>
                <br>
                <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>

            <form action="{{route('linkAttendance')}}" method="post">

                <button type="submit" class="btn btn-success btn-lg btn-block"><img class="image" src="src/img/icon9.jpg" alt="Save icon"/> Marking Attendance</button>
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <br>
            </form>


            <form action="{{route('linkCalculateSalary')}}" method="get">

                <button type="submit" class="btn btn-success btn-lg btn-block"><img class="image" src="src/img/icon10.png" alt="Save icon"/> Calculate Salary</button>
                <br>
                <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>
        </div>

            <br><br><br><br><br>
        </div>
        <div style="float:right; width:70%;">
            <img width="60%" src="src/img/employee.jpg"/>
            <br>
        </div>

    </section>

@endsection
