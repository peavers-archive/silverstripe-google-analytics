<?php

/**
 * Class GASiteConfig
 */
class GASiteConfig extends DataExtension
{

    private static $db = array(
        'AnalyticType' => 'Varchar(255)',
        'GoogleCode'   => 'Varchar(255)',
    );

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab('Root.GoogleAnalytics', array(
            GACodeField::create('GoogleCode', 'Google code')->setDescription('Can be either a Universal (<strong>UA-XXXXXXXX-X</strong>) or Tag manager(<strong>GTM-XXXXXX</strong>) code'),
        ));

        // Remove the CWP default field as it causes confusion
        $fields->removeByName('GACode');
    }

    /**
     *  Update the AnalyticType field with a key depending on what type of code is used.
     */
    public function onBeforeWrite()
    {
        $parts = explode("-", $this->owner->getField('GoogleCode'));

        if ($parts[0] === "GTM") {
            $this->owner->setField('AnalyticType', 'GTM');

        } else if ($parts[0] === "UA") {
            $this->owner->setField('AnalyticType', 'UA');
        }

        parent::onBeforeWrite();
    }

}

/**
 * Class GAInjector
 */
class GAInjector extends Extension
{

    /**
     * Load either UA or GTM script depending on what the user has decided
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
