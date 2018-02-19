<?php

namespace Dhii\Exception;

use Exception as RootException;
use InvalidArgumentException;
use Dhii\Util\String\StringableInterface as Stringable;

/**
 * Functionality for initializing exceptions.
 *
 * @since [*next-version*]
 */
trait InitBaseExceptionCapableTrait
{
    /**
     * @since [*next-version*]
     *
     * @param string|Stringable|int|float|bool|null $message  The message, if any.
     * @param int|float|string|Stringable|null               $code     The error code, if any.
     * @param RootException|null     $previous The inner exception, if any.
     *
     * @throws InvalidArgumentException If the message or the code is invalid.
     */
    public function _initBaseException($message = null, $code = null, RootException $previous = null)
    {
        $message = is_null($message)
            ? ''
            : $this->_normalizeString($message);
        $code = is_null($code)
            ? 0
            : $this->_normalizeInt($code);

        $this->_initParent($message, $code, $previous);
    }

    /**
     * Calls the parent constructor.
     *
     * @param string $message The error message.
     * @param int $code The error code.
     * @param RootException $previous The inner exception, if any.
     *
     * @since [*next-version*]
     */
    abstract protected function _initParent($message = '', $code = 0, RootException $previous = null);

    /**
     * Normalizes a value to its string representation.
     *
     * The values that can be normalized are any scalar values, as well as
     * {@see StringableInterface).
     *
     * @since [*next-version*]
     *
     * @param Stringable|string|int|float|bool $subject The value to normalize to string.
     *
     * @throws InvalidArgumentException If the value cannot be normalized.
     *
     * @return string The string that resulted from normalization.
     */
    abstract protected function _normalizeString($subject);

    /**
     * Normalizes a value into an integer.
     *
     * The value must be a whole number, or a string representing such a number,
     * or an object representing such a string.
     *
     * @since [*next-version*]
     *
     * @param string|Stringable|float|int $value The value to normalize.
     *
     * @throws InvalidArgumentException If value cannot be normalized.
     *
     * @return int The normalized value.
     */
    abstract protected function _normalizeInt($value);
}
