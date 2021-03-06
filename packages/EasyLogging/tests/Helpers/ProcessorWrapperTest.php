<?php

declare(strict_types=1);

namespace EonX\EasyLogging\Tests\Helpers;

use EonX\EasyLogging\Helpers\ProcessorWrapper;
use EonX\EasyLogging\Tests\AbstractTestCase;
use EonX\EasyLogging\Tests\Stubs\InvokableStub;

final class ProcessorWrapperTest extends AbstractTestCase
{
    /**
     * @return iterable<mixed>
     *
     * @see testInvoke
     */
    public function providerTestInvoke(): iterable
    {
        yield 'Using closure' => [function (array $records): array {
            return $records;
        }];

        yield 'Using object with __invoke method' => [new InvokableStub()];
    }

    /**
     * @dataProvider providerTestInvoke
     */
    public function testInvoke(callable $wrapped): void
    {
        $wrapper = ProcessorWrapper::wrap($wrapped);
        $array = [
            'key' => 'value',
        ];

        self::assertEquals($array, $wrapper($array));
    }
}
