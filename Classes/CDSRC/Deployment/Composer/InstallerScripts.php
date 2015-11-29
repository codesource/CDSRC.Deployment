<?php
namespace CDSRC\Deployment\Composer;

/* **********************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Matthias Toscanelli <m.toscanelli@code-source.ch>
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 * ******************************************************************** */

use Composer\Script\CommandEvent;
use TYPO3\Flow\Utility\Files;

/**
 * Class for Composer install scripts
 */
class InstallerScripts {

	/**
	 * Make sure required paths and files are available outside of Package
	 * Run on every Composer install or update - most be configured in root manifest
	 *
	 * @param CommandEvent $event
	 * @return void
	 */
	static public function postUpdateAndInstall(CommandEvent $event) {
		chmod ('Packages/Framework/TYPO3.Flow/Scripts/setfilepermissions.sh', 0755);
		exec('./flow doctrine:migrate');
		exec('./flow flow:core:setfilepermissions root www-data www-data');
	}
}
