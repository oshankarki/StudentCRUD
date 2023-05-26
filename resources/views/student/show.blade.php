<!DOCTYPE html>
<html>
<head>
    <title>{{$data['record']->name}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        .card {
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .card img {
            display: block;
            margin: 0 auto;
            border-radius: 50%;
            height: 200px;
            width: 200px;
        }

        .card h1 {
            text-align: center;
            margin-top: 20px;
        }

        .card h5 {
            text-align: center;
            color: #888;
        }

        .card p.title {
            margin: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
        .profile_container{
            display: flex;
            justify-content: space-between;

        }
        .title{
            margin-left: 100px;
        }
    </style>
</head>
<body>

<h2 style="text-align:center">Student Profile Card</h2>

<div class="card">

    <img src="{{ asset('storage/images/'.$data['record']->image) }}" alt="Image" height="200" width="200">
    <h1>{{$data['record']->name}}</h1>
    <h5>Student</h5>
    <h2 style="text-align:center">Basic Information</h2>

    <div class="profile_container">
        <p class="title"><strong>Phone:</strong>{{$data['record']->email}}</p>
        <p class="title"><strong>Email:</strong>{{$data['record']->phone}}</p>
    <p class="title"><strong>Address:</strong>{{$data['record']->address}}</p>
    <p class="title"><strong>Date of Birth:</strong>{{$data['record']->dob}}</p>
    <p class="title" style="text-transform: capitalize"><strong>Gender:</strong>{{$data['record']->gender}}</p>
    </div>
    <h2 style="text-align:center">Academics</h2>

    <table id="students" >
        <tr>
            <th>S.N </th>
            <th>Level </th>
            <th>College</th>
            <th>University</th>
            <th>Start Date</th>
            <th>End Date</th>



        </tr>
        @foreach($data['record']->educations as $edu_record)
            <tr>
                <td>{{$loop->index+1}}</td>

                <td>{{$edu_record->level}}</td>
                <td>{{$edu_record->college}}</td>

                <td>{{$edu_record->university}}</td>
                <td>{{$edu_record->start_date}}</td>
                <td>{{$edu_record->end_date}}</td>

            </tr>
        @endforeach
    </table>




</div>

</body>
</html>
