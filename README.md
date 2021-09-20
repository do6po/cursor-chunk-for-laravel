An easy way to get chunked data from database by cursor functional.

## Installation

The package can be installed via composer:

``` bash
composer require do6po/laravel-cursor-chunk
```

If you are using Laravel version &lt;= 5.4
or [the package discovery](https://laravel.com/docs/5.5/packages#package-discovery)
is disabled, add the following providers in `config/app.php`:

```php
'providers' => [
    Do6po\LaravelCursorChunk\Providers\CursorChunkServiceProvider::class,
]
``` 

## Using

```php
    $builder = User::query();
    //... some code with builder
    foreach ($builder->cursorChunk() as $users) {
        //some action with $users
    }
```

```php
    use Illuminate\Database\Eloquent\Collection;
    
    $builder = User::query();
    //... some code with builder
    $action = fn(Collection $users, User $user) => $users->put($user->getKey(), $user); 
    foreach ($builder->cursorChunk(1000, $action) as $users) {
        //some action with $users, chunked by 1000 models and key by id 
    }
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.