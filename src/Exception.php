<?php

namespace Dhii\Exception;

use Exception as RootException;
use Dhii\Util\String\StringableInterface as Stringable;

/**
 * The most basic exception.
 *
 * @since [*next-version*]
 */
class Exception extends RootException implements ThrowableInterface
{
    /**
     * @since [*next-version*]
     *
     * @param string|Stringable|null $message  The message, if any.
     * @param int|null               $code     The error code, if any.
     * @param RootException|null     $previous The inner exception, if any.
     */
    public function __construct($message = null, $code = null, RootException $previous = null)
    {
        parent::__construct((string) $message, (int) $code, $previous);
        $this->_construct();
    }

    /**
     * Parameter-less constructor.
     *
     * Invoke this in actual constructor.
     *
     * @since [*next-version*]
     */
    protected function _construct()
    {
    }
}
