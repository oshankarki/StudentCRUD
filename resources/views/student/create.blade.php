<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
    * {
        box-sizing: border-box;
    }

    body {
        background-color: #f1f1f1;
    }

    #regForm {
        background-color: #ffffff;
        margin: 100px auto;
        font-family: Raleway;
        padding: 40px;
        width: 70%;
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
</style>

<body>
<form action="{{route('student.store')}}" id="regForm" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="_method" value="POST">
    <h1>Student Registration Form</h1>
    <!-- One "tab" for each step in the form: -->
    <div class="tab">Basic Information:
        <p><input placeholder="Fullname" oninput="this.className = ''" name="name" type="text"></p>
        <p><input placeholder="Email" oninput="this.className = ''" name="email" type="email"></p>
        <p><input placeholder="Phone Number" oninput="this.className = ''" name="phone" type="text"></p>
        <p><input placeholder="Address" oninput="this.className = ''" name="address"></p>
        <p><input oninput="this.className = ''" name="image" type="file"></p>
        <p><input placeholder="Date of Birth" oninput="this.className = ''" name="dob" type="date"></p>
        <p>
            <label>Gender:</label>
            <br>
            <label for="male">
                <input type="radio" id="male" name="gender" value="male"> Male
            </label>
            <label for="female">
                <input type="radio" id="female" name="gender" value="female"> Female
            </label>
            <label for="other">
                <input type="radio" id="other" name="gender" value="other"> Other
            </label>
        </p>





    </div>
    <div class="tab">Education
        <table class="table table-striped table-bordered" id="attribute_wrapper">
            <tr>
                <th>Level</th>
                <th>College</th>
                <th>University</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Action</th>


            </tr>
            <tr>

                <td><input type="text" name="level[]" class="form-control" placeholder="Enter Level"/></td>
                <td><input type="text" name="college[]" class="form-control" placeholder="Enter College"/></td>
                <td><input type="text" name="university[]" class="form-control" placeholder="Enter University"/></td>
                <td><input type="date" name="start_date[]" class="form-control" /></td>
                <td><input type="date" name="end_date[]" class="form-control" /></td>


                <td>
                    <a class="btn btn-block btn-warning sa-warning remove_row "><i class="fa fa-trash"></i></a>
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
        <span class="step"></span>
        <span class="step"></span>
    </div>
</form>

<script>
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
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
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
</script>

</body>

</html>
