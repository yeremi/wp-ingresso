<?php

declare(strict_types=1);

namespace Yeremi\Ingresso\Tests\Rector\SkipDummyDateObjectPropertyRector;

use Iterator;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class SkipDummyDateObjectPropertyRectorTest extends AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(string $filePath): void
    {
        $this->doTestFile($filePath);
    }

    public static function provideData(): Iterator
    {
        yield 'SomeClass' => [__DIR__ . '/Fixture/SomeClass.php.inc'];
        yield 'AnotherClass' => [__DIR__ . '/Fixture/AnotherClass.php.inc'];
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/Config/configured_rule.php';
    }
}
