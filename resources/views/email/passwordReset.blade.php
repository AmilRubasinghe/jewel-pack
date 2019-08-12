{{--
@component('mail::message')
# Jewelpack - Password Reset

Click on the button below to change password

@component('mail::button', ['url' => 'http://jewelpack.tk/response-password-reset?token='.$token])
Reset Password
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

   
# Jewelpack - Password Reset

Click on the button below to change password

@component('mail::button', ['url' => 'http://jewelpack.tk/response-password-reset?token='.$token])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}

    @slot('footer')
        @component('mail::footer')
        © Jewelpack. All rights reserved.
        @endcomponent
    @endslot
@endcomponent