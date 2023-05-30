@extends('layout')
@section('content')
    <div class="companies-main-div">
        <div class="d-flex align-items-center justify-content-between mx-sm-5 my-3 mx-3">
            <h3>Companies</h3>
            <a href="{{ route('company-create-page') }}">
                <button class="btn add-new-company-button">New</button>
            </a>
        </div>
        <div class="companies-table-div d-flex items-align-center justify-content-center">
            <table class="companies-table col-11">
                <tr class="companies-header-tr">
                    <th class="companies-header-th">Cégnév</th>
                    <th class="companies-header-th">Adószám</th>
                    <th class="companies-header-th">Action</th>
                </tr>
                @foreach ($companies as $company)
                    <tr class="companies-header-tr">
                        <td class="companies-header-td word-break">
                            {{ $company->name }}
                        </td>
                        <td class="companies-header-td word-break">
                            {{ $company->tax_number }}
                        </td>
                        <td class="companies-header-td d-flex justify-content-center">
                            <a href="{{ route('company-details', $company->id) }}">
                                <button class="btn btn-secondary">
                                    Details
                                    <i class='far fa-paper-plane'></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
