@extends('layouts.app1')
@section('title','Profile')

<style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 300px;
        margin: auto;
        text-align: center;
        font-family: arial;
    }
    .card h1{
        margin-top: 30px;
    }

    .title {
        color: grey;
        font-size: 18px;
    }

    button {
        border: none;
        outline: 0;
        display: inline-block;
        padding: 8px;
        color: white;
        background-color: #000;
        text-align: center;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
    }

    a {
        text-decoration: none;
        font-size: 22px;
        color: black;
    }

    button:hover, a:hover {
        opacity: 0.7;
    }
    </style>
@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">

        <h1>{{auth::user()->name}}</h1>
        <p class="title">ADMIN</p>
        <p>{{auth::user()->email}}</p>

        <div style="margin: 24px 0;">
            <a href="{{route('profile.edit')}}"class="btn btn-primary">Edit Profile<i class="fa fa-edit"></i></a>
            <a href="{{route('password.change')}}"class="btn btn-primary">Change Password</a>


        </div>
    </div>

@endsection



