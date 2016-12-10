<?php
namespace Ngangchill\Blade;
/**
 *  Backward compatibility
 *  get some deprecated functions
 *  createMatcher()
 *  createOpenMatcher()
 *  createPlainMatcher()
 */
use Illuminate\View\Compilers\BladeCompiler as BaseCompiler;

class BladeCompiler extends BaseCompiler
{

	public function __construct($files, $cachePath) {
        parent::__construct($files, $cachePath);
        $this->compilers[] = 'Minify';
        $this->_extraStaffs();
    }

	/**
	 * Get the regular expression for a generic Blade function.
	 *
	 * @param  string  $function
	 * @return string
	 */
	public function createMatcher($function)
	{
		return '/(?<!\w)(\s*)@'.$function.'(\s*\(.*\))/';
	}

	/**
	 * Get the regular expression for a generic Blade function.
	 *
	 * @param  string  $function
	 * @return string
	 */
	public function createOpenMatcher($function)
	{
		return '/(?<!\w)(\s*)@'.$function.'(\s*\(.*)\)/';
	}

	/**
	 * Create a plain Blade matcher.
	 *
	 * @param  string  $function
	 * @return string
	 */
	public function createPlainMatcher($function)
	{
		return '/(?<!\w)(\s*)@'.$function.'(\s*)/';
	}

    public function shouldMinify($value) {
        if (preg_match('/<(pre|textarea)/', $value) || preg_match('/<script[^\??>]*>[^<\/script>]/', $value) || preg_match('/value=("|\')(.*)([ ]{2,})(.*)("|\')/', $value)
           ) {
            return false;
        } else {
            return true;
        }
    }
    protected function compileMinify($value) {
        if ($this->shouldMinify($value)) {
            $replace = array(
                '/<!--[^\[](.*?)[^\]]-->/s' => '',
                "/<\?php/" => '<?php ',
                "/\n([\S])/"    => ' $1',
                "/\n/" => '',
                "/\r/" => '',
                "/\t/" => ' ',
                "/ +/" => ' ',
                //'#^\s*//.+$#m' => '', // remove single comment in JS
            );
            return preg_replace(
                array_keys($replace), array_values($replace), $value
            );
        } else {
            return $value;
        }
    }
    
    /**
    *
    * Register extra directives & extensions
    *
    */
    public function _extraStaffs()
    {
        // get all directives to register
        $directives = require 'extras/directives.php';

        if(count($directives))
        {
            foreach ($directives as $name => $function) {
                $this->directive($name, $function);
            }
        }
        // get all extension to register
        $extensions = require 'extras/extensions.php';
        if (count($extensions)) {
            foreach ($extensions as $name => $function) {
                $this->extend($function);
            }
        }
    }
}
