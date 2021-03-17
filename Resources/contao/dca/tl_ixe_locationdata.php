<?php

/**
 * @package   EmployeeBundle
 * @author    (c) IXTENSA GmbH & Co. KG Internet und Webagentur -- Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2020
 */

namespace ixtensa\EmployeeBundle\dca\tl_ixe_locationdata;

use MenAtWork\MultiColumnWizardBundle\Contao\Widgets\MultiColumnWizard;

$strName = 'tl_ixe_locationdata';

$GLOBALS['TL_DCA'][$strName] = array(
	'config' => array(
        'dataContainer'      => 'Table',
        'enableVersioning'   => true,
		'sql' => array(
			'keys' => array(
				'id' => 'primary'
			)
		)
	),
    'list' => array(
		'sorting' => array(
			'mode'                    => 2,
            'flag'                    => 1,
            'panelLayout'             => 'filter;name,type',
			'fields'                  => array('name')
		),
		'label' => array(
            'fields'                  => array('name','type'),
			'format'                  => '<b>%s</b>, %s'
		),
		'global_operations' => array(
			'all' => array(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array(
			'edit' => array(
				'label'               => &$GLOBALS['TL_LANG'][$strName]['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.svg',
			),
			'copy' => array(
				'label'               => &$GLOBALS['TL_LANG'][$strName]['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.svg'
			),
			'delete' => array(
				'label'               => &$GLOBALS['TL_LANG'][$strName]['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.svg',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),'toggle' => array(
				'label'               => &$GLOBALS['TL_LANG'][$strName]['toggle'],
				'icon'                => 'visible.svg',
                'showInHeader'        => true,
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback'     => array('ixtensa\EmployeeBundle\dca\tl_ixe_locationdata\tl_ixe_locationdata', 'toggleIcon')
			),
			'show' => array(
				'label'               => &$GLOBALS['TL_LANG'][$strName]['show'],
				'href'                => 'act=show',
				'icon'                => 'show.svg'
			)
		)
	),

	'palettes' => array(
        '__selector__'                => array('addIcon', 'addImage', 'overwriteMeta', 'addLink'),
		'default' => '{main_legend},name,type,title;{icon_legend},addIcon;{image_legend},addImage;{address_legend},companyName,additionalType,streetAddress,streetAdditional,postalCode,addressLocality,addressRegion,addressCountry;{contact_legend},openingHours,,mobileCteText,mobile,telephoneCteText,telephone,faxNumberCteText,faxNumber,emailCteText,email;{more_legend},additionalProperty;{hyperlink_legend},addLink;{published_legend},published;'
	),

	'subpalettes' => array(
        'addIcon'                     => 'icon',
        'addImage'                    => 'singleSRC,size,imagemargin,overwriteMeta',
		'overwriteMeta'               => 'alt,caption,imageUrl,imageTitle',
        'addLink'                     => 'url,target,linkTitle,embed,titleText,rel',
	),

	'fields' => array(
        // Meta Fields
		'id' => array(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
        'sorting' => array(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp' => array(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
        'name' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['name'],
        	'exclude'                 => true,
            'search'                  => true,
        	'sorting'                 => true,
            'filter'                  => true,
            'flag'                    => 1,
        	'inputType'               => 'text',
        	'eval'                    => array(
                'maxlength'=>255,
                'preserveTags'=>true,
                'mandatory'=>true,
                'tl_class'=>'clr w50'
            ),
        	'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'type' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['type'],
        	'exclude'                 => true,
            'search'                  => true,
        	'sorting'                 => true,
            'filter'                  => true,
            'flag'                    => 1,
        	'inputType'               => 'text',
        	'eval'                    => array(
                'maxlength'=>255,
                'preserveTags'=>true,
                'tl_class'=>'clr w50'
            ),
        	'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'title' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['title'],
        	'exclude'                 => true,
            'search'                  => false,
        	'sorting'                 => false,
            'filter'                  => false,
            'flag'                    => 1,
        	'inputType'               => 'text',
        	'eval'                    => array(
                'maxlength'=>255,
                'preserveTags'=>true,
                'tl_class'=>'clr w50'
            ),
        	'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'addIcon' => array(
			'label'                   => &$GLOBALS['TL_LANG'][$strName]['addIcon'],
			'exclude'                 => true,
			'search'                  => false,
			'sorting'                 => false,
			'filter'                  => false,
			'inputType'               => 'checkbox',
			'eval'                    => array(
				'submitOnChange'=>true,
				'tl_class'=>'clr'
			),
			'sql'                     => "char(1) NOT NULL default ''"
		),
        'icon' => array(
            'label'                   => array('Icon', ''),
			'exclude'			      => true,
			'search'      		      => false,
			'sorting'     		      => false,
			'filter'     		      => false,
            'inputType'               => 'rocksolid_icon_picker',
            'eval'                    => array(
                'iconFont' => 'files/x-theme/fonts/iconfonts/rocksolid-icons.svg',
            ),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'addImage' => array(
			'label'                   => &$GLOBALS['TL_LANG'][$strName]['addImage'],
			'exclude'                 => true,
			'search'                  => false,
			'sorting'                 => false,
			'filter'                  => false,
			'inputType'               => 'checkbox',
			'eval'                    => array(
				'submitOnChange'=>true,
				'tl_class'=>'clr'
			),
			'sql'                     => "char(1) NOT NULL default ''"
		),
        'singleSRC' => array(
            'label'				      => &$GLOBALS['TL_LANG'][$strName]['singleSRC'],
			'exclude'			      => true,
			'search'      		      => false,
			'sorting'     		      => false,
			'filter'     		      => false,
			'inputType'			      => 'fileTree',
			'eval'				      => array(
        		'filesOnly'=>true,
        		'fieldType'=>'radio',
        		'extensions' => 'jpg,jpeg,gif,png,svg',
                'mandatory'=>true,
        		'tl_class'=>'clr'
    		),
            'save_callback'			  => array($strName, 'storeFileMetaInformation'),
			'load_callback'			  => array($strName, 'setSingleSrcFlags'),
            'sql'       		      => "binary(16) NULL"
        ),
		'size' => array(
			'label'                   => &$GLOBALS['TL_LANG'][$strName]['size'],
            'exclude'			      => true,
			'search'      		      => false,
			'sorting'     		      => false,
			'filter'     		      => false,
			'inputType'               => 'imageSize',
            'options'                 => \System::getImageSizes(),
			'reference'               => &$GLOBALS['TL_LANG']['MSC'],
			'eval'                    => array(
                'rgxp'=>'natural',
                'includeBlankOption'=>true,
                'nospace'=>true,
                'helpwizard'=>true,
                'tl_class'=>'w50'
            ),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'imagemargin' => array(
			'label'                   => &$GLOBALS['TL_LANG'][$strName]['imagemargin'],
            'exclude'			      => true,
			'search'      		      => false,
			'sorting'     		      => false,
			'filter'     		      => false,
			'inputType'               => 'trbl',
			'options'                 => $GLOBALS['TL_CSS_UNITS'],
			'eval'                    => array(
                'includeBlankOption'=>true,
                'tl_class'=>'w50'
            ),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
        'overwriteMeta' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['overwriteMeta'],
			'exclude'                 => true,
            'search'      		      => false,
			'sorting'     		      => false,
            'filter'     		      => false,
			'inputType'               => 'checkbox',
			'eval'                    => array(
				'submitOnChange'=>true,
				'tl_class'=>'clr'
            ),
			'sql'                     => "char(1) NOT NULL default ''"
		),
        'alt' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['alt'],
            'exclude'			      => true,
            'search'      		      => false,
            'sorting'     		      => false,
            'filter'     		      => false,
            'inputType'               => 'text',
            'eval'                    => array(
                'maxlength'=>255,
                'tl_class'=>'w50'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'caption' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['caption'],
            'exclude'			      => true,
            'search'      		      => false,
            'sorting'     		      => false,
            'filter'     		      => false,
            'inputType'               => 'text',
            'eval'                    => array(
                'maxlength'=>255,
                'tl_class'=>'w50'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'imageUrl' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['imageUrl'],
			'exclude'                 => true,
			'search'                  => true,
            'sorting'     		      => false,
            'filter'     		      => false,
			'inputType'               => 'text',
			'eval'                    => array(
				'rgxp'=>'url',
				'decodeEntities'=>true,
				'maxlength'=>255,
				'dcaPicker'=>true,
				'addWizardClass'=>false,
				'tl_class'=>'w50'
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
        'imageTitle' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['imageTitle'],
			'exclude'                 => true,
			'search'                  => true,
            'sorting'     		      => false,
            'filter'     		      => false,
			'inputType'               => 'text',
			'eval'                    => array(
				'maxlength'=>255,
				'tl_class'=>'w50'
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
        'companyName' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['companyName'],
            'exclude'                 => true,
            'search'                  => false,
            'sorting'                 => false,
            'filter'                  => false,
            'inputType'               => 'text',
            'eval'                    => array(
                'maxlength'=>255,
                'preserveTags'=>true,
                'tl_class'=>'clr w50'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'additionalType' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['additionalType'],
            'exclude'                 => true,
            'search'                  => false,
            'sorting'                 => false,
            'filter'                  => false,
            'inputType'               => 'text',
            'eval'                    => array(
                'maxlength'=>255,
                'preserveTags'=>true,
                'tl_class'=>'w50'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'streetAddress' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['streetAddress'],
            'exclude'                 => true,
            'search'                  => false,
            'sorting'                 => false,
            'filter'                  => false,
            'inputType'               => 'text',
            'eval'                    => array(
                'maxlength'=>255,
                'preserveTags'=>true,
                'tl_class'=>'clr w50'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'streetAdditional' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['streetAdditional'],
            'exclude'                 => true,
            'search'                  => false,
            'sorting'                 => false,
            'filter'                  => false,
            'inputType'               => 'text',
            'eval'                    => array(
                'maxlength'=>255,
                'preserveTags'=>true,
                'tl_class'=>'w50'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'postalCode' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['postalCode'],
            'exclude'                 => true,
            'search'                  => false,
            'sorting'                 => false,
            'filter'                  => false,
            'inputType'               => 'text',
            'eval'                    => array(
                'maxlength'=>255,
                'preserveTags'=>true,
                'tl_class'=>'clr w50'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'addressLocality' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['addressLocality'],
            'exclude'                 => true,
            'search'                  => false,
            'sorting'                 => false,
            'filter'                  => false,
            'inputType'               => 'text',
            'eval'                    => array(
                'maxlength'=>255,
                'preserveTags'=>true,
                'tl_class'=>'w50'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'addressRegion' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['addressRegion'],
            'exclude'                 => true,
            'search'                  => false,
            'sorting'                 => false,
            'filter'                  => false,
            'inputType'               => 'text',
            'eval'                    => array(
                'maxlength'=>255,
                'preserveTags'=>true,
                'tl_class'=>'clr w50'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'addressCountry' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['addressCountry'],
            'exclude'                 => true,
            'search'                  => false,
            'sorting'                 => false,
            'filter'                  => false,
            'inputType'               => 'text',
            'eval'                    => array(
                'maxlength'=>255,
                'preserveTags'=>true,
                'tl_class'=>'w50'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'openingHours' => array(
        	'label'                   => &$GLOBALS['TL_LANG'][$strName]['openingHours'],
        	'exclude'                 => true,
        	'search'                  => false,
			'sorting'                 => false,
			'filter'                  => false,
        	'inputType'               => 'textarea',
        	'eval'                    => array(
                'rte'=>'tinyMCE',
                'tl_class'=>'clr'
            ),
        	'sql'                     => "mediumtext NULL"
        ),
        'mobileCteText' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['mobileCteText'],
        	'exclude'                 => true,
            'search'                  => false,
        	'sorting'                 => false,
            'filter'                  => false,
            'flag'                    => 1,
        	'inputType'               => 'text',
        	'eval'                    => array(
                'maxlength'=>255,
                'preserveTags'=>true,
                'tl_class'=>'clr'
            ),
        	'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'mobile' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['mobile'],
        	'exclude'                 => true,
            'search'                  => false,
			'filter'                  => false,
        	'sorting'                 => false,
		    'inputType'               => 'multiColumnWizard',
            'eval'      => array(
		        'columnFields' => array(
                    'mobile_content' => array(
                    	'label'                   => &$GLOBALS['TL_LANG'][$strName]['mobile_content'],
                    	'exclude'                 => true,
                    	'search'                  => false,
                        'sorting'                 => false,
            			'filter'                  => false,
                    	'inputType'               => 'text',
                    	'eval'                    => array(
                            'maxlength'=>64,
                            'decodeEntities'=>true,
                            'tl_class'=>'w45'
                        )
                    ),
                    'mobileLinktext' => array(
                        'label'                   => &$GLOBALS['TL_LANG'][$strName]['mobileLinktext'],
                    	'exclude'                 => true,
                        'search'                  => true,
                    	'sorting'                 => false,
            			'filter'                  => false,
                    	'inputType'               => 'text',
                    	'eval'                    => array(
                            'maxlength'=>255,
                            'preserveTags'=>true,
                            'tl_class'=>'w45'
                        )
                    ),
		        ),
		    ),
		    'sql'       => 'blob NULL',
        ),
        'telephoneCteText' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['telephoneCteText'],
        	'exclude'                 => true,
            'search'                  => false,
        	'sorting'                 => false,
            'filter'                  => false,
            'flag'                    => 1,
        	'inputType'               => 'text',
        	'eval'                    => array(
                'maxlength'=>255,
                'preserveTags'=>true,
                'tl_class'=>'clr'
            ),
        	'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'telephone' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['telephone'],
        	'exclude'                 => true,
            'search'                  => false,
			'filter'                  => false,
        	'sorting'                 => false,
		    'inputType'               => 'multiColumnWizard',
            'eval'      => array(
		        'columnFields' => array(
                    'telephone_content' => array(
                    	'label'                   => &$GLOBALS['TL_LANG'][$strName]['telephone_content'],
                    	'exclude'                 => true,
                    	'search'                  => false,
                        'sorting'                 => false,
            			'filter'                  => false,
                    	'inputType'               => 'text',
                    	'eval'                    => array(
                            'maxlength'=>64,
                            'decodeEntities'=>true,
                            'tl_class'=>'w45'
                        )
                    ),
                    'telephoneLinktext' => array(
                        'label'                   => &$GLOBALS['TL_LANG'][$strName]['telephoneLinktext'],
                    	'exclude'                 => true,
                        'search'                  => true,
                    	'sorting'                 => false,
            			'filter'                  => false,
                    	'inputType'               => 'text',
                    	'eval'                    => array(
                            'maxlength'=>255,
                            'preserveTags'=>true,
                            'tl_class'=>'w45'
                        )
                    ),
		        ),
		    ),
		    'sql'       => 'blob NULL',
        ),
        'faxNumberCteText' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['faxNumberCteText'],
        	'exclude'                 => true,
            'search'                  => false,
        	'sorting'                 => false,
            'filter'                  => false,
            'flag'                    => 1,
        	'inputType'               => 'text',
        	'eval'                    => array(
                'maxlength'=>255,
                'preserveTags'=>true,
                'tl_class'=>'clr'
            ),
        	'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'faxNumber' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['faxNumber'],
        	'exclude'                 => true,
            'search'                  => false,
			'filter'                  => false,
        	'sorting'                 => false,
		    'inputType'               => 'multiColumnWizard',
            'eval'      => array(
		        'columnFields' => array(
                    'faxNumber_content' => array(
                    	'label'                   => &$GLOBALS['TL_LANG'][$strName]['faxNumber_content'],
                    	'exclude'                 => true,
                    	'search'                  => false,
                        'sorting'                 => false,
            			'filter'                  => false,
                    	'inputType'               => 'text',
                    	'eval'                    => array(
                            'maxlength'=>64,
                            'decodeEntities'=>true,
                            'tl_class'=>'w45'
                        )
                    ),
                    'faxNumberLinktext' => array(
                        'label'                   => &$GLOBALS['TL_LANG'][$strName]['faxNumberLinktext'],
                    	'exclude'                 => true,
                        'search'                  => true,
                    	'sorting'                 => false,
            			'filter'                  => false,
                    	'inputType'               => 'text',
                    	'eval'                    => array(
                            'maxlength'=>255,
                            'preserveTags'=>true,
                            'tl_class'=>'w45'
                        )
                    ),
		        ),
		    ),
		    'sql'       => 'blob NULL',
        ),
        'emailCteText' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['emailCteText'],
        	'exclude'                 => true,
            'search'                  => false,
        	'sorting'                 => false,
            'filter'                  => false,
            'flag'                    => 1,
        	'inputType'               => 'text',
        	'eval'                    => array(
                'maxlength'=>255,
                'preserveTags'=>true,
                'tl_class'=>'clr'
            ),
        	'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'email' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['email'],
        	'exclude'                 => true,
            'search'                  => false,
			'filter'                  => false,
        	'sorting'                 => false,
		    'inputType'               => 'multiColumnWizard',
            'eval'      => array(
		        'columnFields' => array(
                    'email_content' => array(
                    	'label'                   => &$GLOBALS['TL_LANG'][$strName]['email_content'],
                    	'exclude'                 => true,
                    	'search'                  => true,
                        'sorting'                 => true,
                        'filter'                  => true,
                        'flag'                    => 1,
                    	'inputType'               => 'text',
                    	'eval'                    => array(
                            'maxlength'=>255,
                            'decodeEntities'=>true,
                            'tl_class'=>'w45'
                        )
                    ),
                    'emailLinktext' => array(
                        'label'                   => &$GLOBALS['TL_LANG'][$strName]['emailLinktext'],
                    	'exclude'                 => true,
                        'search'                  => true,
                    	'sorting'                 => false,
            			'filter'                  => false,
                    	'inputType'               => 'text',
                    	'eval'                    => array(
                            'maxlength'=>255,
                            'preserveTags'=>true,
                            'tl_class'=>'w45'
                        )
                    ),
		        ),
		    ),
		    'sql'       => 'blob NULL',
        ),
        'additionalProperty' => array(
        	'label'                   => &$GLOBALS['TL_LANG'][$strName]['additionalProperty'],
        	'exclude'                 => true,
        	'search'                  => false,
			'sorting'                 => false,
			'filter'                  => false,
        	'inputType'               => 'textarea',
        	'eval'                    => array(
                'rte'=>'tinyMCE',
                'tl_class'=>'clr'
            ),
        	'sql'                     => "mediumtext NULL"
        ),
        'addLink' => array(
			'label'                   => &$GLOBALS['TL_LANG'][$strName]['addLink'],
			'exclude'                 => true,
			'search'                  => false,
			'sorting'                 => false,
			'filter'                  => false,
			'inputType'               => 'checkbox',
			'eval'                    => array(
				'submitOnChange'=>true,
				'tl_class'=>'clr'
			),
			'sql'                     => "char(1) NOT NULL default ''"
		),
        'url' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['MSC']['url'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array(
                'rgxp'=>'url',
                'mandatory'=>true,
                'decodeEntities'=>true,
                'maxlength'=>255,
                'dcaPicker'=>true,
                'addWizardClass'=>false,
                'tl_class'=>'w50'
            ),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'target' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['MSC']['target'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array(
                'tl_class'=>'w50 m12'
            ),
			'sql'                     => "char(1) NOT NULL default ''"
		),
        'linkTitle' => array
		(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['linkTitle'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array(
                'maxlength'=>255,
                'tl_class'=>'w50'
            ),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'embed' => array
		(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['embed'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array(
                'maxlength'=>255,
                'tl_class'=>'w50'
            ),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
        'titleText' => array
		(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['titleText'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array(
                'maxlength'=>255,
                'tl_class'=>'w50'
            ),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
        'rel' => array
		(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['rel'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array(
                'maxlength'=>64,
                'tl_class'=>'w50'
            ),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
        'published' => array(
			'label'                   => &$GLOBALS['TL_LANG'][$strName]['published'],
			'exclude'                 => true,
			'search'      		      => true,
			'sorting'     		      => true,
			'filter'                  => true,
			'flag'                    => 1,
			'inputType'               => 'checkbox',
			'eval'                    => array(
                'doNotCopy'=>true,
                'tl_class'=>'clr'
            ),
			'sql'                     => "char(1) NOT NULL default ''"
		),
	)
);

class tl_ixe_locationdata extends \Backend
{
    /**
	 * Den Backend User importieren
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('\BackendUser', 'User');
	}

    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (\mb_strlen(\Input::get('tid')))
		{
			$this->toggleVisibility(\Input::get('tid'), (\Input::get('state') == 1), (@func_get_arg(12) ?: null));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		if (!$this->User->hasAccess('tl_ixe_locationdata::published', 'alexf'))
		{
			return '';
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.svg';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.\StringUtil::specialchars($title).'"'.$attributes.'>'.\Image::getHtml($icon, $label, 'data-state="' . ($row['published'] ? 1 : 0) . '"').'</a> ';
	}

    public function toggleVisibility($intId, $blnVisible, \DataContainer $dc=null)
	{
		// Set the ID and action
		\Input::setGet('id', $intId);
		\Input::setGet('act', 'toggle');

        $strName = 'tl_ixe_locationdata';

		if ($dc)
		{
			$dc->id = $intId; // see #8043
		}

		// Trigger the onload_callback
		if (\is_array($GLOBALS['TL_DCA'][$strName]['config']['onload_callback']))
		{
			foreach ($GLOBALS['TL_DCA'][$strName]['config']['onload_callback'] as $callback)
			{
				if (\is_array($callback))
				{
					$this->import($callback[0]);
					$this->{$callback[0]}->{$callback[1]}($strName);
				}
				elseif (\is_callable($callback))
				{
					$callback($dc);
				}
			}
		}

		// Check the field access
		if (!$this->User->hasAccess($strName.'::published', 'alexf'))
		{
			throw new Contao\CoreBundle\Exception\AccessDeniedException('Not enough permissions to publish/unpublish form field ID ' . $intId . '.');
		}

		// Set the current record
		if ($dc)
		{
			$objRow = $this->Database->prepare("SELECT * FROM tl_ixe_locationdata WHERE id=?")
									 ->limit(1)
									 ->execute($intId);

			if ($objRow->numRows)
			{
				$dc->activeRecord = $objRow;
			}
		}

		$objVersions = new \Versions($strName, $intId);
		$objVersions->initialize();

		// Trigger the save_callback
		if (\is_array($GLOBALS['TL_DCA'][$strName]['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA'][$strName]['fields']['published']['save_callback'] as $callback)
			{
				if (\is_array($callback))
				{
					$this->import($callback[0]);
					$blnVisible = $this->{$callback[0]}->{$callback[1]}($blnVisible, $dc);
				}
				elseif (\is_callable($callback))
				{
					$blnVisible = $callback($blnVisible, $dc);
				}
			}
		}

		$time = time();

		$this->Database->prepare("UPDATE tl_ixe_locationdata SET tstamp=$time, published='" . ($blnVisible ? '1' : '') . "' WHERE id=?")
					   ->execute($intId);

		if ($dc)
		{
			$dc->activeRecord->tstamp = $time;
			$dc->activeRecord->published = ($blnVisible ? '1' : '');
		}

		// Trigger the onsubmit_callback
		if (\is_array($GLOBALS['TL_DCA'][$strName]['config']['onsubmit_callback']))
		{
			foreach ($GLOBALS['TL_DCA'][$strName]['config']['onsubmit_callback'] as $callback)
			{
				if (\is_array($callback))
				{
					$this->import($callback[0]);
					$this->{$callback[0]}->{$callback[1]}($dc);
				}
				elseif (\is_callable($callback))
				{
					$callback($dc);
				}
			}
		}
		$objVersions->create();
	}

	// Save singleSRC / Image function from Contao
	public function storeFileMetaInformation($varValue, DataContainer $dc)
	{
		if ($dc->activeRecord->singleSRC != $varValue)
		{
			$this->addFileMetaInformationToRequest($varValue, ($dc->activeRecord->ptable ?: 'tl_article'), $dc->activeRecord->pid);
		}
		return $varValue;
	}

    // Set SrcFlags function from Contao
	public function setSingleSrcFlags($varValue, DataContainer $dc)
	{
		if ($dc->activeRecord)
		{
			switch ($dc->activeRecord->type)
			{
				case 'text':
				case 'hyperlink':
				case 'image':
				case 'accordionSingle':
					$GLOBALS['TL_DCA'][$dc->table]['fields'][$dc->field]['eval']['extensions'] = Config::get('validImageTypes');
					break;

				case 'download':
					$GLOBALS['TL_DCA'][$dc->table]['fields'][$dc->field]['eval']['extensions'] = Config::get('allowedDownload');
					break;
			}
		}
		return $varValue;
	}
}
