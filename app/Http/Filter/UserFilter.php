<?php

namespace App\Http\Filter;

use Timedoor\Filter\Filter;

class UserFilter extends Filter
{
    public function keyword($value) // write your method name based on param name
    {
        // do query stuff here, 
        // ex: return $this->query->where("name", "LIKE", "%$value%");
    }

    public function name($value)
    {
        return $this->query->where("name", "LIKE", "%$value%");
    }
}
