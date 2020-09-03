<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

use MangaCrawlers\MangaPanda;
final class MangaPandaTest extends TestCase
{
    public function testCanMakeObject(): void
    {
        $panda = new MangaPanda();
        $this->assertTrue(true);
    }
}
