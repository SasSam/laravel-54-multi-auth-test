<?php

namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;

class EloquentEmployeeUserProvider extends EloquentUserProvider
{
    public function retrieveByCredentials(array $credentials)
    {
        // https://jamesmcfadden.co.uk/custom-authentication-in-laravel-with-guards-and-user-service-providers
        // Of course here, you could perform the query yourself with the is_admin comparison, but
        // I think it's best to avoid as much duplication as possible
        $user = parent::retrieveByCredentials($credentials);

        return $user && $user->avail === 0 ? null : $user;
    }
}
