{{--
@component('mail::message')
# Jewelpack - Email verification

Click on the button below to verify email


@component('mail::button', ['url' => 'http://localhost:8000/verify/'.$user->email."/".$user->verifyToken])
Verify Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
--}}


@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Jewelpack
        @endcomponent
    @endslot

# Jewelpack - Email verification

Click on the button below to verify email


@component('mail::button', ['url' => 'http://localhost:8000/verify/'.$user->email."/".$user->verifyToken])
Verify Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}

    @slot('footer')
        @component('mail::footer')
        © Jewelpack. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
