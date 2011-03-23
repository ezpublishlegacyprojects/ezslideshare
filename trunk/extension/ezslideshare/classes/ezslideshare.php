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

/**
 * File containing the eZSlideshare class.
 *
 * @package eZSlideshare
 * @version //autogentag//
 */
class eZSlideshare
{
    const DEFAULT_HEIGHT = 355,
          DEFAULT_WIDTH  = 425;

    protected static $apiUrls = array(
        'get_slideshow' => 'http://www.slideshare.net/api/2/get_slideshow'
                                     );

    /**
     * Used to retrieve the embed code for a slideshare presentation. Relies on
     * slideshare's API, more details here : http://www.slideshare.net/developers/documentation#get_slideshow
     *
     * @see http://www.slideshare.net/developers/documentation#get_slideshow
     *
     * @param array $presentationIds For now has to be an associative array, the key of which
     *                               is 'url', containing the full URL to a slideshare presentation.
     *                               example : http://www.slideshare.net/pmd06c/exploring-privatecollective-business-models
     * @return string The well-formed HTML embed code, false if anything goes wrong.
     */
    public static function getEmbedCode( array $presentationInformation )
    {
        $baseUrl = static::getUrlBase( 'get_slideshow' );
        $baseUrl .= "&slideshow_url={$presentationInformation['url']}";

        if ( ( $response = eZHTTPTool::getDataByURL( $baseUrl ) ) !== false )
        {
            $xml = simplexml_load_string( $response );
            $embedCode = $xml->Embed . '';

            if ( isset( $presentationInformation['height'] ) or isset( $presentationInformation['width'] )  )
            {
                if ( isset( $presentationInformation['width'] ) )
                    $embedCode = str_replace( 'width="' . self::DEFAULT_WIDTH . '"', 'width="' . $presentationInformation['width'] . '"', $embedCode );

                if ( isset( $presentationInformation['height'] ) )
                    $embedCode = str_replace( 'height="' . self::DEFAULT_HEIGHT . '"', 'height="' . $presentationInformation['height'] . '"', $embedCode );
            }

            return $embedCode;
        }
        else
            return false;
    }

    /**
     * Creates the URL base for the given function
     *
     * @param string $function The API function used
     * @return The well-formed URL base for the given function, false if anything goes wrong
     */
    protected static function getUrlBase( $function )
    {
        if ( !isset( static::$apiUrls[$function] ) )
            return false;

        // Standard, cross-request mandatory parameters
        $apiKey = eZINI::instance( 'ezslideshare.ini' )->variable( 'SlideshareAPISettings', 'APIKey' );
        $timestamp = time();
        $hash = sha1( eZINI::instance( 'ezslideshare.ini' )->variable( 'SlideshareAPISettings', 'SharedSecret' ) . $timestamp );
        return static::$apiUrls[$function] . "?api_key=$apiKey&ts=$timestamp&hash=$hash";
    }
}

?>