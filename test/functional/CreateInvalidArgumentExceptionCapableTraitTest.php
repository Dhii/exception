<?php

namespace Dhii\Exception\UnitTest;

use Xpmock\TestCase;
use Exception as RootException;
use Dhii\Exception\InvalidArgumentException as TestSubject;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class CreateInvalidArgumentExceptionCapableTraitTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Exception\CreateInvalidArgumentExceptionCapableTrait';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return MockObject
     */
    public function createInstance()
    {
        $mock = $this->getMockBuilder(static::TEST_SUBJECT_CLASSNAME)
            ->getMockForTrait();

        return $mock;
    }

    /**
     * Creates a new exception.
     *
     * @since [*next-version*]
     *
     * @param string             $message  The message.
     * @param int                $code     The code.
     * @param RootException|null $previous The inner exception, if any.
     *
     * @return RootException The new exception.
     */
    public function createException($message = '', $code = 0, $previous = null)
    {
        return new RootException($message, $code, $previous);
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInternalType('object', $subject, 'A valid instance of the test subject could not be created.');
    }

    /**
     * Tests that the `_createInvalidArgumentException()` method works as expected.
     *
     * @since [*next-version*]
     */
    public function testCreateInvalidArgumentException()
    {
        $subject = $this->createInstance();
        $_subject = $this->reflect($subject);
        $message = uniqid('message-');
        $code = rand(1, 99);
        $previous = $this->createException(uniqid('previous-message'));

        $result = $_subject->_createInvalidArgumentException($message, $code, $previous);
        $this->assertInstanceOf('InvalidArgumentException', $result, 'The created exception is not an invalid argument exception');
        $this->assertEquals($message, $result->getMessage(), 'The created exception did not return the right message');
        $this->assertEquals($code, $result->getCode(), 'The created exception did not return the right code');
        $this->assertEquals($previous, $result->getPrevious(), 'The created exception did not return the right inner exception');
    }
}
