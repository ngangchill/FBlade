<?php 
namespace Ngangchill\Blade;

use Illuminate\Container\Container;
use Illuminate\Support\Fluent;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade as BaseBlade;

class Blade
{
    /**
     * $app.
     *
     * @var \Illuminate\Container\Container
     */
    public $app;
    
    /**
     * $aliases.
     *
     * @var array
     */
    public $aliases = [
        'View' => View::class,
        'BladeFacades' => BaseBlade::class,
    ];
   
    /**
     * __construct.
     *
     * @method __construct
     */
    public function __construct()
    {
        $this->app = new Container();
        
        $this->app->singleton('config', function() {
            return new Fluent();
        });
        
        $this->app->singleton('events', function () {
            return new Dispatcher();
        });
        
        $this->app->singleton('files', function () {
            return new Filesystem;
        });
        
        Facade::setFacadeApplication($this->app);
 
        foreach ($this->aliases as $alias => $class) {
            if (class_exists($alias) === true) {
                continue;
            }
            class_alias($class, $alias);
        }
    }
    
    /**
     * setPaths.
     *
     * @method setPaths
     *
     * @param string $viewPath
     * @param string $compiledPath
     *
     * @return mixed
     */
    public function setPaths($viewPath, $compiledPath)
    {  
        
        $this->app['config']['view.paths'] = is_array($viewPath) ? $viewPath : [$viewPath];
        $this->app['config']['view.compiled'] = $compiledPath;
        
        $viewServiceProvider = new ViewServiceProvider($this->app);
        $viewServiceProvider->register();
        if (method_exists($viewServiceProvider, 'boot') === true) {
            $this->app->call([$viewServiceProvider, 'boot']);
        }
        return $this;
    }
    /**
     * fire.
     *
     * @method static fire
     *
     * @param string $viewPath
     * @param string $compiledPath
     *
     * @return static
     */
    public static function fire($viewPath, $compiledPath)
    {
        (new Blade())->setPaths($viewPath, $compiledPath);
    }
}