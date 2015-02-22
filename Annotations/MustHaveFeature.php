<?php

namespace ChessyWeb\FeatureCheckerBundle\Annotations;

/**
 * @Annotation
 */
class MustHaveFeature
{
    /**
     * @var string
     */
    protected $featureName;

    /**
     * @param $options
     */
    public function __construct($options)
    {
        if (isset($options['value'])) {
            $options['featureName'] = $options['value'];
            unset($options['value']);
        }

        foreach ($options as $key => $value) {
            if (!property_exists($this, $key)) {
                throw new \InvalidArgumentException(sprintf('Property "%s" does not exist', $key));
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
