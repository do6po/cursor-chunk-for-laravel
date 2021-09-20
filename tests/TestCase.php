<?php

namespace Do6po\LaravelCursorChunk\Tests;

use Do6po\LaravelCursorChunk\Providers\CursorChunkServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            CursorChunkServiceProvider::class,
        ];
    }
}
