## Ngangchill\Blade
    
This is a standalone package for laravel blade with some extra function such as partial, some usefull directives
& extensions.Thanks for using.

### use:

    $pathsToTemplates = __DIR__ . '/views';
    $pathToCompiledTemplates = __DIR__ . '/compiled';
    
    //fire laravel blade
    Ngangchill\Blade\Blade::fire($pathsToTemplates, $pathToCompiledTemplates);
    
## ALL DONE done... lets play with laravel **Blade Templates**. Now you can use every Blade functions as documented in laravel bladetemplate docs.

## Example:    
    
    $name = 'Skyfall';

    echo View::make('index', ['name' => $name])->render();
    
    // Add a location to the array of view locations.
    View::addLocation($newPath);
    
    // lets register a new directives
    Blade::directive('hellow', function ($name) {
        return "<?php echo 'Hellow <em>' . $name . '</em>'; ?>";
    });
    
    // For more info read laravel Blade Template Docs 
    
# KEEP IN MIND: *Special situation* [if you want to use Illuminate\Support\Facades\Blade ]
If you initiate blade class Ngangchill\Blade\Blade::fire('viewPath', 'compiledPath') than nothing to worry.
But if you use an use statment for Ngangchill\Blade\Blade class Than you have be carefull to avoid unwanted error by setting an alias for Ngangchill\Blade\Blade class or
 adding a trilling slash '\' before Illuminate\Support\Facades\Blade.See the example below 


To use laravel blade facades call it as -
    
    use Ngangchill\Blade\Blade;
    
    //fire laravel blade
    Blade::fire($pathsToTemplates, $pathToCompiledTemplates);
    
    //Now call **Illuminate\Support\Facades\Blade** as \Blade::()....
    \Blade::directive('datetime', function ($expression) {
        return "<?php echo $expression->format('m/d/Y H:i'); ?>";
    });
    
or 

Set an alias:

    use Ngangchill\Blade\Blade as BaseBlade;
    //then
    BaseBlade::fire(......);
    Blade::directive('datetime', function ($expression) {
        return "<?php echo $expression->format('m/d/Y H:i'); ?>";
    });
    
Otherwise it may throughs unwanted error.   
    
## [Read More on laravel.com](https://laravel.com/docs/5.3/blade)
   
   
## Extra features:

Creating a Partial
------------------
We use the `@render('block-to-render')` directive to render a block of content that was provided via the respective `@block` directive. Note that we can also provide a default value.

```html
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">@render('title', 'Default Title')</h3>
    </div>
    <div class="panel-body">
        @render('body', 'Default Body')
    </div>
</div> 
```

View a Partial
-------------------

Partials start with the `@partial('path.to.view')` directive, which accepts the view you want the partial to extend from, and end with the `@endpartial` directive.

```php
@partial('partials.panel')
    @block('title', 'This is the panel title')

    @block('body')
        This is the panel body.
    @endblock
@endpartial
```

Blocks within partials behave the same way as sections within templates. They capture a piece of data that will be rendered into the extended view.

# Special thanks to **crhayes**

## Available Directives:

    @explode()
    @implode()
    @dd()
    @dump()
    @datetime()
    @date()
    @time()
    @use()
    @namespace()
    @fa()