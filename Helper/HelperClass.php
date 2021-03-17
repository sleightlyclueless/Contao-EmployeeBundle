<?php

/**
 * @package   EmployeeBundle
 * @author    (c) IXTENSA GmbH & Co. KG Internet und Webagentur -- Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2020
 */

namespace ixtensa\EmployeeBundle\Helper;

class HelperClass extends \Backend
{
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
        $this->import('Database');
    }

    // Extract IDs from a String when they are embedded into specific characters (e.g. IDFOLLOWS[2]ANDANOTHER[3]) and return those as an array
    public function getIdsByDelimiter($str, $startDelimiter, $endDelimiter)
    {
        $contents = array();
        $startDelimiterLength = strlen($startDelimiter);
        $endDelimiterLength = strlen($endDelimiter);
        $startFrom = $contentStart = $contentEnd = 0;

        while (false !== ($contentStart = strpos($str, $startDelimiter, $startFrom)))
        {
            // Find Start of content
            $contentStart += $startDelimiterLength;
            // Find End of content
            $contentEnd = strpos($str, $endDelimiter, $contentStart);
            if (false === $contentEnd)
            {
                break;
            }
            // Add the found ID to Array $contents
            $contents[] = substr($str, $contentStart, $contentEnd - $contentStart);
            // Reset the start element to after the element we just found and repeat the loop
            $startFrom = $contentEnd + $endDelimiterLength;
        }

        return $contents;
    }

    // Build a query on a table for multiple IDs – WHERE ID IN(1,2,4,5) or WHERE ID IN(NULL)
    public function getMultipleIdsQuery($arrIds) {
        $idQuery = "id IN(";

        if (empty($arrIds))
        {
            $idQuery .= "NULL";
            $idQuery .= ")";
        }
        else
        {
            foreach($arrIds as $key => $currentArray)
            {
                // Set current ID from Array on idQuery
                $currentId = $arrIds[$key];
                $idQuery .= "$currentId".",";
            }
            // remove comata and set paranthese
            if (substr($idQuery, -1) == ",") {
                $idQuery = substr($idQuery, 0, -1);
                $idQuery .= ")";
            }
        }

        return $idQuery;
    }

    // Query departement overview names from tl_ixe_departement for specific ids and return the fetched query results
    public function getStringFromIds($arrIds, $insertModeFlag)
    {
        if ($insertModeFlag == "departements") {
            $query = "SELECT departement_overview FROM tl_ixe_departement WHERE ";
        }
        if ($insertModeFlag == "locations") {
            $query = "SELECT name FROM tl_ixe_locationdata WHERE ";
        }

        $idQuery = HelperClass::getMultipleIdsQuery($arrIds);
        $query .= $idQuery;
        $res = \Database::getInstance()->prepare($query)->execute()->fetchAllAssoc();
        $stringElement = "";

        foreach($res as $key => $currentArray)
        {
            if ($insertModeFlag == "departements") {
                $elementName = $res[$key]['departement_overview'];
            }
            if ($insertModeFlag == "locations") {
                $locationName = $res[$key]['name'];
            }

            $stringElement .= "$elementName".", ";
        }
        // remove comata and set paranthese
        if (substr($stringElement, -2) == ", ") {
            $stringElement = substr($stringElement, 0, -2);
        }

        return $stringElement;
    }

    // Query employeedata from tl_ixe_employeedata for specific ids and return the fetched query results
    public function getEmployeeDataByIds($arrIds) {
        $query = "SELECT * FROM tl_ixe_employeedata WHERE ";
        $idQuery = HelperClass::getMultipleIdsQuery($arrIds);
        $query .= $idQuery;
        $query .= " AND published = 1 ORDER BY `sortingIndex` DESC, `name` ASC";
        $res = \Database::getInstance()->prepare($query)->execute()->fetchAllAssoc();

        return $res;
    }

    // Query locationdata from tl_ixe_locationdata for specific ids and return the fetched query results
    public function getLocationDataById($arrIds) {
        $query = "SELECT * FROM tl_ixe_locationdata WHERE ";
        $idQuery = HelperClass::getMultipleIdsQuery($arrIds);
        $query .= $idQuery;
        $query .= " AND published = 1 ORDER BY `name` ASC";
        $res = \Database::getInstance()->prepare($query)->execute()->fetchAllAssoc();

        return $res;
    }

    // Query all employeedata from tl_ixe_employeedata and return the fetched query results
    public function getAllEmployeeData()
    {
        $res = \Database::getInstance()->prepare("SELECT * FROM tl_ixe_employeedata WHERE published = 1 ORDER BY `sortingIndex` DESC, `name` ASC")->execute()->fetchAllAssoc();

        return $res;
    }

    // Prepare an image object from a singleSRC for the frontend templates
    public function prepareImageForTemplate($res, $key)
    {
        $objFile = \FilesModel::findByUuid($res['singleSRC']);

        if ($objFile !== null && is_file(TL_ROOT . '/' . $objFile->path))
        {
            $res['singleSRC'] = $objFile->path;
            $meta = deserialize($objFile->meta);
            $obj = new \stdClass();
            \Controller::addImageToTemplate($obj, $res, null, null, $objModel[$key]);
            $obj->caption = (empty($res['caption'])) ? $meta[$GLOBALS['TL_LANGUAGE']]['caption'] : $res['caption'];
            $obj->picture['alt'] = (empty($res['alt'])) ? $meta[$GLOBALS['TL_LANGUAGE']]['alt'] : $res['alt'];
            $obj->picture['title'] = (empty($res['imageTitle'])) ? $meta[$GLOBALS['TL_LANGUAGE']]['title'] : $res['imageTitle'];
            $res['imageUrl'] = (empty($res['imageUrl'])) ? $meta[$GLOBALS['TL_LANGUAGE']]['link'] : $res['imageUrl'];
            $res['arrPicture'][] = $obj;
        }
        unset($res['singleSRC']);
        unset($res['size']);
        unset($res['imagemargin']);
        unset($res['overwriteMeta']);
        unset($res['alt']);
        unset($res['caption']);
        unset($res['imageTitle']);
        unset($res['imageUrl']);

        return $res;
    }

    // Prepare hyperlink for template
    public function prepareLinkForTemplate($res)
    {
        if ($res['target'] == "1") {
            $res['target'] = 'target="_blank"';
        }
        else {
            $res['target'] = '';
        }

        if (!empty($res['embed'])) {
            $embed_parts = explode('%s', $res['embed']);
            $res['embed_pre'] = $embed_parts[0];
            $res['embed_post'] = $embed_parts[1];
            unset($res['embed']);
        }
        else {
            $res['embed_pre'] = '';
            $res['embed_post'] = '';
            unset($res['embed']);
        }

        if (!empty($res['rel'])) {
            $res['rel'] = 'data-lightbox="'.$res['rel'].'"';
        }
        return $res;
    }

    // prepare an array for the frontend template to display the queried data
    public function prepareArrayDataForEmployeeTemplate($insertType, $dontShowDepartements, $dontShowLocations, $res, $departementIDs, $locationIDs, &$Template)
    {
        foreach($res as $key => $currentArray)
        {
            $res[$key] = HelperClass::prepareArrayDepartementTranslations($res[$key], $dontShowDepartements);
            $res[$key] = HelperClass::prepareArrayLocationTranslations($res[$key], $dontShowLocations);
            $res[$key] = HelperClass::prepareArrayForLanguage($res[$key]);

            if (!empty($currentArray['singleSRC']))
            {
                $res[$key] = HelperClass::prepareImageForTemplate($res[$key], $key);
            }

            if ($insertType == "Abteilungen" || $insertType == "Departements") {
                $employeeDepartementsIDs = HelperClass::getIdsByDelimiter($currentArray['departementCheckList'], '"', '"');
                $checkIfIsInDepartement = array_intersect($departementIDs, $employeeDepartementsIDs);
                if (empty($checkIfIsInDepartement)) {
                    unset($res[$key]);
                }
            }

            if ($insertType == "Standorte" || $insertType == "Locations") {
                $employeeLocationIDs = HelperClass::getIdsByDelimiter($currentArray['locationCheckList'], '"', '"');
                $checkIfIsInLocation = array_intersect($locationIDs, $employeeLocationIDs);
                if (empty($checkIfIsInLocation)) {
                    unset($res[$key]);
                }
            }
        }

        if (empty($res)) {
            $res[0]['checkEmptyArray'] = $GLOBALS['IX_EB']['MSC']['checkEmptyArrayEmployee'];
        }

        return $res;
    }

    // Prepare the Departements for the template array from multicolumnwizard field with languages
    public function prepareArrayDepartementTranslations($res, $dontShowDepartements)
    {
        if ($dontShowDepartements == 1) {
            unset($res['departementCheckList']);
            $res['departementCheckList_err'] = $GLOBALS['IX_EB']['MSC']['no_departement_consent'];
            return $res;
        }

        $language = $GLOBALS['TL_LANGUAGE'];
        $langToUpper = strtoupper($language);
        $departementsIDs = HelperClass::getIdsByDelimiter($res['departementCheckList'], '"', '"');
        $departementsString = "";
        $query = "SELECT departement FROM tl_ixe_departement WHERE ";
        $idQuery = HelperClass::getMultipleIdsQuery($departementsIDs);
        $query .= $idQuery;
        $departementsRes = \Database::getInstance()->prepare($query)->execute()->fetchAllAssoc();

        foreach($departementsRes as $key => $currentArray)
        {
            $multiColContent = \StringUtil::deserialize($currentArray['departement'], true);
            foreach($multiColContent as $key => $currentMultiCol)
            {
                if ($language == $currentMultiCol['departement_lang'])
                {
                    $departementsString .= $currentMultiCol['departement_name'].", ";
                }
            }
        }
        // remove space and comata by last entry
        if (!empty($departementsString))
        {
            $departementsString = str_replace('[nbsp], ', '',$departementsString);
            $departementsString = substr($departementsString, 0, -2);
            $res['departementCheckList'] = $departementsString;
        }
        else if (empty($departementsIDs))
        {
            unset($res['departementCheckList']);
            $res['departementCheckList_err'] = $GLOBALS['IX_EB']['MSC']['no_departement_defined'];
        }
        else
        {
            unset($res['departementCheckList']);
            $res['departementCheckList_err'] = sprintf($GLOBALS['IX_EB']['MSC']['no_departement_for_language'], $langToUpper);
        }

        return $res;
    }

    // Prepare the Locations for the template
    public function prepareArrayLocationTranslations($res, $dontShowLocations)
    {
        if ($dontShowLocations == 1) {
            unset($res['locationCheckList']);
            $res['locationCheckList_err'] = $GLOBALS['IX_EB']['MSC']['no_location_consent'];
            return $res;
        }

        $locationIDs = HelperClass::getIdsByDelimiter($res['locationCheckList'], '"', '"');
        $locationsString = "";
        $query = "SELECT name FROM tl_ixe_locationdata WHERE ";
        $idQuery = HelperClass::getMultipleIdsQuery($locationIDs);
        $query .= $idQuery;
        $query .= " ORDER BY `name` ASC";
        $locationRes = \Database::getInstance()->prepare($query)->execute()->fetchAllAssoc();

        foreach($locationRes as $key => $currentArray)
        {
            $locationsString .= $currentArray['name'].", ";
        }
        // remove space and comata by last entry
        if (!empty($locationsString))
        {
            $locationsString = substr($locationsString, 0, -2);
            $res['locationCheckList'] = $locationsString;
        }
        else if (empty($locationIDs))
        {
            unset($res['locationCheckList']);
            $res['locationCheckList_err'] = $GLOBALS['IX_EB']['MSC']['no_location_defined'];
        }
        else
        {
            unset($res['locationCheckList']);
            $res['locationCheckList_err'] = sprintf($GLOBALS['IX_EB']['MSC']['no_location_found']);
        }

        return $res;
    }

    // Prepare data for template array from multicolumnwizard fields depending on output language
    public function prepareArrayForLanguage($res)
    {
        $language = $GLOBALS['TL_LANGUAGE'];
        $langToUpper = strtoupper($language);
        $tmpSalutation = \StringUtil::deserialize($res['salutation'], true);
        $languageFoundSalutation = false;

        foreach($tmpSalutation as $key => $currentArray)
        {
            if ($language == $currentArray['salutation_lang'])
            {
                $res['salutation'] = $currentArray['salutation_content'];
                $languageFoundSalutation = true;
            }
        }
        if ($languageFoundSalutation === false || empty($res['salutation']))
        {
            unset($res['salutation']);
            $res['salutation_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['no_language'], '"Salutation"', '"'.$langToUpper.'"');
        }

        $tmpTitle = \StringUtil::deserialize($res['title'], true);
        $languageFoundTitle = false;
        foreach($tmpTitle as $key => $currentArray)
        {
            if ($language == $currentArray['title_lang'])
            {
                $res['title'] = $currentArray['title_content'];
                $languageFoundTitle = true;
            }
        }
        if ($languageFoundTitle === false || empty($res['title']))
        {
            unset($res['title']);
            $res['title_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['no_language'], '"Title"', '"'.$langToUpper.'"');
        }

        $tmpJobtitle = \StringUtil::deserialize($res['jobtitle'], true);
        $languageFoundJobTitle = false;
        foreach($tmpJobtitle as $key => $currentArray)
        {
            if ($language == $currentArray['jobtitle_lang'])
            {
                $res['jobtitle'] = $currentArray['jobtitle_content'];
                $languageFoundJobTitle = true;
            }
        }
        if ($languageFoundJobTitle === false || empty($res['jobtitle']))
        {
            unset($res['jobtitle']);
            $res['jobtitle_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['no_language'], '"Jobtitle"', '"'.$langToUpper.'"');
        }

        $tmpPhone = \StringUtil::deserialize($res['phone'], true);
        $languageFoundPhone = false;
        foreach($tmpPhone as $key => $currentArray)
        {
            if ($language == $currentArray['phone_lang'])
            {
                $res['phone'] = $currentArray['phone_content'];
                $res['phoneLinktext'] = $currentArray['phoneLinktext'];
                $languageFoundPhone = true;
            }
        }
        if ($languageFoundPhone === false || empty($res['phone']))
        {
            unset($res['phone']);
            $res['phone_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['no_language'], '"Phone"', '"'.$langToUpper.'"');
            $res['phoneLinktext'] = "";
        }

        $tmpMobile = \StringUtil::deserialize($res['mobile'], true);
        $languageFoundMobile = false;
        foreach($tmpMobile as $key => $currentArray)
        {
            if ($language == $currentArray['mobile_lang'])
            {
                $res['mobile'] = $currentArray['mobile_content'];
                $res['mobileLinktext'] = $currentArray['mobileLinktext'];
                $languageFoundMobile = true;
            }
        }
        if ($languageFoundMobile === false || empty($res['mobile']))
        {
            unset($res['mobile']);
            $res['mobile_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['no_language'], '"Mobile"', '"'.$langToUpper.'"');
            $res['mobileLinktext'] = "";
        }

        $tmpFax = \StringUtil::deserialize($res['fax'], true);
        $languageFoundFax = false;
        foreach($tmpFax as $key => $currentArray)
        {
            if ($language == $currentArray['fax_lang'])
            {
                $res['fax'] = $currentArray['fax_content'];
                $res['faxLinktext'] = $currentArray['faxLinktext'];
                $languageFoundFax = true;
            }
        }
        if ($languageFoundFax === false || empty($res['fax']))
        {
            unset($res['fax']);
            $res['fax_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['no_language'], '"Fax"', '"'.$langToUpper.'"');
            $res['faxLinktext'] = "";
        }

        $tmpMail = \StringUtil::deserialize($res['email'], true);
        $languageFoundMail = false;
        foreach($tmpMail as $key => $currentArray)
        {
            if ($language == $currentArray['email_lang'])
            {
                $res['email'] = $currentArray['email_content'];
                $res['emailLinktext'] = $currentArray['emailLinktext'];
                $languageFoundMail = true;
            }
        }
        if ($languageFoundMail === false || empty($res['email']))
        {
            unset($res['email']);
            $res['email_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['no_language'], '"E-Mail"', '"'.$langToUpper.'"');
            $res['emailLinktext'] = "";
        }

        return $res;
    }


    // =================================== Location ===================================
    public function prepareArrayDataForLocationTemplate($res, &$Template)
    {
        foreach($res as $key => $currentArray)
        {
            $res[$key] = HelperClass::prepareLocationArrayForLanguage($res[$key]);

            if (!empty($currentArray['singleSRC']))
            {
                $res[$key] = HelperClass::prepareImageForTemplate($res[$key], $key);
            }

            if (!empty($currentArray['addLink']) && !empty($currentArray['url']))
            {
                $res[$key] = HelperClass::prepareLinkForTemplate($res[$key]);
            }

            if (empty($res[$key]['type'])) {
                unset($res[$key]['type']);
                $res[$key]['type_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['empty'], '"type"');
            }
            if (empty($res[$key]['title'])) {
                unset($res[$key]['title']);
                $res[$key]['title_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['empty'], '"title"');
            }
            if (empty($res[$key]['openingHours'])) {
                unset($res[$key]['title']);
                $res[$key]['openingHours_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['empty'], '"openingHours"');
            }
            if (empty($res[$key]['additionalProperty'])) {
                unset($res[$key]['title']);
                $res[$key]['additionalProperty_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['empty'], '"additionalProperty"');
            }
            if (empty($res[$key]['url'])) {
                unset($res[$key]['target']);
                unset($res[$key]['linkTitle']);
                unset($res[$key]['embed']);
                unset($res[$key]['titleText']);
                unset($res[$key]['rel']);
                $res[$key]['url_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['empty'], '"url"');
            }
            if (empty($res[$key]['addressCountry'])) {
                unset($res[$key]['addressCountry']);
                $res[$key]['addressCountry_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['empty'], '"addressCountry"');
            }
            if (empty($res[$key]['addressRegion'])) {
                unset($res[$key]['addressRegion']);
                $res[$key]['addressRegion_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['empty'], '"addressRegion"');
            }
            if (empty($res[$key]['addressLocality'])) {
                unset($res[$key]['addressLocality']);
                $res[$key]['addressLocality_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['empty'], '"addressLocality"');
            }
            if (empty($res[$key]['postalCode'])) {
                unset($res[$key]['postalCode']);
                $res[$key]['postalCode_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['empty'], '"postalCode"');
            }
            if (empty($res[$key]['streetAdditional'])) {
                unset($res[$key]['streetAdditional']);
                $res[$key]['streetAdditional_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['empty'], '"streetAdditional"');
            }
            if (empty($res[$key]['streetAddress'])) {
                unset($res[$key]['streetAddress']);
                $res[$key]['streetAddress_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['empty'], '"streetAddress"');
            }
            if (empty($res[$key]['companyName'])) {
                unset($res[$key]['companyName']);
                $res[$key]['companyName_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['empty'], '"companyName"');
            }
            if (empty($res[$key]['additionalType'])) {
                unset($res[$key]['additionalType']);
                $res[$key]['additionalType_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['empty'], '"additionalType"');
            }
        }

        if (empty($res)) {
            $res[0]['checkEmptyArray'] = $GLOBALS['IX_EB']['MSC']['checkEmptyArrayLocation'];
        }

        return $res;
    }

    // Extract Multicolumnwizard values
    function prepareLocationArrayForLanguage($res) {
        $tmpMobile = \StringUtil::deserialize($res['mobile'], true);
        $foundMobile = false;
        if (!empty($tmpMobile[0]['mobile_content']))
        {
            $res['mobile'] = $tmpMobile;
            $foundMobile = true;
        }
        if ($foundMobile === false || empty($res['mobile']))
        {
            unset($res['mobile']);
            $res['mobile_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['empty'], '"mobile"');
        }

        $tmpTelephone = \StringUtil::deserialize($res['telephone'], true);
        $foundTelephone = false;
        if (!empty($tmpTelephone[0]['telephone_content']))
        {
            $res['telephone'] = $tmpTelephone;
            $foundTelephone = true;
        }
        if ($foundTelephone === false || empty($res['telephone']))
        {
            unset($res['telephone']);
            $res['telephone_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['empty'], '"telephone"');
        }

        $tmpFaxNumber = \StringUtil::deserialize($res['faxNumber'], true);
        $foundFaxNumber = false;
        if (!empty($tmpFaxNumber[0]['faxNumber_content']))
        {
            $res['faxNumber'] = $tmpFaxNumber;
            $foundFaxNumber = true;
        }
        if ($foundFaxNumber === false || empty($res['faxNumber']))
        {
            unset($res['faxNumber']);
            $res['faxNumber_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['empty'], '"faxNumber"');
        }

        $tmpEmail = \StringUtil::deserialize($res['email'], true);
        $foundEmail = false;
        if (!empty($tmpEmail[0]['email_content']))
        {
            $res['email'] = $tmpEmail;
            $foundEmail = true;
        }
        if ($foundEmail === false || empty($res['email']))
        {
            unset($res['email']);
            $res['email_empty'] = sprintf($GLOBALS['IX_EB']['MSC']['empty'], '"email"');
        }

        return $res;
    }
}
