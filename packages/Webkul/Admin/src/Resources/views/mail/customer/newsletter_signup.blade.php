@component('admin::mail_layouts/layout')
    {{-- Header --}}
    @slot('header')
    @component('admin::mail_layouts/header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    <div class="container-body">
        <p>Dear User,</p>
        <p>Thank you for signing up. You will be the first to know about new releases & projects. Stay tuned.</p>
        <p>Thanks</p>
        <p>
            Blisss Support Team
        </p>
    </div>

    {{-- Footer --}}
    @slot('footer')
        @component('admin::mail_layouts/footer')
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
