<?php

namespace Webkul\Api\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class OauthClients extends Model
{
    protected $table = 'oauth_clients';

    protected $fillable = ['user_id', 'name', 'secret', 'redirect', 'personal_access_client', 'password_client', 'revoked'];
}
