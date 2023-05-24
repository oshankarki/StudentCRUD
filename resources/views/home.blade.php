@extends('layouts.app')
<style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        text-align: center;
        font-family: arial;
    }
    p{
        color:#04AA6D;
        font-size:30px;
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
