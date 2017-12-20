<?php

namespace Dhii\Exception;

use Dhii\I18n\StringTranslatingTrait;
use Dhii\Util\Normalization\NormalizeIntCapableTrait;
use Exception as RootException;
use Dhii\Util\String\StringableInterface as Stringable;
use InvalidArgumentException as RootInvalidArgumentException;
use OutOfRangeException as BaseOutOfRangeException;
use Dhii\Util\Normalization\NormalizeStringCapableTrait;

class OutOfRangeException extends BaseOutOfRangeException implements BadSubjectExceptionInterface
{
    /*
     * Adds argument awareness.
     *
     * @since [*next-version*]
     */
    use SubjectAwareTrait;

    /*
     * Adds ability to normalize strings.
     *
     * @since [*next-version*]
     */
    use NormalizeStringCapableTrait;

    /*
     * Adds ability to normalize integers.
     *
     * @since [*next-version*]
     */
    use NormalizeIntCapableTrait;

    /*
     * Adds ability to translate strings.
     *
     * @since [*next-version*]
     */
    use StringTranslatingTrait;

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
