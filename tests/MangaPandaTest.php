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
    // public function testCanMakeObject(): void
    // {
    //     $panda = new MangaPanda();
    //     $panda->download("sas", 142, __DIR__ . "/up/");
    //     $this->assertTrue(true);
    //     var_dump($panda->get_error());
    // }
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

    public function testCanTry(): void
    {
        $decider = false;
        $i = 0;
        try {
            if ($i < 3) {
                throw new Exception();
            }
        } catch (Exception $e) {
            $i++;

            for ($k = 0; $k < 4; $k++) {
                try {
                    if ($i < 3) {
                        throw new Exception();
                    } else {
                        $decider = true;
                        break;
                    }
                } catch (Exception $e) {
                    $i++;

                    if ($k == 4) {
                        $decider = false;
                    }
                }
            }
        }
        var_dump($decider);
        $this->assertTrue($decider);
    }
}
