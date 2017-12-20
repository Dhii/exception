<?php

namespace Dhii\Exception\FuncTest;

use Xpmock\TestCase;
use Exception as RootException;
use Dhii\Exception\InvalidArgumentException as TestSubject;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class OutOfRangeExceptionTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Exception\OutOfRangeException';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return TestSubject
     */
    public function createInstance($message = null, $code = null, $previous = null, $argument = null)
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
                ->new($message, $code, $previous, $argument);

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

        $this->assertInstanceOf(static::TEST_SUBJECT_CLASSNAME, $subject, 'Subject is not a valid instance.');
        $this->assertInstanceOf('OutOfRangeException', $subject, 'Subject is not a valid out of range exception.');
        $this->assertInstanceOf('Dhii\Exception\BadSubjectExceptionInterface', $subject, 'Subject does not implement required interface.');
    }

    /**
     * Tests that the exception params can be correctly set in the constructor,
     * and can be correctly retrieved.
     *
     * @since [*next-version*]
     */
    public function testConstructorAndGetters()
    {
        $message = uniqid('message-');
        $code = rand(1, 100);
        $previous = $this->createException(uniqid('inner-message-'), rand(1, 100));
        $argument = uniqid('argument-');
        $subject = $this->createInstance($message, $code, $previous, $argument);

        $this->assertInstanceOf('Exception', $subject, 'Subject is not a valid exception');
        try {
            throw $subject;
        } catch (RootException $e) {
            $this->assertEquals($message, $e->getMessage(), 'Subject message is wrong');
            $this->assertEquals($code, $e->getCode(), 'Subject code is wrong');
            $this->assertEquals($previous, $e->getPrevious(), 'Subject inner exception is wrong');
            $this->assertInternalType('string', $e->getFile(), 'Subject file is wrong');
            $this->assertInternalType('int', $e->getLine(), 'Subject string trace is wrong');
            $this->assertInternalType('string', $e->getTraceAsString(), 'Subject string trace is wrong');
            $this->assertInternalType('array', $e->getTrace(), 'Subject trace is wrong');
            $this->assertEquals($argument, $e->getSubject(), 'Subject argument is wrong');
        }
    }
}
