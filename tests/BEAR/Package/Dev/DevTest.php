<?php
/**
 * This file is part of the BEAR.Package package
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace BEAR\Package\Dev;

use BEAR\Package\Dev\Web\Web;

class DevTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Dev
     */
    private $dev;

    protected function setUp()
    {
        $server = ['REQUEST_URI' => '/dev/'];
        $this->dev = new Dev($server, new Web, 'apache');
    }

    public function testNew()
    {
        $this->assertInstanceOf('BEAR\Package\Dev\Dev', $this->dev);
    }

    public function testWebService()
    {
        $app = require $GLOBALS['_BEAR_PACKAGE_DIR'] . '/apps/Demo.Helloworld/bootstrap/instance.php';
        $appDir = $GLOBALS['_BEAR_PACKAGE_DIR'] . '/apps/Demo.Helloworld';
        $html = $this->dev->setReturnMode()->setApp($app, $appDir)->getDevHtml('/dev/');
        $this->assertContains('Helloworld Dev</title>', $html);
    }
}