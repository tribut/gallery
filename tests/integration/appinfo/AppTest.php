<?php
/**
 * Nextcloud - Gallery
 *
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Olivier Paroz <galleryapps@oparoz.com>
 *
 * @copyright Olivier Paroz 2017
 */

namespace OCA\Gallery\Tests\Integration\AppInfo;

use \OCP\App;

/**
 * Class AppTest
 *
 * @package OCA\Gallery\Tests\Integration\AppInfo
 */
class AppTest extends \OCA\Gallery\Tests\Integration\GalleryIntegrationTest {

	public function testAppInstalled() {
		$appManager = $this->container->query('OCP\App\IAppManager');
		$this->assertTrue($appManager->isInstalled('gallery'));
	}

	public function testAppName() {
		$appData = App::getAppInfo('gallery');

		$this->assertSame('gallery', $appData['id']);
	}

	public function testAppLicense() {
		$appData = App::getAppInfo('gallery');

		$this->assertSame('AGPL', $appData['licence']);
	}

	public function testAppMaxPhpVersion() {
		$appData = App::getAppInfo('gallery');

		$this->assertSame('7', $appData['dependencies']['php']['@attributes']['max-version']);
	}

	public function testNavigationEntry() {
		$navigationManager = \OC::$server->getNavigationManager();
		$navigationManager->clear();
		$countBefore = count($navigationManager->getAll());
		require __DIR__ . '/../../../appinfo/app.php';
		// Test whether the navigation entry got added
		$this->assertCount($countBefore + 1, $navigationManager->getAll());
	}
}
