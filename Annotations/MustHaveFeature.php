<?php

namespace LWI\FeatureCheckerBundle\Annotations;

/**
 * Annotation for FeatureChecker
 *
 * Uses feature name as parameter.
 *
 * @Annotation
 */
class MustHaveFeature
{
    /**
     * @var string
     */
    protected $featureName;

    /**
     * Constructor
     *
     * @param array $options
     */
    public function __construct($options)
    {
        if (!isset($options['value'])) {
            throw new \InvalidArgumentException('Feature name cannot be blank in @FeatureChecker annotation.');
        }

        $options['featureName'] = $options['value'];
        unset($options['value']);

        foreach ($options as $key => $value) {
            if (!property_exists($this, $key)) {
                throw new \InvalidArgumentException(sprintf('Property "%s" does not exist.', $key));
            }

            $this->$key = $value;
        }
    }

    /**
     * @return string
     */
    public function getFeatureName()
    {
        return $this->featureName;
    }
}
