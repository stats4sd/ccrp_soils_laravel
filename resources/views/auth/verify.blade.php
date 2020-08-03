@extends('layouts.full_width')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ t('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ t('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ t('Before proceeding, please check your email for a verification link.') }}
                    {{ t('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ t('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
