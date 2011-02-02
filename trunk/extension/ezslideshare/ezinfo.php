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

class ezslideshareInfo
{
    static function info()
    {
        $eZCopyrightString = 'Copyright (C) 1999-2011 eZ Systems AS';

        return array( 'Name'      => '<a href="http://projects.ez.no/ezslideshare">eZ Slideshare</a> extension',
                      'Version'   => '1.0',
                      'Author'    => '<a href="http://share.ez.no/community/profile/9804">Nicolas Pastorino</a>',
                      'Copyright' => $eZCopyrightString,
                      'License'   => 'GNU General Public License v2.0'
                    );
    }
}

?>
