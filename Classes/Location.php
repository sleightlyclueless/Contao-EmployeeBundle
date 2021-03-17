<?php

/**
 * @package   EmployeeBundle
 * @author    (c) IXTENSA GmbH & Co. KG Internet und Webagentur -- Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2020
 */

namespace ixtensa\EmployeeBundle\Classes;

use ixtensa\EmployeeBundle\Helper\HelperClass;

class Location extends \ContentElement
{
    protected $strTemplate = 'ce_location';

    public function generate()
	{
        if (TL_MODE == 'BE')
		{
            $this->strTemplate = 'be_wildcard';
            $this->Template = new \BackendTemplate($this->strTemplate);
            $locationId = HelperClass::getIdsByDelimiter($this->locationPicker, '[', ']');
            $res = HelperClass::getLocationDataById($locationId);
            $publishedStatus = '';
            if ($res[0]['published'] != 1) {
                $publishedStatus =  $GLOBALS['IX_EB']['MSC']['disabled'];
            }
            $this->Template->title = $res[0]['name'] . $publishedStatus;
            if ($res[0]['type']) {
                $this->Template->wildcard   = '### ' . $res[0]['type'] . ' ###';
            }
            else {
                $this->Template->wildcard   = '### Standortelement ###';
            }
            return $this->Template->parse();
        }
        return parent::generate();
    }


    protected function compile()
    {
        $locationId = HelperClass::getIdsByDelimiter($this->locationPicker, '[', ']');
        $res = HelperClass::getLocationDataById($locationId);
        $arrData = HelperClass::prepareArrayDataForLocationTemplate($res, $this->Template);

        $this->Template->arrLocationData = $arrData;
    }
}
