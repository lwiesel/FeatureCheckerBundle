<?php

namespace spec\LWI\FeatureCheckerBundle\Annotations\Driver;

use Doctrine\Common\Annotations\Reader;
use PhpSpec\ObjectBehavior;

class FeatureCheckerDriverSpec extends ObjectBehavior
{
    protected $properFeatures = array(
        'test' => true,
        'test-2' => false,
        'test-3' => array(
            'test-31' => true
        )
    );

    function it_is_initializable(Reader $reader)
    {
        $this->beConstructedWith($reader, $this->properFeatures);
        $this->shouldHaveType('LWI\FeatureCheckerBundle\Annotations\Driver\FeatureCheckerDriver');
    }
}
