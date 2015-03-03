# Configuration

Below is an example of the configuration necessary to use the FeatureCheckerBundle in your application:

``` yaml
# app/config/config.yml

feature_checker:
    features:
        # List here your features
        feature1: true
        feature2: false
        # You can also nest features
        feature3:
            feature31: true
```

Next step: [Using annotations on actions](annotations.md)