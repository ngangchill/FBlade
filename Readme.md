## Ngangchill\Blade

This is a standalone package for laravel blade with some extra function such as partial, some usefull directives
& extensions.I have created this library from scretch. I merged some library found in github.So special creadits goes them.Thanks for using.

### use:

Use Ngangchill\Blade\Blade;

    $pathsToTemplates = __DIR__ . '/views';
    $pathToCompiledTemplates = __DIR__ . '/compiled';
    //fire laravel blade
    Blade::fire($pathsToTemplates, $pathToCompiledTemplates);


## You did it ..... lets rocks... :1+:
    
    
    $data['name'] = 'Skyfall';

    echo View::make('index', $data)->render();
    
## [Read More on laravel.com](https://laravel.com/docs/5.3/blade)
   