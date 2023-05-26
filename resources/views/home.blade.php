@extends('layouts.app1')
<style>
    .card {
        text-align: center;
        font-family: arial;
    }
    p{
        color:#04AA6D;
        font-size:30px;
    }
    .card h1{
       margin-top: 40px;
    }



</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <h1>Total Number of Students</h1>
                <a href="{{route('student.index')}}" style="text-decoration: none"> <p>{{$data['count']}}</p></a>

            </div>




        </div>
    </div>
</div>
@endsection
