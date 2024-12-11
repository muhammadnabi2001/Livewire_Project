<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="login-box">
        <div class="login-logo">
            <a href="{{asset('index2.html')}}">Login</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form wire:submit.prevent="login">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" wire:model="email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" wire:model="password"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <!-- Validatsiya xatolari -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Session xabarlari (success va error) -->
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif



                    <div class="row">
                        <div class="col-8">
                            <!-- Qo'shimcha imkoniyatlar, masalan, parolni unutganlar uchun havola -->
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>



                <!-- /.social-auth-links -->


                <p class="mb-1">
                    <a href="/forgotpassword" wire:navigate>Forgot password</a>
                </p>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>