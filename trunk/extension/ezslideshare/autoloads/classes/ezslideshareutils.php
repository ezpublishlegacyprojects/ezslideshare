<?php
//
// eZ Slideshare - extension for eZ Publish
// Author: Nicolas Pastorino <nfrp@ez.no>
// Copyright (C) 2011 eZ Systems AS, http://ez.no/
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of version 2.0 of the GNU General
// Public License as published by the Free Software Foundation.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
// MA 02110-1301, USA.
//

class eZSlideshareUtils
{
    private $OperatorName = false;

    function __construct()
    {
        $this->OperatorName = 'slideshare_embed_code';
    }

    function operatorList()
    {
        return array( $this->OperatorName );
    }

    function namedParameterPerOperator()
    {
        return true;
    }

    function namedParameterList()
    {
        return array(
            $this->OperatorName => array(
                'presentation_url' => array(
                    'type' => 'string',
                    'required' => true,
                    'default' => false
                ),
                'width' => array(
                    'type' => 'integer',
                    'required' => false,
                    'default' => 587
                ),
                'height' => array(
                    'type' => 'integer',
                    'required' => false,
                    'default' => 455
                ),
            ),
        );
    }

    function modify( $tpl, $operatorName, $operatorParameters, $rootNamespace,
                     $currentNamespace, &$operatorValue, $namedParameters )
    {
        $operatorValue = eZSlideshare::getEmbedCode( array( 'url'    => $namedParameters['presentation_url'],
                                                            'width'  => $namedParameters['width'],
                                                            'height' => $namedParameters['height'] ) );
    }


/*
    function operatorTemplateHints()
    {
        return array( $this->OperatorName => array( 'parameters' => true,
                                                    'input' => true,
                                                    'output' => true,
                                                    'element-transformation' => true,
                                                    'transform-parameters' => true,
                                                    'input-as-parameter' => 'always',
                                                    'element-transformation-func' => 'transformation' ) );
    }

    function transformation( $operatorName, $node, $tpl, $resourceData,
                             $element, $lastElement, $elementList, $elementTree, $parameters )
    {
        if ( isset( $parameters[1] ) )
        {
            $newElements[] = eZTemplateNodeTool::createCodePieceElement( "%output% = CommunityBlogs::blog( %2% );\n", $parameters );
        }
        else
        {
            $newElements[] = eZTemplateNodeTool::createCodePieceElement( "%output% = CommunityBlogs::blog();\n", $parameters );
        }
        return $newElements;
    }
*/
}

?>
