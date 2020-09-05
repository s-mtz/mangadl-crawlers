<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

use MangaCrawlers\MangaPanda;
final class MangaPandaTest extends TestCase
{
    // public function testCanMakeObject(): void
    // {
    //     $panda = new MangaPanda();
    //     $panda->download("bleache", 2, __DIR__ . "/up/");
    //     $this->assertTrue(true);
    //     var_dump($panda->get_error());
    // }
    //
    public function testCanMakeObject(): void
    {
        $panda = new MangaPanda();
        $panda->download("sas", 142, __DIR__ . "/up/");
        $this->assertTrue(true);
        var_dump($panda->get_error());
    }
    //
    // public function testCanMakeObject(): void
    // {
    //     $panda = new MangaPanda();
    //     $panda->download("oyasumi-punpun", "asf" , __DIR__ . "/up/");
    //     $this->assertTrue(true);
    //     var_dump($panda->get_error());
    // }
    //
    // public function testCanMakeObject(): void
    // {
    //     $panda = new MangaPanda();
    //     $panda->download("oyasumi-punpun", 142, 20);
    //     $this->assertTrue(true);
    //     var_dump($panda->get_error());
    // }
    //
    // public function testCanMakeObject(): void
    // {
    //     $panda = new MangaPanda();
    //     $panda->download("oyasumi-punpun", 141, __DIR__ . "/up/");
    //     $this->assertTrue(true);
    //     var_dump($panda->get_error());
    // }
}
