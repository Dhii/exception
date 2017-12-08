<?php

namespace Dhii\Exception\FuncTest;

use Xpmock\TestCase;
use Dhii\Exception\SubjectAwareTrait as TestSubject;

/**
 * Tests {@see TestSubject}.
 *
 * @since [*next-version*]
 */
class SubjectAwareTraitTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\Exception\SubjectAwareTrait';

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
     * Tests that the exception subject can be correctly set and retrieved.
     *
     * @since [*next-version*]
     */
    public function testSetGetSubject()
    {
        $subject = $this->createInstance();
        $_subject = $this->reflect($subject);
        $data = uniqid('argument-');

        $_subject->_setSubject($data);
        $result = $_subject->_getSubject($data);

        $this->assertEquals($data, $result, 'Exception subject retrieved is not the same as argument assigned');
    }
}
