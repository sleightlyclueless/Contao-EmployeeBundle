<?php

/**
 * @package   EmployeeBundle
 * @author    (c) IXTENSA GmbH & Co. KG Internet und Webagentur -- Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2020
 */

namespace ixtensa\EmployeeBundle\dca\tl_ixe_employeedata;

use Symfony\Component\Intl\Intl;
use MenAtWork\MultiColumnWizardBundle\Contao\Widgets\MultiColumnWizard;
use \ixtensa\EmployeeBundle\Widget\EmployeeBundleCheckboxes;

$strName = 'tl_ixe_employeedata';

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
            'panelLayout'             => 'filter;name,firstname',
			'fields'                  => array('name')
		),
		'label' => array(
            'fields'                  => array('name','firstname'),
			'format'                  => '<b>%s</b>, %s'
		),
		'global_operations' => array(
            'editAbteilungen' => array
			(
				'label'               => &$GLOBALS['TL_LANG'][$strName]['editAbteilungen'],
                'href'                => 'do=departement',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			),
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
                'button_callback'     => array('ixtensa\EmployeeBundle\dca\tl_ixe_employeedata\tl_ixe_employeedata', 'toggleIcon')
			),
			'show' => array(
				'label'               => &$GLOBALS['TL_LANG'][$strName]['show'],
				'href'                => 'act=show',
				'icon'                => 'show.svg'
			)
		)
	),

	'palettes' => array(
        '__selector__'                => array('addDepartement','addLocation','addImage', 'overwriteMeta'),
		'default' => '{salutation_legend},salutation,title;{name_legend},firstname,name;{image_legend},addImage;{contact_legend},phone,mobile,fax,email;{meta_legend},addDepartement,addLocation,jobtitle;{more_legend},text;{sorting_legend},sortingIndex;{published_legend},published;'
	),

	'subpalettes' => array(
        'addImage'                    => 'singleSRC,size,imagemargin,overwriteMeta',
		'overwriteMeta'               => 'alt,caption,imageUrl,imageTitle',
        'addDepartement'              => 'departementCheckList',
        'addLocation'                 => 'locationCheckList',
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
        'salutation' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['salutation'],
        	'exclude'                 => true,
            'search'                  => false,
			'filter'                  => false,
        	'sorting'                 => false,
		    'inputType'               => 'multiColumnWizard',
            'eval'      => array(
		        'columnFields' => array(
                    'salutation_lang' => array(
						'label'                   => &$GLOBALS['TL_LANG'][$strName]['translations_lang'],
						'exclude'                 => true,
                        'search'                  => false,
            			'filter'                  => false,
                    	'sorting'                 => false,
						'inputType'               => 'select',
						'eval'                    => array(
                            'style'=>'width:100%;',
                            'chosen'=>true,
                            'tl_class'=>'w45'
                        ),
                        'options_callback'        => array('ixtensa\EmployeeBundle\dca\tl_ixe_employeedata\tl_ixe_employeedata', 'getLanguageOptions'),
                        'load_callback'			  => array(array('ixtensa\EmployeeBundle\dca\tl_ixe_employeedata\tl_ixe_employeedata', 'setLangDefault'))
					),
                    'salutation_content' => array(
                        'label'                   => &$GLOBALS['TL_LANG'][$strName]['salutation_content'],
                        'exclude'                 => true,
            			'search'                  => false,
                        'filter'                  => false,
                        'sorting'                 => false,
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
        'title' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['title'],
        	'exclude'                 => true,
            'search'                  => false,
			'filter'                  => false,
        	'sorting'                 => false,
		    'inputType'               => 'multiColumnWizard',
            'eval'      => array(
		        'columnFields' => array(
                    'title_lang' => array(
						'label'                   => &$GLOBALS['TL_LANG'][$strName]['translations_lang'],
						'exclude'                 => true,
                        'search'                  => false,
            			'filter'                  => false,
                    	'sorting'                 => false,
						'inputType'               => 'select',
						'eval'                    => array(
                            'style'=>'width:100%;',
                            'chosen'=>true,
                            'tl_class'=>'w45'
                        ),
                        'options_callback'        => array('ixtensa\EmployeeBundle\dca\tl_ixe_employeedata\tl_ixe_employeedata', 'getLanguageOptions'),
                        'load_callback'			  => array(array('ixtensa\EmployeeBundle\dca\tl_ixe_employeedata\tl_ixe_employeedata', 'setLangDefault'))
					),
                    'title_content' => array(
                        'label'                   => &$GLOBALS['TL_LANG'][$strName]['title_content'],
                    	'exclude'                 => true,
                        'search'                  => false,
            			'filter'                  => false,
                    	'sorting'                 => false,
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
        'firstname' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['firstname'],
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
                'tl_class'=>'w50'
            ),
        	'sql'                     => "varchar(255) NOT NULL default ''"
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
        'phone' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['phone'],
        	'exclude'                 => true,
            'search'                  => false,
			'filter'                  => false,
        	'sorting'                 => false,
		    'inputType'               => 'multiColumnWizard',
            'eval'      => array(
		        'columnFields' => array(
                    'phone_lang' => array(
						'label'                   => &$GLOBALS['TL_LANG'][$strName]['translations_lang'],
						'exclude'                 => true,
                        'search'                  => false,
            			'filter'                  => false,
                    	'sorting'                 => false,
						'inputType'               => 'select',
						'eval'                    => array(
                            'style'=>'width:100%;',
                            'chosen'=>true,
                            'tl_class'=>'w30'
                        ),
                        'options_callback'        => array('ixtensa\EmployeeBundle\dca\tl_ixe_employeedata\tl_ixe_employeedata', 'getLanguageOptions'),
                        'load_callback'			  => array(array('ixtensa\EmployeeBundle\dca\tl_ixe_employeedata\tl_ixe_employeedata', 'setLangDefault'))
					),
                    'phone_content' => array(
                    	'label'                   => &$GLOBALS['TL_LANG'][$strName]['phone_content'],
                    	'exclude'                 => true,
                    	'search'                  => false,
                        'sorting'                 => false,
            			'filter'                  => false,
                    	'inputType'               => 'text',
                    	'eval'                    => array(
                            'maxlength'=>64,
                            'decodeEntities'=>true,
                            'tl_class'=>'w30'
                        )
                    ),
                    'phoneLinktext' => array(
                        'label'                   => &$GLOBALS['TL_LANG'][$strName]['phoneLinktext'],
                    	'exclude'                 => true,
                        'search'                  => true,
                    	'sorting'                 => false,
            			'filter'                  => false,
                    	'inputType'               => 'text',
                    	'eval'                    => array(
                            'maxlength'=>255,
                            'preserveTags'=>true,
                            'tl_class'=>'w30'
                        )
                    ),
		        ),
		    ),
		    'sql'       => 'blob NULL',
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
                    'mobile_lang' => array(
						'label'                   => &$GLOBALS['TL_LANG'][$strName]['translations_lang'],
						'exclude'                 => true,
                        'search'                  => false,
            			'filter'                  => false,
                    	'sorting'                 => false,
						'inputType'               => 'select',
						'eval'                    => array(
                            'style'=>'width:100%;',
                            'chosen'=>true,
                            'tl_class'=>'w30'
                        ),
                        'options_callback'        => array('ixtensa\EmployeeBundle\dca\tl_ixe_employeedata\tl_ixe_employeedata', 'getLanguageOptions'),
                        'load_callback'			  => array(array('ixtensa\EmployeeBundle\dca\tl_ixe_employeedata\tl_ixe_employeedata', 'setLangDefault'))
					),
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
                            'tl_class'=>'w30'
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
                            'tl_class'=>'w30'
                        )
                    ),
		        ),
		    ),
		    'sql'       => 'blob NULL',
        ),
        'fax' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['fax'],
        	'exclude'                 => true,
            'search'                  => false,
			'filter'                  => false,
        	'sorting'                 => false,
		    'inputType'               => 'multiColumnWizard',
            'eval'      => array(
		        'columnFields' => array(
                    'fax_lang' => array(
						'label'                   => &$GLOBALS['TL_LANG'][$strName]['translations_lang'],
						'exclude'                 => true,
                        'search'                  => false,
            			'filter'                  => false,
                    	'sorting'                 => false,
						'inputType'               => 'select',
						'eval'                    => array(
                            'style'=>'width:100%;',
                            'chosen'=>true,
                            'tl_class'=>'w30'
                        ),
                        'options_callback'        => array('ixtensa\EmployeeBundle\dca\tl_ixe_employeedata\tl_ixe_employeedata', 'getLanguageOptions'),
                        'load_callback'			  => array(array('ixtensa\EmployeeBundle\dca\tl_ixe_employeedata\tl_ixe_employeedata', 'setLangDefault'))
					),
                    'fax_content' => array(
                    	'label'                   => &$GLOBALS['TL_LANG'][$strName]['fax_content'],
                    	'exclude'                 => true,
                    	'search'                  => false,
                        'sorting'                 => false,
            			'filter'                  => false,
                    	'inputType'               => 'text',
                    	'eval'                    => array(
                            'maxlength'=>64,
                            'decodeEntities'=>true,
                            'tl_class'=>'w30'
                        )
                    ),
                    'faxLinktext' => array(
                        'label'                   => &$GLOBALS['TL_LANG'][$strName]['faxLinktext'],
                    	'exclude'                 => true,
                        'search'                  => true,
                    	'sorting'                 => false,
            			'filter'                  => false,
                    	'inputType'               => 'text',
                    	'eval'                    => array(
                            'maxlength'=>255,
                            'preserveTags'=>true,
                            'tl_class'=>'w30'
                        )
                    ),
		        ),
		    ),
		    'sql'       => 'blob NULL',
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
                    'email_lang' => array(
						'label'                   => &$GLOBALS['TL_LANG'][$strName]['translations_lang'],
						'exclude'                 => true,
                        'search'                  => false,
            			'filter'                  => false,
                    	'sorting'                 => false,
						'inputType'               => 'select',
						'eval'                    => array(
                            'style'=>'width:100%;',
                            'chosen'=>true,
                            'tl_class'=>'w30'
                        ),
                        'options_callback'        => array('ixtensa\EmployeeBundle\dca\tl_ixe_employeedata\tl_ixe_employeedata', 'getLanguageOptions'),
                        'load_callback'			  => array(array('ixtensa\EmployeeBundle\dca\tl_ixe_employeedata\tl_ixe_employeedata', 'setLangDefault'))
					),
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
                            'tl_class'=>'w30'
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
                            'tl_class'=>'w30'
                        )
                    ),
		        ),
		    ),
		    'sql'       => 'blob NULL',
        ),
        'addDepartement' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['addDepartement'],
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
        'departementCheckList' => array(
			'label'                   => &$GLOBALS['TL_LANG'][$strName]['departementCheckList'],
			'exclude'                 => true,
			'search'                  => true,
            'sorting'                 => true,
			'filter'                  => true,
            'flag'                    => 1,
            'inputType'               => 'EmployeeBundleCheckboxes',
            'foreignKey'              => 'tl_ixe_departement.departement_overview',
            'eval'                    => array(
                'feEditable'=>true,
                'feViewable'=>true,
                'feGroup'=>'qualifications',
                'multiple'=>true,
                'tl_class'=>'clr'
            ),
			'sql'                     => "blob NULL"
		),
        'addLocation' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['addLocation'],
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
        'locationCheckList' => array(
			'label'                   => &$GLOBALS['TL_LANG'][$strName]['locationCheckList'],
			'exclude'                 => true,
			'search'                  => true,
            'sorting'                 => true,
			'filter'                  => true,
            'flag'                    => 1,
            'inputType'               => 'EmployeeBundleCheckboxes',
            'foreignKey'              => 'tl_ixe_locationdata.name',
            'eval'                    => array(
                'feEditable'=>true,
                'feViewable'=>true,
                'feGroup'=>'qualifications',
                'multiple'=>true,
                'tl_class'=>'clr'
            ),
			'sql'                     => "blob NULL"
		),
        'jobtitle' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['jobtitle'],
        	'exclude'                 => true,
            'search'                  => false,
			'filter'                  => false,
        	'sorting'                 => false,
		    'inputType'               => 'multiColumnWizard',
            'eval'      => array(
		        'columnFields' => array(
                    'jobtitle_lang' => array(
						'label'                   => &$GLOBALS['TL_LANG'][$strName]['translations_lang'],
						'exclude'                 => true,
                        'search'                  => false,
            			'filter'                  => false,
                    	'sorting'                 => false,
						'inputType'               => 'select',
						'eval'                    => array(
                            'style'=>'width:100%;',
                            'chosen'=>true,
                            'tl_class'=>'w45'
                        ),
                        'options_callback'        => array('ixtensa\EmployeeBundle\dca\tl_ixe_employeedata\tl_ixe_employeedata', 'getLanguageOptions'),
                        'load_callback'			  => array(array('ixtensa\EmployeeBundle\dca\tl_ixe_employeedata\tl_ixe_employeedata', 'setLangDefault'))
					),
                    'jobtitle_content' => array(
                        'label'                   => &$GLOBALS['TL_LANG'][$strName]['jobtitle_content'],
                    	'exclude'                 => true,
                        'search'                  => true,
                    	'sorting'                 => false,
            			'filter'                  => false,
                    	'inputType'               => 'text',
                    	'eval'                    => array(
                            'maxlength'=>255,
                            'preserveTags'=>true,
                            'tl_class'=>'w45'
                        ),
                    	'sql'                     => "varchar(255) NOT NULL default ''"
                    ),
		        ),
		    ),
		    'sql'       => 'blob NULL',
        ),
        'text' => array(
        	'label'                   => &$GLOBALS['TL_LANG'][$strName]['text'],
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
        'sortingIndex' => array(
        	'label'                   => &$GLOBALS['TL_LANG'][$strName]['sortingIndex'],
        	'exclude'                 => true,
			'search'                  => false,
			'sorting'                 => false,
			'filter'                  => false,
        	'inputType'               => 'text',
        	'eval'                    => array(
                'maxlength'=>100,
                'rgxp'=>'natural',
                'tl_class'=>'w50'
            ),
        	'sql'                     => "int(100) unsigned NOT NULL default '0'"
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

class tl_ixe_employeedata extends \Backend
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
		if (!$this->User->hasAccess('tl_ixe_employeedata::published', 'alexf'))
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

        $strName = 'tl_ixe_employeedata';

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
			$objRow = $this->Database->prepare("SELECT * FROM tl_ixe_employeedata WHERE id=?")
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

		$this->Database->prepare("UPDATE tl_ixe_employeedata SET tstamp=$time, published='" . ($blnVisible ? '1' : '') . "' WHERE id=?")
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

    // get language options
    public function getLanguageOptions()
	{
		return Intl::getLanguageBundle()->getLanguageNames();
	}

    // set default language
    public function setLangDefault($varValue, MultiColumnWizard $mcw)
    {
        return (empty($varValue) ? 'de' : $varValue);
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
