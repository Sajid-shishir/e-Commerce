@component('mail::message')
    # Done
    Your password has been changed successfully!!

    If you haven't changed your password then click the link below to reset your password

    @component('mail::button', ['url' => 'http://localhost:8000/password/reset'])
        Forget password link
    @endcomponent

    Thanks,<br>
    Sajid
@endcomponent
