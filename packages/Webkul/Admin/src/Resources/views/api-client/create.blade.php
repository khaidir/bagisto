@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.configuration.api-client.add-title') }}
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.api-client.store') }}" @submit.prevent="onSubmit">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        {{ __('admin::app.configuration.api-client.add-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.configuration.api-client.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">

                <div class="form-container">
                    @csrf()

                    <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                        <label for="name" class="required">
                            {{ __('admin::app.configuration.api-client.name') }}
                        </label>
                        <input type="text" class="control" name="name" v-validate="'required'" value="{{ old('name') }}">
                        <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('redirect') ? 'has-error' : '']">
                        <label for="redirect" class="required">
                            {{ __('admin::app.configuration.api-client.redirect') }}
                        </label>
                        <input type="text" class="control" name="redirect" v-validate="'required'" value="{{ old('redirect') }}">
                        <span class="control-error" v-if="errors.has('redirect')">@{{ errors.first('redirect') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('grant_type') ? 'has-error' : '']">
                        <label for="grant_type" class="required">
                            {{ __('admin::app.configuration.api-client.grant_type') }}
                        </label>

                        <span class="checkbox">
                            <input type="radio" id="status" name="grant_type"  v-validate="'required'" value="authorization">
                            <label class="checkbox-view" for="status"></label>
                            {{ __('admin::app.configuration.api-client.auth_code') }}
                        </span>

                        <span class="checkbox">
                            <input type="radio" id="status" name="grant_type" v-validate="'required'" value="password">
                            <label class="checkbox-view" for="status"></label>
                            {{ __('admin::app.configuration.api-client.password') }}
                        </span>

                        <span class="control-error" v-if="errors.has('grant_type')">@{{ errors.first('grant_type') }}</span>
                    </div>

                </div>
            </div>

        </form>
    </div>
@stop