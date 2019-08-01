@extends('layouts.app')

@section('content')
    <div class="verification-email-error">
        <h3 class="title">Error verification email</h3>
        <hr>
        <p class="content">
            Hi
            <span style="font-weight: bold; font-size: 16px">{{ $username }}. </span>
            <span>You have resent the request more than</span>
            <strong class="number-request">
                    {{ $numberFail }}
            </strong>
            <span>times.</span>
            Your user has been disabled.
            Please register a new user.
            <a href="{{ url('/register') }}">
                Register
            </a>
        </p>
        <p>Thank you!</p>

    </div>
@endsection