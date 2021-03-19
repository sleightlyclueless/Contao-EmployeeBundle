<?php

/**
 * @package   EmployeeBundle
 * @author    (c) IXTENSA GmbH & Co. KG Internet und Webagentur -- Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2021
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
        $idQuery = '`id` IN(';

        if (empty($arrIds))
        {
            $idQuery .= 'NULL';
            $idQuery .= ')';
        }
        else
        {
            if (is_string($arrIds))
            {
                $idQuery .= $arrIds.')';
            }
            else 
            {
                foreach($arrIds as $key => $currentArray)
                {
                    // Set current ID from Array on idQuery
                    $currentId = $arrIds[$key];
                    $idQuery .= $currentId.',';
                }
                // remove comata and set paranthese
                if (substr($idQuery, -1) == ',')
                {
                    $idQuery = substr($idQuery, 0, -1);
                    $idQuery .= ')';
                }  
            }
        }

        return $idQuery;
    }

    // Query departement overview names from tl_ixe_departement for specific ids and return the fetched query results
    public function getStringFromIds($arrIds, $insertModeFlag)
    {
        if ($insertModeFlag == 'departements') {
            $query = 'SELECT `departement_overview` FROM `tl_ixe_departement` WHERE ';
        }
        if ($insertModeFlag == 'locations') {
            $query = 'SELECT `name` FROM `tl_ixe_locationdata` WHERE ';
        }

        $idQuery = HelperClass::getMultipleIdsQuery($arrIds);
        $query .= $idQuery;
        $res = \Database::getInstance()->prepare($query)->execute()->fetchAllAssoc();
        $stringElement = '';

        foreach($res as $key => $currentArray)
        {
            if ($insertModeFlag == 'departements') {
                $elementName = $res[$key]['departement_overview'];
            }
            if ($insertModeFlag == 'locations') {
                $elementName = $res[$key]['name'];
            }

            $stringElement .= $elementName.", ";
        }
        // remove comata and set paranthese
        if (substr($stringElement, -2) == ", ") {
            $stringElement = substr($stringElement, 0, -2);
        }

        return $stringElement;
    }

    // Query employeedata from tl_ixe_employeedata for specific ids and return the fetched query results
    public function getEmployeeDataByIds($arrIds) {
        $query = 'SELECT * FROM `tl_ixe_employeedata` WHERE ';
        $idQuery = HelperClass::getMultipleIdsQuery($arrIds);
        $query .= $idQuery;
        $query .= ' AND `published` = 1 ORDER BY `sortingIndex` DESC, `name` ASC';
        $res = \Database::getInstance()->prepare($query)->execute()->fetchAllAssoc();

        return $res;
    }

    // Query locationdata from tl_ixe_locationdata for specific ids and return the fetched query results
    public function getLocationDataById($arrIds) {
        $query = 'SELECT * FROM `tl_ixe_locationdata` WHERE ';
        $idQuery = HelperClass::getMultipleIdsQuery($arrIds);
        $query .= $idQuery;
        $query .= ' AND `published` = 1 ORDER BY `name` ASC';
        $res = \Database::getInstance()->prepare($query)->execute()->fetchAllAssoc();

        return $res;
    }

    public function getLocationGroupDataById($groupId) {
        $query = 'SELECT * FROM `tl_ixe_locationdata` WHERE `pid`='.$groupId.' AND `published` = 1 ORDER BY `name` ASC';
        $res = \Database::getInstance()->prepare($query)->execute()->fetchAllAssoc();

        return $res;
    }

    // Query locationdata from tl_ixe_locationgroup for specific ids and return the fetched query results
    public function getLocationGroupById($arrIds) {
        $query = 'SELECT * FROM `tl_ixe_locationgroup` WHERE ';
        $idQuery = HelperClass::getMultipleIdsQuery($arrIds);
        $query .= $idQuery;
        $query .= ' ORDER BY `name` ASC';
        $res = \Database::getInstance()->prepare($query)->execute()->fetchAllAssoc();

        return $res;
    }

    // Query all employeedata from tl_ixe_employeedata and return the fetched query results
    public function getAllEmployeeData()
    {
        $res = \Database::getInstance()->prepare('SELECT * FROM `tl_ixe_employeedata` WHERE `published` = 1 ORDER BY `sortingIndex` DESC, `name` ASC')->execute()->fetchAllAssoc();

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

        // Unset Image
        unset($res['addImage']);
        unset($res['singleSRC']);
        unset($res['size']);
        unset($res['imagemargin']);
        unset($res['overwriteMeta']);
        unset($res['alt']);
        unset($res['caption']);
        unset($res['imageUrl']);
        unset($res['imageTitle']);

        return $res;
    }

    // Prepare hyperlink for template
    public function prepareLinkForTemplate($res)
    {
        if ($res['target'] == '1') {
            $res['target'] = 'target="_blank"';
        }
        else {
            $res['target'] = "";
        }

        if (!empty($res['embed'])) {
            $embed_parts = explode('%s', $res['embed']);
            $res['embed_pre'] = $embed_parts[0];
            $res['embed_post'] = $embed_parts[1];
            unset($res['embed']);
        }
        else {
            unset($res['embed']);
        }

        if (!empty($res['rel'])) {
            $res['rel'] = 'data-lightbox="'.$res['rel'].'"';
        }

        return $res;
    }

    // prepare an array for the frontend template to display the queried data
    public function prepareArrayDataForEmployeeTemplate($insertType, $dontShowDepartements, $dontShowLocations, $res, $departementIDs, $locationIDs, $locationgroupID, &$Template)
    {
        foreach($res as $key => $currentArray)
        {
            if ($currentArray['hl'] != "h1" && $currentArray['hl'] != "h2" && $currentArray['hl'] != "h3" && $currentArray['hl'] != "h4" && $currentArray['hl'] != "h5" && $currentArray['hl'] != "h6")
            {
                $currentArray['hl'] = "p";
            }

            $currentArray = HelperClass::prepareArrayDepartementTranslations($currentArray, $dontShowDepartements);
            $currentArray = HelperClass::prepareArrayLocationTranslations($currentArray, $dontShowLocations);
            $currentArray = HelperClass::prepareArrayForLanguage($currentArray);

            if (!empty($currentArray['singleSRC']))
            {
                $currentArray = HelperClass::prepareImageForTemplate($currentArray, $key);
            }
            if ($insertType == 'Abteilungen' || $insertType == 'Departements') {
                $checkIfIsInDepartement = array_intersect($departementIDs, $currentArray['departementIDs']);
                if (empty($checkIfIsInDepartement)) {
                    unset($currentArray);
                }
            }

            if ($insertType == 'Standorte' || $insertType == 'Locations') {
                $checkIfIsInLocation = array_intersect($locationIDs, $currentArray['locationIDs']);
                if (empty($checkIfIsInLocation)) {
                    unset($currentArray);
                }
            }

            if ($insertType == 'Standortgruppe' || $insertType == 'Location Group') {
                $isInGroup = false;
                if (!empty($currentArray['locationIDs'])) {
                    foreach($currentArray['locationIDs'] as $idKey => $currID) {
                        $query = 'SELECT `pid` FROM `tl_ixe_locationdata` WHERE `id`='.$currID.' AND `published` = 1';
                        $resID = \Database::getInstance()->prepare($query)->execute()->fetchAllAssoc();
                        if ($locationgroupID == $resID[0]['pid']) {
                            $isInGroup = true;
                        }
                    }
                }
                if ($isInGroup == false) {
                    unset($currentArray);
                }
            }

            if (empty($currentArray))
            {
                unset($res[$key]);
            }
            else
            {
                $res[$key] = $currentArray;
            }
        }

        return $res;
    }

    // Prepare the Departements for the template array from multicolumnwizard field with languages
    public function prepareArrayDepartementTranslations($res, $dontShowDepartements)
    {
        $language = $GLOBALS['TL_LANGUAGE'];
        $langToUpper = strtoupper($language);
        $departementsIDs = HelperClass::getIdsByDelimiter($res['departementCheckList'], '"', '"');

        if ($dontShowDepartements == 1) {
            $res['departementIDs'] = $departementsIDs;
            unset($res['departementCheckList']);
            return $res;
        }

        $departementsString = "";
        $query = 'SELECT `departement` FROM `tl_ixe_departement` WHERE ';
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
            $res['departementIDs'] = $departementsIDs;
        } else {
            unset($res['departementCheckList']);
            $res['departementIDs'] = [];
        }

        return $res;
    }

    // Prepare the Locations for the template
    public function prepareArrayLocationTranslations($res, $dontShowLocations)
    {
        $locationIDs = HelperClass::getIdsByDelimiter($res['locationCheckList'], '"', '"');

        if ($dontShowLocations == 1) {
            $res['locationIDs'] = $locationIDs;
            unset($res['locationCheckList']);
            return $res;
        }

        $locationsString = "";
        $query = 'SELECT `name` FROM `tl_ixe_locationdata` WHERE ';
        $idQuery = HelperClass::getMultipleIdsQuery($locationIDs);
        $query .= $idQuery;
        $query .= ' ORDER BY `name` ASC';
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
            $res['locationIDs'] = $locationIDs;
        } else {
            unset($res['locationCheckList']);
            $res['locationIDs'] = [];
        }

        return $res;
    }

    // Prepare data for template array from multicolumnwizard fields depending on output language
    public function prepareArrayForLanguage($res)
    {
        $language = $GLOBALS['TL_LANGUAGE'];

        $tmpSalutation = \StringUtil::deserialize($res['salutation'], true);
        foreach($tmpSalutation as $key => $currentArray)
        {
            if ($language == $currentArray['salutation_lang'])
            {
                $res['salutation'] = $currentArray['salutation_content'];
                $foundSal = true;
            }
        }
        if(!$foundSal) {
            unset($res['salutation']);
        }

        $tmpTitle = \StringUtil::deserialize($res['title'], true);
        foreach($tmpTitle as $key => $currentArray)
        {
            if ($language == $currentArray['title_lang'])
            {
                $res['title'] = $currentArray['title_content'];
                $foundTit = true;
            }
        }
        if(!$foundTit) {
            unset($res['title']);
        }

        $tmpJobtitle = \StringUtil::deserialize($res['jobtitle'], true);
        foreach($tmpJobtitle as $key => $currentArray)
        {
            if ($language == $currentArray['jobtitle_lang'])
            {
                $res['jobtitle'] = $currentArray['jobtitle_content'];
                $foundJobtit = true;
            }
        }
        if(!$foundJobtit) {
            unset($res['jobtitle']);
        }

        $tmpPhone = \StringUtil::deserialize($res['phone'], true);
        foreach($tmpPhone as $key => $currentArray)
        {
            if ($language == $currentArray['phone_lang'])
            {
                $res['phone'] = $currentArray['phone_content'];
                $res['phoneLinktext'] = $currentArray['phoneLinktext'];
                $foundPhone = true;
            }
        }
        if(!$foundPhone) {
            unset($res['phone']);
            unset($res['phoneLinktext']);
        }

        $tmpMobile = \StringUtil::deserialize($res['mobile'], true);
        foreach($tmpMobile as $key => $currentArray)
        {
            if ($language == $currentArray['mobile_lang'])
            {
                $res['mobile'] = $currentArray['mobile_content'];
                $res['mobileLinktext'] = $currentArray['mobileLinktext'];
                $foundMobile = true;
            }
        }
        if(!$foundMobile) {
            unset($res['mobile']);
            unset($res['mobileLinktext']);
        }

        $tmpFax = \StringUtil::deserialize($res['fax'], true);
        foreach($tmpFax as $key => $currentArray)
        {
            if ($language == $currentArray['fax_lang'])
            {
                $res['fax'] = $currentArray['fax_content'];
                $res['faxLinktext'] = $currentArray['faxLinktext'];
                $foundFax = true;
            }
        }
        if(!$foundFax) {
            unset($res['fax']);
            unset($res['faxLinktext']);
        }

        $tmpMail = \StringUtil::deserialize($res['email'], true);
        foreach($tmpMail as $key => $currentArray)
        {
            if ($language == $currentArray['email_lang'])
            {
                $res['email'] = $currentArray['email_content'];
                $res['emailLinktext'] = $currentArray['emailLinktext'];
                $foundMail = true;
            }
        }
        if(!$foundMail) {
            unset($res['email']);
            unset($res['emailLinktext']);
        }

        return $res;
    }


    // =================================== Location ===================================
    public function prepareArrayDataForLocationTemplate($res, &$Template)
    {
        foreach($res as $key => $currentArray)
        {
            if ($currentArray['hl'] != "h1" && $currentArray['hl'] != "h2" && $currentArray['hl'] != "h3" && $currentArray['hl'] != "h4" && $currentArray['hl'] != "h5" && $currentArray['hl'] != "h6")
            {
                $currentArray['hl'] = "p";
            }

            $currentArray = HelperClass::prepareLocationArrayForLanguage($currentArray);

            if (!empty($currentArray['singleSRC']))
            {
                $currentArray = HelperClass::prepareImageForTemplate($currentArray, $key);
            }

            if (!empty($currentArray['addLink']) && !empty($currentArray['url']))
            {
                $currentArray = HelperClass::prepareLinkForTemplate($currentArray);
            } else {
                unset($currentArray['addLink']);
                unset($currentArray['url']);
                unset($currentArray['target']);
                unset($currentArray['linkTitle']);
                unset($currentArray['embed']);
                unset($currentArray['titleText']);
                unset($currentArray['rel']);
            }

            $res[$key] = $currentArray;
        }

        return $res;
    }

    // Extract Multicolumnwizard values
    function prepareLocationArrayForLanguage($res) {
        $tmpMobile = \StringUtil::deserialize($res['mobile'], true);
        if (!empty($tmpMobile[0]['mobile_content']))
        {
            $res['mobile'] = $tmpMobile;
        } else {
            unset($res['mobile']);
        }

        $tmpTelephone = \StringUtil::deserialize($res['telephone'], true);
        if (!empty($tmpTelephone[0]['telephone_content']))
        {
            $res['telephone'] = $tmpTelephone;
        } else {
            unset($res['telephone']);
        }

        $tmpFaxNumber = \StringUtil::deserialize($res['faxNumber'], true);
        if (!empty($tmpFaxNumber[0]['faxNumber_content']))
        {
            $res['faxNumber'] = $tmpFaxNumber;
        } else {
            unset($res['faxNumber']);
        }

        $tmpEmail = \StringUtil::deserialize($res['email'], true);
        if (!empty($tmpEmail[0]['email_content']))
        {
            $res['email'] = $tmpEmail;
        } else {
            unset($res['email']);
        }

        return $res;
    }
}