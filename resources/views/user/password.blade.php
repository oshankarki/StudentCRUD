@extends('layouts.app1')
@section('title','Create')

<style>
    * {
        box-sizing: border-box;
    }

    body {
        background-color: #f1f1f1;
    }

    #regForm {
        background-color: #ffffff;
        margin-left: 5px;
        font-family: Raleway;
        padding: 40px;
        width: 95%;
        min-width: 300px;
    }

    h1 {
        text-align: center;
    }

    input {
        padding: 10px;
        width: 100%;
        font-size: 17px;
        font-family: Raleway;
        border: 1px solid #aaaaaa;
    }
    /* Mark input boxes that gets an error on validation: */

    input.invalid {
        background-color: #ffdddd;
    }
    /* Hide all steps by default: */

    .tab {
        display: none;
    }

    button {
        background-color: #04AA6D;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 17px;
        font-family: Raleway;
        cursor: pointer;
    }

    button:hover {
        opacity: 0.8;
    }

    #prevBtn {
        background-color: #bbbbbb;
    }
    .error{
        color:red;
    }
    /* Make circles that indicate the steps of the form: */

    .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
    }

    .step.active {
        opacity: 1;
    }
    /* Mark the steps that are finished and valid: */

    .step.finish {
        background-color: #04AA6D;
    }


    .table{
        width:100%;
    }
    th,td{
        width:100px;
    }
</style>
@section('content')

    <form action="{{ route('user.password.update') }}" method="POST">
        @csrf
        @method('PUT')
        <h1>Password Change Form</h1>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="text-danger">{{$error}}</p>

            @endforeach
        @endif
        <div class="tab">
            <p> <input type="password" name="current_password" id="name" value="" required placeholder="Current Password"></p>
            <p><input type="password" name="new_password"  value="" required placeholder="New Password"></p>
            <p><input type="password" name="confirm_new_password"  value="" required placeholder="Confirm New Password"></p>

        </div>
        <button type="submit" class="btn btn-primary" ><i class="fa fa-edit"></i> Update</button>

    </form>


@endsection
@section('scripts')

    var currentTab = 0;
    showTab(currentTab);

    function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    }


@endsection


