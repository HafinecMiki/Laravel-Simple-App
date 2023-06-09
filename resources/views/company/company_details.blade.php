@extends('layout')
@section('content')
    <!-- Modal -->
    <div class="modal fade" id="CompanyDeleteModal" tabindex="-1" aria-labelledby="CompanyDeleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="CompanyDeleteModalLabel">Confirm Deletion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure you want to delete this company?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="{{ route('company-delete', $company->id) }}" method="POST" class="d-flex">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Details -->
    <div class="row mx-0 justify-content-center mt-sm-0 mt-3">
        <div class="col-sm-6 px-4 pb-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Details</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-light">
                        <tbody>
                        <tr>
                            <td>Name</td>
                            <td class="word-break">{{ $company->name }}</td>
                        </tr>
                        <tr>
                            <td>Tax number</td>
                            <td class="word-break">{{ $company->tax_number }}</td>
                        </tr>
                        <tr>
                            <td>Phone number</td>
                            <td class="word-break">{{ $company->phone_number }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td class="word-break">{{ $company->email }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="d-flex align-items-center justify-content-around">
                        <a href="{{ route('company-edit-page', $company->id) }}">
                            <button class="btn btn-primary px-4">Edit</button>
                        </a>
                        <!-- Button trigger modal -->
                        <button class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#CompanyDeleteModal">Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
