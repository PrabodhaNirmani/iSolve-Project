@extends('Layouts.master')


<style>
    h1{
        text-align: center;
        font-family: Times;

    }


</style>

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
            <h1 align="center">Add Paddy to Stock</h1>
        </div>

        <br>
        <form action="{{route('linkaddPaddy')}}" class="form-horizontal" role="form" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="from">Date :</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control" name="date" id="date" max="{{date("Y-m-d")}}" required >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="samba">Samba:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="Samba" id="samba" placeholder="Samba Quantity" min="0"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="nadu">Nadu:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="Nadu" id="nadu" placeholder="Nadu Quantity" min="0"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="redSamba">Red Samba:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="RedSamba" id="redSamba" placeholder="Red Samba Quantity" min="0"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="redNadu">Red Nadu:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="RedNadu" id="redNadu" placeholder="Red Nadu Quantity" min="0"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="kiriSamba">Kiri Samba:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="KiriSamba" id="kiriSamba" placeholder="Kiri Samba Quantity" min="0"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="suvadal">Suvadal:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="Suvadal" id="suvadal" placeholder="Suvadal Quantity" min="0"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">submit</button>
                    <input type="hidden" name="_token" value="{{Session::token()}}">

                </div>
            </div>

        </form>
        <br><br><br><br><br>
    </section>
@endsection