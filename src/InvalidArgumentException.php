<?php

namespace Dhii\Exception;

use InvalidArgumentException as RootInvalidArgumentException;
use Exception as RootException;

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
    use ArgumentAwareTrait;

    public function __construct($message = '', $code = 0, RootException $previous = null, $argument = null)
    {
        parent::__construct($message, $code, $previous);
        $this->_setArgument($argument);
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
    public function getArgument()
    {
        return $this->_getArgument();
    }
}
