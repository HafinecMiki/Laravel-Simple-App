<!doctype html>
<?php
$company = App\Http\Controllers\CompanyController::showById(request('company'));
?>
<html lang="en">

<body>
    @extends('layout')

    @section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Details</h1>
                </div>
                <div class="card-body">
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
                        </tbody>
                    </table>
                    <div class="d-flex align-items-center justify-content-around">
                        <a href="{{ url('/add-or-edit-company/' . $company->id) }}">
                            <button class="btn btn-primary px-4">Edit</button>
                        </a>
                        <form action="{{ url('/api/company/' . $company->id) }}" method="POST" class="d-flex">
                            {{method_field('DELETE')}}
                            {{csrf_field()}}
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop
</body>

</html>