@component('admin::mail_layouts/layout')
    {{-- Header --}}
    @slot('header')
    @component('admin::mail_layouts/header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    {{-- Body --}}
    <div class="container-body">
        <p>
                Hi Admin
        </p>
        <p>
            You recently request to forget your password for your BLISSS Admin account.
        </p>
        <p>
            Please click on the link below to reset your password.
        </p>
        <input type="button" name="resetbutton" value="Click Here To Reset Your Password" style="background-color: blue;height: 40px;color: white;font-size: 15px;opacity: 92%;border: 0;">
        <p >If you did not request a password reset then please ignore this mail.</p>
        <p>
            Thanks
        </p>
        <p>
            Blisss Support Team
        </p>
    </p>



    {{-- Footer --}}
    @slot('footer')
        @component('admin::mail_layouts/footer')
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
