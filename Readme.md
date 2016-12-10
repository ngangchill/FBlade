## Ngangchill\Blade

This is a standalone package for laravel blade with some extra function such as partial, some usefull directives
& extensions.I have created this library from scretch. I merged some library found in github.So special creadits goes them.Thanks for using.

### use:

Use Ngangchill\Blade\Blade;

    $pathsToTemplates = __DIR__ . '/views';
    $pathToCompiledTemplates = __DIR__ . '/compiled';
    //fire laravel blade
    Blade::fire($pathsToTemplates, $pathToCompiledTemplates);


## You did it ..... lets rocks... 
    
    
    $data['name'] = 'Skyfall';

    echo View::make('index', $data)->render();
    
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

## Directives:

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
    
## Extensions

    @macro()

