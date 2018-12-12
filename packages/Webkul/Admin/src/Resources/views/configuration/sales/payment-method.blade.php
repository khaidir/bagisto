@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.configuration.sales.shipping-method.title') }}
@stop

@section('content')
    <div class="content">
        <?php $locale = request()->get('locale') ?: app()->getLocale(); ?>
        <?php $channel = request()->get('channel') ?: core()->getDefaultChannelCode(); ?>

        <form method="POST" action="" @submit.prevent="onSubmit" enctype="multipart/form-data">

            <div class="page-header">

                <div class="page-title">
                    <h1>
                        {{ __('admin::app.configuration.sales.payment-method.title') }}
                    </h1>

                    <div class="control-group">
                        <select class="control" id="channel-switcher" name="channel">
                            @foreach(core()->getAllChannels() as $channelModel)

                                <option value="{{ $channelModel->code }}" {{ ($channelModel->code) == $channel ? 'selected' : '' }}>
                                    {{ $channelModel->name }}
                                </option>

                            @endforeach
                        </select>
                    </div>

                    <div class="control-group">
                        <select class="control" id="locale-switcher" name="locale">
                            @foreach(core()->getAllLocales() as $localeModel)

                                <option value="{{ $localeModel->code }}" {{ ($localeModel->code) == $locale ? 'selected' : '' }}>
                                    {{ $localeModel->name }}
                                </option>

                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.configuration.sales.shipping-method.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()

                    @foreach (config('core.paymentmethods') as $method => $paymentmethod)

                        <accordian :title="'{{ __(config('paymentmethods.' . $method . '.title')) }}'" :active="true">

                            <div slot="body">
                                @foreach ($paymentmethod as $field)

                                    <?php
                                        $validations = [];
                                        $disabled = false;

                                        if (isset($field['validation'])) {
                                            array_push($validations, $field['validation']);
                                        } else {
                                            $disabled = true;
                                        }

                                        $validations = implode('|', array_filter($validations));
                                    ?>

                                    @if (view()->exists($typeView = 'admin::configuration.common.field-types.' . $field['type']))

                                        <?php
                                            $name = 'paymentmethods' . '.' . $method . '.' . $field['name'];

                                            $channel_locale = [];

                                            if(isset($field['channel_based']) && $field['channel_based'])
                                            {
                                                array_push($channel_locale, $channel);
                                            }

                                            if(isset($field['locale_based']) && $field['locale_based']) {
                                                array_push($channel_locale, $locale);
                                            }

                                            $value = core()->getConfigData($name);

                                            $errorName = $field['name'];

                                            $fieldName = 'paymentmethods';
                                        ?>

                                        <div class="control-group {{ $field['type'] }}" :class="[errors.has('{{ $name }}') ? 'has-error' : '']">
                                            <label for="{{ $name }}" {{ $disabled == false   ? 'class=required' : '' }}>

                                                {{ $field['title'] }}

                                                @if(count($channel_locale))
                                                    <span class="locale">[{{ implode(' - ', $channel_locale) }}]</span>
                                                @endif

                                            </label>

                                            @include ($typeView)

                                            <span class="control-error" v-if="errors.has('{{ $name }}')">@{{ errors.first('{!! $name !!}') }}</span>

                                        </div>

                                    @endif
                                @endforeach
                            </div>
                        </accordian>

                    @endforeach

                </div>
            </div>

        </form>
    </div>
@stop

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#channel-switcher, #locale-switcher').on('change', function (e) {
                $('#channel-switcher').val()
                var query = '?channel=' + $('#channel-switcher').val() + '&locale=' + $('#locale-switcher').val();

                window.location.href = "{{ route('admin.configuration.sales.payment_methods')  }}" + query;
            })
        });
    </script>
@endpush