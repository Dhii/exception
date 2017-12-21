<?php

namespace Dhii\Exception;

use Exception as RootException;
use InvalidArgumentException as RootInvalidArgumentException;

trait CreateInvalidArgumentExceptionCapableTrait
{
    /**
     * Creates a new invalid argument exception.
     *
     * @since [*next-version*]
     *
     * @param string|Stringable|null $message  The error message, if any.
     * @param int|null               $code     The error code, if any.
     * @param RootException|null     $previous The inner exception for chaining, if any.
     * @param mixed|null             $argument The invalid argument, if any.
     *
     * @return InvalidArgumentException The new exception.
     */
    protected function _createInvalidArgumentException(
        $message = null,
        $code = null,
        RootException $previous = null,
        $argument = null
    ) {
        return new RootInvalidArgumentException($message, $code, $previous);
    }
}
