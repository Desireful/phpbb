<?php
/**
* This file is part of phpBB
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* any later version accepted by phpBB Ltd. in accordance with section
* 14 of the GNU General Public License.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.

* @package   phpBB
* @author    Nils Adermann <naderman@phpbb.com>
* @copyright 2010 phpBB Ltd.
* @license   http://www.gnu.org/licenses/gpl.txt
*            GNU General Public License
* @version   Release: @package_version@
*/

// set up include path
set_include_path(
    // included libraries
    __DIR__ . '/lib/' . PATH_SEPARATOR
    // original include path
    . get_include_path() . PATH_SEPARATOR
);


if (!defined('PHP_EXT'))
{
    define('PHP_EXT', strrchr(__FILE__, '.'));
}

require 'SplClassLoader' . PHP_EXT;

// phpBB's autoloader
$phpBBClassLoader = new SplClassLoader('phpBB');
$phpBBClassLoader->setFileExtension(PHP_EXT);
$phpBBClassLoader->register();
// symfony autoloader
$symfonyClassLoader = new SplClassLoader('Symfony', 'symfony/src/');
$symfonyClassLoader->setFileExtension(PHP_EXT);
$symfonyClassLoader->register();

