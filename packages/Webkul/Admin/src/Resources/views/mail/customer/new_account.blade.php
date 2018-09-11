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
            Dear User,
        </p>
        <p>Thank You! for register with us.</p>
    </div>

    {{-- Footer --}}
    @slot('footer')
        @component('admin::mail_layouts/footer')
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
