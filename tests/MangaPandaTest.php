<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

use MangaCrawlers\MangaPanda;
final class MangaPandaTest extends TestCase
{
    public function testCanMakeObject(): void
    {
        $panda = new MangaPanda();
        $panda->download("bleach", 3, __DIR__ . "/up/");
        $this->assertTrue(true);
    }
}
