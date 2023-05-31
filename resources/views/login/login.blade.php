@extends('layout')
@section('content')
    <div class="row mx-0 justify-content-center mt-5">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Login</h1>
                </div>
                <div class="card-body">
                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <form id="loginForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email"
                                   placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button class="btn btn-primary" type="button" onclick="submitForm('login')">Login
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button class="btn btn-primary" type="button"
                                        onclick="submitForm('login2FA')">Login2FA
                                </button>
                            </div>
                        </div>
                    </form>
                    <a href="{{ route('sso-google') }}">
                        <div class="mb-3">
                            <div class="d-grid">
                                <button class="btn btn-primary">Google <img
                                        src="{{ URL::to('/') }}/images/google-icon.svg"
                                        class="google-icon"/></button>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

<script type="text/javascript">
    function submitForm(action) {
        var form = document.getElementById('loginForm');
        if (action == 'login') {
            form.action = "{{ route('login-request') }}";
        } else {
            form.action = "{{ route('login2FA') }}";
        }
        form.submit();
    }
</script>
