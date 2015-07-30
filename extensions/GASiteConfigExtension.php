<?php

/**
 * Class GASiteConfig
 */
class GASiteConfigExtension extends DataExtension
{

    private static $db = array(
        'AnalyticType' => 'Varchar(5)',
        'GoogleCode'   => 'Varchar(15)',
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
