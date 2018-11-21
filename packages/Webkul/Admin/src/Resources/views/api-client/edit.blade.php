@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.configuration.api-client.edit-title') }}
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.api-client.update', $client->id) }}" @submit.prevent="onSubmit">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        {{ __('admin::app.configuration.api-client.edit-title') }}
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

                    <input name="_method" type="hidden" value="PUT">

                    <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                        <label for="name" class="required">
                            {{ __('admin::app.configuration.api-client.name') }}
                        </label>
                        <input type="text" class="control" name="name" v-validate="'required'" value="{{$client->name}}">
                        <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('redirect') ? 'has-error' : '']">
                        <label for="redirect" class="required">
                            {{ __('admin::app.configuration.api-client.redirect') }}
                        </label>
                        <input type="text" class="control" name="redirect" v-validate="'required'" value="{{$client->redirect}}">
                        <span class="control-error" v-if="errors.has('redirect')">@{{ errors.first('redirect') }}</span>
                    </div>

                    <div class="control-group">
                        <label for="status">
                            {{ __('admin::app.configuration.api-client.grant_type') }}
                        </label>

                        <span class="checkbox">
                            <input type="checkbox" id="status" name="status"  value="{{ $client->secret }}" {{  $client->secret ? 'checked' : '' }}>
                            <label class="checkbox-view" for="status"></label>
                            {{ __('admin::app.configuration.api-client.auth_code') }}
                        </span>

                        <span class="checkbox">
                            <input type="checkbox" id="status" name="status"  value="{{ $client->password_client }}" {{   ($client->password_client == 1) ? 'checked' : '' }} >
                            <label class="checkbox-view" for="status"></label>
                            {{ __('admin::app.configuration.api-client.password') }}
                        </span>
                    </div>

                </div>
            </div>

        </form>
    </div>
@stop