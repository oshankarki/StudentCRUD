@extends('layouts.app1')
@section('title','List')

    <style>
        #students {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #students td, #students th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #students tr:nth-child(even){background-color: #f2f2f2;}

        #students tr:hover {background-color: #ddd;}

        #students th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color:#fff;
            color: #000;
        }
    </style>
@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

<h1>Student List</h1>

<table id="students" >
    <tr>
        <th>S.N </th>
        <th>Name </th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Date Of Birth</th>
        <th>Image</th>
        <th>Action</th>


    </tr>
    @foreach($data['records'] as $record)
    <tr>
        <td>{{$loop->index+1}}</td>
        <td>{{$record->name}}</td>
        <td>{{$record->email}}</td>
        <td>{{$record->phone}}</td>
        <td>{{$record->address}}</td>
        <td>{{$record->dob}}</td>


        <td><img src="{{ asset('storage/images/'.$record->image) }}" alt="Student Image" height="50px" width="50"></td>
        <td>
            <a href="{{route('student.show',$record->id)}}"class="btn btn-info"><i class="fa fa-user"></i></a>

            <a href="{{route('student.edit',$record->id)}}"class="btn btn-primary"><i class="fa fa-edit"></i></a>

            <form action="{{ route('student.destroy', $record->id) }}" method="post" style="display:inline-block">
                @method("delete")
                @csrf
                <button type="submit" class="btn btn-block btn-danger sa-warning remove_row">
                    <i class="fa fa-trash"></i>
                </button>
            </form>


        </td>
    </tr>
    @endforeach
</table>
@endsection


