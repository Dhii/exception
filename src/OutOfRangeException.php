<?php

namespace Dhii\Exception;

use Exception as RootException;
use Dhii\Util\String\StringableInterface as Stringable;
use OutOfRangeException as BaseOutOfRangeException;

/**
 * A standards-compliant Out of Range exception implementation.
 *
 * @since [*next-version*]
 */
class OutOfRangeException extends BaseOutOfRangeException implements OutOfRangeExceptionInterface
{
    /*
     * Adds argument awareness.
     *
     * @since [*next-version*]
     */
    use SubjectAwareTrait;

    /*
     * Functionality common to exceptions
     *
     * @since [*next-version*]
     */
    use ExceptionTrait;

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
        $message = is_null($message)
            ? ''
            : $this->_normalizeString($message);
        $code = is_null($code)
            ? 0
            : $this->_normalizeInt($code);

        parent::__construct($message, $code, $previous);
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
