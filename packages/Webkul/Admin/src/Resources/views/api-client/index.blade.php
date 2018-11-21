
@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.configuration.api-client.title') }}
@stop

@section('content')
    <div class="content">

        <div class="page-header">
            <div class="page-title">
                <h1>
                    {{ __('admin::app.configuration.api-client.title') }}
                </h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.api-client.create') }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.configuration.api-client.add-btn-title') }}
                </a>
            </div>
        </div>

        <div class="page-content">

            @if($clients)
            @foreach($clients as $client)
            <div class="form-container">
                <div class="control-group">
                    <label for="name" >
                        {{ __('admin::app.configuration.api-client.client_id') }}
                    </label>
                    <input type="text" class="control" name="name"  value="{{ $client->id }}" readonly>
                </div>

                <div class="control-group">
                    <label for="redirect">
                        {{ __('admin::app.configuration.api-client.client_secret') }}
                    </label>
                    <input type="text" class="control" name="redirect" value="{{  $client->secret }}" readonly>
                </div>

                <div class="control-group">
                    <label for="redirect">
                        {{ __('admin::app.configuration.api-client.redirect') }}
                    </label>
                    <input type="text" class="control" name="redirect" value="{{  $client->redirect }}" readonly>
                </div>

                <div class="control-group">
                    <label for="status">
                        {{ __('admin::app.configuration.api-client.grant_type') }}
                    </label>

                    <span class="checkbox">
                        <input type="checkbox" id="status" name="status"  value="{{ $client->secret }}" {{  $client->secret ? 'checked' : '' }} disabled="disabled">
                        <label class="checkbox-view" for="status"></label>
                        {{ __('admin::app.configuration.api-client.auth_code') }}
                    </span>

                    <span class="checkbox">
                        <input type="checkbox" id="status" name="status"  value="{{ $client->password_client }}" {{   ($client->password_client == 1) ? 'checked' : '' }} disabled="disabled">
                        <label class="checkbox-view" for="status"></label>
                        {{ __('admin::app.configuration.api-client.password') }}
                    </span>

                    {{--  <span class="checkbox">
                        <input type="checkbox" id="status" name="status" value="1" disabled="disabled">
                        <label class="checkbox-view" for="status"></label>
                        {{ __('admin::app.configuration.api-client.refresh_token') }}
                    </span>  --}}

                </div>

                <a href="{{ route('admin.api-client.edit', $client->id) }}" class="btn btn-lg btn-primary">
                    {{ __('admin::app.configuration.api-client.edit-title') }}
                </a>


            </div>
            @endforeach
            @endif

        </div>

    </div>
@stop