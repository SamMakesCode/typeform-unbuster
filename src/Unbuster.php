<?php

namespace SamMakesCode\TypeformUnbuster;

class Unbuster
{
    public static function createFromObject(\stdClass $response): TypeformResponse
    {
        return new TypeformResponse($response);
    }
}
