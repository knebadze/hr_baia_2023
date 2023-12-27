
@extends('layouts.adminLoginApp')
@section('content')
<div class="card-body">
    {{-- <p class="login-box-msg">Sign in to start your session</p> --}}

    <form method="POST" action="{{ route('admin.verify.code') }}">
      @csrf
        <div class="input-group mb-3">
            <input type="text" name="number" hidden value="{{ $number }}">
            <input id="verification_code" type="number" class="form-control @error('verification_code') is-invalid @enderror" name="verification_code" required  autofocus placeholder="ვერიფიკაციის კოდი">



            @error('verification_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-block">შესვლა</button>
    </form>
</div>
@endsection
