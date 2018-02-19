<?php

namespace Dhii\Exception\FuncTest;

use Xpmock\TestCase;
use Exception as RootException;
use Dhii\Exception\AbstractBaseException as TestSubject;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class AbstractBaseExceptionTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Exception\AbstractBaseException';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return TestSubject
     */
    public function createInstance($message = null, $code = null, $previous = null)
    {
        $mock = $this->getMockBuilder(static::TEST_SUBJECT_CLASSNAME)
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();

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
        $subject = $this->createInstance();
        $_subject = $this->reflect($subject);

        $_subject->_initParent($message, $code, $previous);

        try {
            throw $subject;
        } catch (RootException $e) {
            $this->assertEquals($message, $e->getMessage(), 'Subject message is wrong');
            $this->assertEquals($code, $e->getCode(), 'Subject code is wrong');
            $this->assertEquals($previous, $e->getPrevious(), 'Subject inner exception is wrong');
        }
    }
}
