<?php

/**
 * Class GASiteControllerExtension
 * @package: google-analytics
 */
class GASiteControllerExtension extends Extension
{

    /**
     * Load either UA or GTM script depending on what the user has decided and inject the code into the javascript
     */
    public function onBeforeInit()
    {
        $analyticType = SiteConfig::current_site_config()->AnalyticType;

        $vars = array(
            "GaCode" => SiteConfig::current_site_config()->GoogleCode
        );

        if ($analyticType === "UA") {
            Requirements::javascriptTemplate("google-analytics/js/UniversalAnalytics.js", $vars);

        } else if ($analyticType === "GTM") {
            Requirements::javascriptTemplate("google-analytics/js/TagManager.js", $vars);
        }
    }

}
