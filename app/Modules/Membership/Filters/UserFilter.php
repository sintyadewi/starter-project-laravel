<?php

namespace App\Modules\Membership\Filters;

class UserFilter
{
    // public function keyword($builder, $value)
    // {
    //     //
    // }

    public function name($builder, $value)
    {
        return $builder->where('name', 'LIKE', "%{$value}%");
    }

    public function email($builder, $value)
    {
        return $builder->where('email', 'LIKE', "%{$value}%");
    }
}
