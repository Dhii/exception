<?php

namespace Dhii\Exception\FuncTest;

use Xpmock\TestCase;
use Exception as RootException;
use Dhii\Exception\RuntimeException as TestSubject;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class RuntimeExceptionTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Exception\RuntimeException';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return TestSubject|MockObject The test subject mock.
     */
    public function createInstance($message = null, $code = null, $previous = null)
    {
        $mock = $this->getMockBuilder(static::TEST_SUBJECT_CLASSNAME)
            ->setConstructorArgs([$message, $code, $previous])
            // https://github.com/sebastianbergmann/phpunit/issues/1652
            ->setMethods(null)
            ->getMock();

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
        $subject = $this->createInstance($message, $code, $previous);

        try {
            throw $subject;
        } catch (RootException $e) {
            $this->assertEquals($message, $e->getMessage(), 'Subject message is wrong');
            $this->assertEquals($code, $e->getCode(), 'Subject code is wrong');
            $this->assertEquals($previous, $e->getPrevious(), 'Subject inner exception is wrong');
        }
    }
}
