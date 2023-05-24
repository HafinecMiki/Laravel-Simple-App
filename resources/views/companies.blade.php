<!doctype html>
<?php
$companies = App\Http\Controllers\CompanyController::index();
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
    <div class="companies-main-div">
        <div class="d-flex align-items-center justify-content-between mx-sm-5 my-sm-3">
            <h3>Companies</h3>

            <a href="{{ url('/add-or-edit-company') }}">
                <button class="btn add-new-company-button">New</button>
            </a>
        </div>
        <div class="companies-table-div d-flex items-align-center justify-content-center">
            <table class="companies-table col-sm-11">
                <tr class="companies-header-tr">
                    <th class="companies-header-th">Cégnév</th>
                    <th class="companies-header-th">Adószám</th>
                </tr>
                @foreach ($companies as $company)
                <tr class="companies-header-tr">
                    <td class="companies-header-td">
                        <a href="{{ url('/company-details/' . $company->id) }}">
                            {{$company->name}}
                        </a>
                    </td>
                    <td class="companies-header-td">{{$company->tax_number}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    @stop
</body>

</html>