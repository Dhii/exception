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
    /**
     * The argument associated with this instance.
     *
     * @since [*next-version*]
     *
     * @var mixed
     */
    protected $argument;

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

    /**
     * Retrieves the argument.
     *
     * @since [*next-version*]
     *
     * @return mixed The argument
     */
    protected function _getArgument()
    {
        return $this->argument;
    }

    /**
     * Assigns the argument.
     *
     * @since [*next-version*]
     *
     * @return $this
     */
    protected function _setArgument($argument)
    {
        $this->argument = $argument;

        return $this;
    }
}
