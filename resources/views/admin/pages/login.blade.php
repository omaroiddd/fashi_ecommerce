@include('admin.layouts.header')

@section('title', 'Login')
<div class="login-box mx-auto py-3">

    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ route('site.home') }}" class="h1">Clinic</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form action="{{ route('admin.auth.login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <div class="input-group">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>

                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>

                </div>
            </form>
        </div>

    </div>

</div>
@include('admin.layouts.scripts')
