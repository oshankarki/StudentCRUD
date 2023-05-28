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
    .compulsory{
        color: red;
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

    <form action="{{route('student.update', $data['record']->id)}}" method="post" id="regForm" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        @csrf
        <h1>Student Update Form</h1>
        <!-- One "tab" for each step in the form: -->
        <div class="tab"><h2>Basic Information:</h2>
            <br>
            Full Name<span class="compulsory">*</span>:
            <p><input placeholder="Fullname" oninput="this.className = ''" name="name" type="text" value="{{$data['record']->name}}"></p>
            <span id="name" class="error"></span>
            <br>
            Email<span class="compulsory">*</span>:
            <br>
            <p><input placeholder="Email" oninput="this.className = ''" name="email" type="email" value="{{$data['record']->email}}"></p>
            <span id="email" class="error"></span>
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
            <br>
            Phone Number<span class="compulsory">*</span>:
            <p><input placeholder="Phone Number" oninput="this.className = ''" name="phone" type="text" value="{{$data['record']->phone}}"></p>
            <span id="phone" class="error"></span>
            <br>
            Address<span class="compulsory">*</span>:
            <p><input placeholder="Address" oninput="this.className = ''" name="address" value="{{$data['record']->address}}"></p>
            <span id="address" class="error"></span>
            <br>
            Date of Birth<span class="compulsory">*</span>:
            <p><input placeholder="dob" oninput="this.className = ''" name="dob" type="date" value="{{$data['record']->dob}}"></p>
            <span id="dob" class="error"></span>
            <br>
            <img src="{{ asset('storage/images/'.$data['record']->image) }}" alt="Student Image" height="100px" width="100">
            <p>Replace Image</p>
            Image:
            <div id="imagePreviewContainer" style="display: none;">
                <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 200px; max-height: 200px;">
            </div>

            <p><input onchange="previewImage(this)" oninput="this.className = ''" name="image" type="file"></p>
            <br>

            <p>
                <label>Gender<span class="compulsory">*</span>:</label>
                <br>
                @if($data['record']->gender=="1")
                <label for="male">
                    <input type="radio" id="male" name="gender" value="1" checked> Male
                </label>
                <label for="female">
                    <input type="radio" id="female" name="gender" value="2"> Female
                </label>
                @endif
                @if($data['record']->gender=="2")
                <label for="male">
                    <input type="radio" id="male" name="gender" value="1"> Male
                </label>
                <label for="female">
                    <input type="radio" id="female" name="gender" value="2" checked> Female
                </label>
                @endif

            </p>
            <span id="gender" class="error"></span>
            <br>

        </div>
        <div class="tab">Education
            <table class="table table-striped table-bordered" id="attribute_wrapper">
                <tr>
                    <th>Level<span class="compulsory">*</span></th>
                    <th>College<span class="compulsory">*</span></th>
                    <th>University<span class="compulsory">*</span></th>
                    <th>Start Date<span class="compulsory">*</span></th>
                    <th>End Date<span class="compulsory">*</span></th>
                    <th>Action</th>


                </tr>

                @foreach($data['record']->educations as $edu_record)

                    <tr>

                        <td><input type="text" name="level[]" class="form-control" placeholder="Enter Level" value="{{$edu_record->level}}"/></td>
                        <td><input type="text" name="college[]" class="form-control" placeholder="Enter College" value="{{$edu_record->college}}"/></td>
                        <td><input type="text" name="university[]" class="form-control" placeholder="Enter University" value="{{$edu_record->university}}"/></td>
                        <td><input type="date" name="start_date[]" class="form-control" value="{{$edu_record->start_date}}"/></td>
                        <td><input type="date" name="end_date[]" class="form-control"value="{{$edu_record->end_date}}" /></td>


                        <td>
                            <a class="btn btn-block btn-warning sa-warning remove_row "><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td>
                        <span id="level[]" class="error"></span>
                    </td>
                    <td>
                        <span id="college[]" class="error"></span>
                    </td>
                    <td>
                        <span id="university[]" class="error"></span>

                    </td>
                    <td>
                        <span id="start_date[]" class="error"></span>

                    </td>
                    <td>
                        <span id="end_date[]" class="error"></span>

                    </td>
                </tr>


            </table>
            <button class="btn btn-info" type="button" id="addMoreAttribute" style="margin-bottom: 20px">
                <i class="fa fa-plus"></i>
                Add
            </button>
        </div>

        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
        </div>
        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
        </div>

    </form>
    </form>
@endsection
@section('scripts')

    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
    } else {
    document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
    document.getElementById("nextBtn").innerHTML = "Next";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
    }

    function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
    }

    function validateForm() {
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");

    // Clear all error messages
    var errorElements = document.getElementsByClassName("error");
    for (i = 0; i < errorElements.length; i++) {
    errorElements[i].innerHTML = "";
    }

    // Validate each field
    for (i = 0; i < y.length; i++) {
    var value = y[i].value.trim();
    var fieldName = y[i].name;

    if (value === "" && fieldName !== "image") {
    y[i].className += " invalid";
    valid = false;
    document.getElementById(fieldName).innerHTML = "This field is required.";
    } else {
    // Additional checks for specific fields
    if (fieldName === "name" && !/^[a-zA-Z\s]+$/.test(value)) {
    y[i].className += " invalid";
    valid = false;
    document.getElementById("name").innerHTML = "Please enter a valid name (only text characters are allowed).";
    } else if (fieldName === "email" && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
    y[i].className += " invalid";
    valid = false;
    document.getElementById("email").innerHTML = "Please enter a valid email address.";
    } else if (fieldName === "phone" && !/^[0-9]{10}$/.test(value)) {
    y[i].className += " invalid";
    valid = false;
    document.getElementById("phone").innerHTML = "Please enter a valid phone number.";
    }
    }
    }

    // If the valid status is true, mark the step as finished and valid
    if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
    }

    return valid;
    }


    function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " active";
    }

    // Function to preview the image
    function previewImage(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
    $('#imagePreview').attr('src', e.target.result);
    $('#imagePreviewContainer').show();
    }
    reader.readAsDataURL(input.files[0]);
    } else {
    $('#imagePreview').attr('src', '#');
    $('#imagePreviewContainer').hide();
    }
    }
    var attribute_wrapper = $("#attribute_wrapper"); //Fields wrapper
    var add_button_attribute = $("#addMoreAttribute"); //Add button ID
    var y = 1;
    $(add_button_attribute).click(function (e) { //on add input button click
    e.preventDefault();
    var max_fields = 5; //maximum input boxes allowed
    if (y < max_fields) { //max input box allowed
    y++; //text box increment
    //add new row
    $("#attribute_wrapper tr:last").after(
    '<tr>'+
        '<td><input type="text" name="level[]" class="form-control" placeholder="Enter Level"/></td>'+
        '<td><input type="text" name="college[]" class="form-control" placeholder="Enter College"/></td>'+
        '<td><input type="text" name="university[]" class="form-control" placeholder="Enter University"/></td>'+
        '<td><input type="date" name="start_date[]" class="form-control" /></td>'+
        '<td><input type="date" name="end_date[]" class="form-control" /></td>'+ '<td><a class="btn btn-block btn-warning sa-warning remove_row "><i class="fa fa-trash"></i></a></td>'+
        '</tr>'
    );
    }else{
    alert('Maximum Attribute Limit is 5');
    }
    });
    //remove row
    $(attribute_wrapper).on("click", ".remove_row", function (e) {
    e.preventDefault();
    $(this).parents("tr").remove();
    y--;
    });

@endsection
