<?php

namespace Dhii\Exception\FuncTest;

use Xpmock\TestCase;
use Dhii\Exception\ArgumentAwareTrait as TestSubject;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class ArgumentAwareTraitTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Exception\ArgumentAwareTrait';

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

        $this->assertInternalType('object', $subject, 'A subject instance could not be created');
    }

    /**
     * Tests that the exception params can be correctly set in the constructor,
     * and can be correctly retrieved.
     *
     * @since [*next-version*]
     */
    public function testSetGetArgument()
    {
        $subject = $this->createInstance();
        $_subject = $this->reflect($subject);
        $data = uniqid('argument-');

        $_subject->_setArgument($data);
        $result = $_subject->_getArgument($data);

        $this->assertEquals($data, $result, 'Argument retrieved is not the same as argument assigned');
    }
}
