<?php

namespace Do6po\LaravelCursorChunk\Providers;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class CursorChunkServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Builder::macro(
            'cursorChunk',
            function (int $limit = 500, Closure $action = null) {
                /** @var Builder $this */
                $chunk = $this->getModel()->newCollection();
                foreach ($this->cursor() as $model) {
                    $action
                        ? $action($chunk, $model)
                        : $chunk->push($model);

                    if ($chunk->count() >= $limit) {
                        yield $chunk;

                        $chunk = $this->getModel()->newCollection();
                    }
                }

                yield $chunk;
            }
        );
    }
}
