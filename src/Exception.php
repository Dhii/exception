<?php

namespace Dhii\Exception;

use Exception as RootException;
use Dhii\Util\String\StringableInterface as Stringable;

/**
 * The most basic exception.
 *
 * @since [*next-version*]
 */
class Exception extends AbstractBaseException
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
        $message = is_null($message)
            ? ''
            : $this->_normalizeString($message);
        $code = is_null($code)
            ? 0
            : $this->_normalizeInt($code);

        parent::__construct($message, $code, $previous);
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
