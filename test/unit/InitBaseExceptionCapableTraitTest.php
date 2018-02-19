<?php

namespace Dhii\Exception\UnitTest;

use Xpmock\TestCase;
use Exception as RootException;
use Dhii\Exception\InvalidArgumentException as TestSubject;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class InitBaseExceptionCapableTraitTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Exception\InitBaseExceptionCapableTrait';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @param string[] $methods         The names of methods to make mockable.
     * @param mixed[]  $constructorArgs The arguments for the subject's constructor.
     *
     * @return TestSubject
     */
    public function createInstance($methods = [], $constructorArgs = [])
    {
        $methods = $this->mergeValues($methods, []);
        $mock = $this->getMockBuilder(static::TEST_SUBJECT_CLASSNAME)
            ->setMethods($methods)
            ->setConstructorArgs($constructorArgs)
            ->disableOriginalConstructor()
            ->getMockForTrait();

        return $mock;
    }

    /**
     * Merges the values of two arrays.
     *
     * The resulting product will be a numeric array where the values of both inputs are present, without duplicates.
     *
     * @param array $destination The base array.
     * @param array $source      The array with more keys.
     *
     * @return array The array which contains unique values
     */
    public function mergeValues($destination, $source)
    {
        return array_keys(array_merge(array_flip($destination), array_flip($source)));
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
     * Tests that `_initBaseException()` works as expected.
     *
     * @since [*next-version*]
     */
    public function testInitBaseException()
    {
        $subject = $this->createInstance([
            '_normalizeString',
            '_normalizeInt',
            '_initParent',
        ]);
        $_subject = $this->reflect($subject);
        $message = uniqid('message-');
        $code = rand(1, 99);
        $previous = $this->createException(uniqid('previous-message'));

        $subject->expects($this->exactly(1))
            ->method('_normalizeString')
            ->with($message)
            ->will($this->returnArgument(0));
        $subject->expects($this->exactly(1))
            ->method('_normalizeInt')
            ->with($code)
            ->will($this->returnArgument(0));
        $subject->expects($this->exactly(1))
            ->method('_initParent')
            ->with($message, $code, $previous);

        $subject->_initBaseException($message, $code, $previous);
    }
}
