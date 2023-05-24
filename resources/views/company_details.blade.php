<!doctype html>
<?php
$company = App\Http\Controllers\CompanyController::showById(request('company'));
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</head>


<body>
    @extends('layout')

    @section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Register</h1>
                </div>
                <div class="card-body">
                    <h1>Details</h1>
                    <table class="table table-striped table-light">
                        <tbody>
                            <tr>
                                <td>Id</td>
                                <td>{{$company->id}}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{$company->name}}</td>
                            </tr>
                            <tr>
                                <td>Tax number</td>
                                <td>{{$company->tax_number}}</td>
                            </tr>
                            <tr>
                                <td>Phone number</td>
                                <td>{{$company->phone_number}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{$company->email}}</td>
                            </tr>
                            <tr>
                                <td>Action</td>
                                <td>
                                    <a href="{{ url('/add-or-edit-company/' . $company->id) }}">
                                        <button class="btn">Edit</button>
                                    </a>
                                    <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @stop
</body>

</html>