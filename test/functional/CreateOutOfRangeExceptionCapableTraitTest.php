<?php

namespace Dhii\Exception\FuncTest;

use Xpmock\TestCase;
use Exception as RootException;
use Dhii\Exception\CreateOutOfRangeExceptionCapableTrait as TestSubject;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class CreateOutOfRangeExceptionCapableTraitTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Exception\CreateOutOfRangeExceptionCapableTrait';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return object
     */
    public function createInstance()
    {
        $mock = $this->getMockForTrait(static::TEST_SUBJECT_CLASSNAME);

        return $mock;
    }

    /**
     * Tests whether a valid instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();
        $this->assertTrue(true, 'The subject could not be instantiated');
    }

    /**
     * Creates a new generic Dhii exception.
     *
     * @since [*next-version*]
     *
     * @param string        $message  The error message.
     * @param int           $code     The error code.
     * @param RootException $previous The inner exception, if any.
     */
    public function createException($message = '', $code = 0, $previous = null)
    {
        return new RootException($message, $code, $previous);
    }

    /**
     * Tests that the subject can successfully create an exception.
     *
     * @since [*next-version*]
     */
    public function testCanCreateInvalidArgumentException()
    {
        $subject = $this->createInstance();
        $_subject = $this->reflect($subject);
        $message = uniqid('message-');
        $code = rand(1, 100);
        $previous = $this->createException(uniqid('message-'), rand(1, 100));
        $argument = uniqid('arg-'.rand(1, 100).'-');

        $result = $_subject->_createOutOfRangeException($message, $code, $previous, $argument);

        $this->assertInstanceOf('OutOfRangeException', $result, 'Subject could not create a valid result ');
        $this->assertInstanceOf('Dhii\Exception\OutOfRangeExceptionInterface', $result, 'Subject could not create a valid result ');
        $this->assertEquals($message, $result->getMessage(), 'Subject result has wrong message');
        $this->assertEquals($code, $result->getCode(), 'Subject result has wrong code');
        $this->assertEquals($argument, $result->getSubject(), 'Subject result has wrong argument');
        $this->assertSame($previous, $result->getPrevious(), 'Subject result has wrong inner exception');
    }
}
