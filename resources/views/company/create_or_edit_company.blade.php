@extends('layout')
@section('content')
    <div class="row mx-0 justify-content-center mt-sm-0 mt-3">
        <div class="col-sm-6 px-4 pb-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ request('company') ? 'Edit' : 'Add new' }} company</h1>
                </div>
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="list-unstyled m-0">
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form
                        action="{{ request('company') ? route('company-edit', $company->id) : route('company-create') }}"
                        method="POST">
                        @csrf
                        {{ request('company') ? method_field('PUT') : method_field('POST') }}
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="John Doe"
                                   value="{{ request('company') ? $company->name : '' }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Tax number</label>
                            <input type="text" name="tax_number" class="form-control" id="name"
                                   placeholder="CV12121" value="{{ request('company') ? $company->tax_number : '' }}"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Phone number</label>
                            <input type="text" name="phone_number" class="form-control" id="name"
                                   placeholder="06206666666"
                                   value="{{ request('company') ? $company->phone_number : '' }}"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email"
                                   placeholder="name@example.com"
                                   value="{{ request('company') ? $company->email : '' }}"
                                   required>
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button class="btn btn-primary">{{ request('company') ? 'Edit' : 'Add new' }}</button>
                            </div>
                        </div>
                    </form>
                    <div class="mb-3">
                        <a class="d-grid"
                           href="{{ request('company') ? route('company-details', request('company'))  : route('companies') }} ">
                            <button class="btn btn-secondary">Back</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
