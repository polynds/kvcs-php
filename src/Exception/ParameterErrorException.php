<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Exception;

class ParameterErrorException extends \Exception
{
    public function __construct(string $parameterName = null)
    {
        parent::__construct($parameterName ?? 'Parameter error.');
    }
}
