<div>
  {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
  @if(!$permittion)


  <div class="login-box">
    <div class="login-logo">
      <a href="{{asset('index2.html')}}">Forgot Password</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg"></p>

        <form wire:submit.prevent="sending">
          @csrf
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Input Your Email" wire:model="email" name="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          @if(session()->has('success'))
          <div class="alert alert-success">
            {{ session('message') }}
          </div>
          @elseif(session()->has('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
          @endif

          <div class="row">
            <div class="col-8">
              <!-- Empty col if needed -->
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Send</button>
            </div>
          </div>
        </form>


      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  @endif
  @if($permittion)

  <div class="register-box">
    <div class="register-logo">
      <a href="../../index2.html"><b>Verification</a>
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg"></p>

        <form wire:submit.prevent="verification">
          @csrf
          <div class="input-group mb-3">
              <input type="number" class="form-control" placeholder="Input verification code" wire:model="secret">
              <div class="input-group-append">
                  <div class="input-group-text">
                      <span class="fas fa-user"></span>
                  </div>
              </div>
          </div>
      
          @if (session()->has('error')) <!-- Xatolik bo'lsa chiqariladi -->
              <div class="alert alert-danger">
                  {{ session('error') }}
              </div>
          @endif
      
          <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Confirm</button>
          </div>
      </form>
      
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>

@endif
</div>