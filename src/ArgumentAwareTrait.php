<?php

namespace Dhii\Exception;

/**
 * Functionality for argument awareness.
 *
 * @since [*next-version*]
 */
trait ArgumentAwareTrait
{
    /**
     * The argument associated with this instance.
     *
     * @since [*next-version*]
     *
     * @var mixed
     */
    protected $argument;

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
