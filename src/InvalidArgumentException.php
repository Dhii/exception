<?php

namespace Dhii\Exception;

use InvalidArgumentException as RootInvalidArgumentException;
use Exception as RootException;
use Dhii\Util\String\StringableInterface as Stringable;

/**
 * Represents a problem with a function argument.
 *
 * @since [*next-version*]
 */
class InvalidArgumentException extends RootInvalidArgumentException implements InvalidArgumentExceptionInterface
{
    /*
     * Adds argument awareness.
     *
     * @since [*next-version*]
     */
    use SubjectAwareTrait;

    /**
     * @since [*next-version*]
     *
     * @param string|Stringable|null $message  The message, if any.
     * @param int|null               $code     The error code, if any.
     * @param RootException|null     $previous The inner exception, if any.
     * @param mixed|null             $argument The argument value, if any.
     */
    public function __construct($message = null, $code = null, RootException $previous = null, $argument = null)
    {
        parent::__construct((string) $message, (int) $code, $previous);
        $this->_setSubject($argument);

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

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    public function getSubject()
    {
        return $this->_getSubject();
    }
}
