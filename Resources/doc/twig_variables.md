# Using Twig global variables

Global Twig variables are declared based on the features configuration. Those are accessible via the following syntax :

``` yaml
# app/config/config.yml

feature_checker:
    features:
        feature1: true
        feature2: false
        feature3:
            feature31: true
```

``` twig
{% if feature_checker.feature1 %}
    Feature 1 is enabled
{% endif %}

{% if not feature_checker.feature2 %}
    Feature 2 is disabled
{% endif %}

{% if feature_checker.feature3.feature31 %}
    Feature 31 is enabled
{% endif %}

{% if feature_checker.feature3 %}
    Feature 3 and all its sub-features are enabled
{% endif %}
```

Next step: [Overriding error template](overriding_template.md)