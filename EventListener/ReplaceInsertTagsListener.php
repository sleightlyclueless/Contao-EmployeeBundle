<?php

/**
 * @package   EmployeeBundle
 * @author    (c) IXTENSA GmbH & Co. KG Internet und Webagentur -- Steffen Hamann
 * @license   GNU LGPL 3+
 * @copyright (c) 2020
 */

namespace ixtensa\EmployeeBundle\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

use ixtensa\EmployeeBundle\Helper\HelperClass;


class ReplaceInsertTagsListener
{
    protected $defaulttmpl = 'ce_employee';

    /**
     * @Hook("replaceInsertTags")
     */
    public function insertEmployee(
        string $insertTag,
        bool $useCache,
        string $cachedValue,
        array $flags,
        array $tags,
        array $cache,
        int $_rit,
        int $_cnt
    )
    {
        // {{insert_tag::employeeID::template::1=hideDepartment::1=hideLocation}}
        // example: {{insert_employee::1::ce_employee::1::1}} or {{insert_employee::1::ce_employee}}
        $elements = explode('::', $insertTag);
        $key = strtolower($elements[0]);
        $id = (int)$elements[1];
        $tmpl = (empty($elements[2]) ? $this->defaulttmpl : $elements[2]);
        $dontShowDepartements = (int)$elements[3];
        $dontShowLocations = (int)$elements[4];
        $insertType = 'Inserttag';

        if ('insert_employee' === $key) {
            $db = \Database::getInstance();
            $template = new \FrontendTemplate($tmpl);
            $res = HelperClass::getEmployeeDataByIds([$id]);
            $arrData = HelperClass::prepareArrayDataForEmployeeTemplate($insertType, $dontShowDepartements, $dontShowLocations, $res, $id, $locationIDs, $template);
            $template->arrAnsprechData = $arrData;

            return $template->parse();
        }

        return false;
    }
}
