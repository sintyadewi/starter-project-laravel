<?php

if (! function_exists('auth_user')) {
    /**
     * Get user model from auth.
     *
     * @return \App\Modules\Membership\Models\User
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    function auth_user()
    {
        $user = auth()->user();

        if (! $user instanceof \App\Modules\Membership\Models\User) {
            throw new \Illuminate\Auth\AuthenticationException();
        }

        return $user;
    }
}
