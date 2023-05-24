<!doctype html>
<?php
$company = request('company') ? App\Http\Controllers\CompanyController::showById(request('company')) : null;
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
                    <h1 class="card-title">{{$company ? 'Edit' : 'Add new'}} company</h1>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                    @endif

                    @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                    </div>
                    @endif

                    <form action="{{ $company ? route('company-edit', $company->id) : route('company-create') }}" method="POST">
                        @csrf
                        {{  $company ? method_field('PUT') : method_field('POST')  }}
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="John Doe" value="{{ $company ? $company->name : ''}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Tax number</label>
                            <input type="text" name="tax_number" class="form-control" id="name" placeholder="CV12121" value="{{ $company ? $company->tax_number : ''}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Phone number</label>
                            <input type="text" name="phone_number" class="form-control" id="name" placeholder="06206666666" value="{{ $company ? $company->phone_number : ''}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" value="{{ $company ? $company->email : ''}}" required>
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button class="btn btn-primary">{{$company ? 'Edit' : 'Add new'}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @stop
</body>

</html>