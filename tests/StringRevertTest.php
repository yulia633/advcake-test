<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

use function App\StringRevert\revertCharacters;

class StringRevertTest extends TestCase
{
    public function addDataProvider()
    {
        return [
            ["Тевирп! Онвад ен ьсиледив.", "Привет! Давно не виделись."],
            [" ", " "],
            ["Olleh! Era uoy.", "Hello! Are you."],
            ["DlrowolleH11!", "11Helloworld!"],
        ];
    }

    /**
     * @dataProvider addDataProvider
     */
    public function testRevertString($list1, $expected)
    {
        $result = revertCharacters($list1);
        $this->assertSame($expected, $result);
      //  $this->assertEquals($expected, $result);
    }
}
