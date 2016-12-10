<?php
return[
	'macro' => function($view, $_null) {

        $pattern = '/@macro\s*\(\'(\w+)\'(\s*,\s*(.[^\n]*))?\)/';

        while (preg_match($pattern, $view, $matches)) {

            $code = "<?php function {$matches[1]}";

            // arguments
            if (!isset($matches[3])) {
                $code .= "()";
            } else {
                $code .= "(" . $matches[3] . ")";
            }

            $code .= " { ob_start(); ?" . ">";

            $view = preg_replace($pattern, $code, $view, 1);
        }

        return $view;
    },
    'endmacro' => function($view, $compiler) {
        $pattern = $compiler->createPlainMatcher('endmacro');
        $code = "\n<?php return ob_get_clean(); } ?" . ">\n";
        return preg_replace($pattern, $code, $view);
    },
    'partial' => function($value, $compiler) {
        $pattern = $compiler->createOpenMatcher('partial');
        return preg_replace(
                $pattern, '$1<?php $__env->renderPartial$2, get_defined_vars(), function($file, $vars) use ($__env) {
                $vars = array_except($vars, array(\'__data\', \'__path\'));
                extract($vars); ?>', $value
        );
    },
    'endpartial' => function($value, $compiler) {
        $pattern = $compiler->createPlainMatcher('endpartial');
        return preg_replace($pattern, '$1<?php echo $__env->make($file, $vars)->render(); }); ?>$2', $value);
    },
    'block' => function($value, $compiler) {
        $pattern = $compiler->createMatcher('block');
        return preg_replace($pattern, '$1<?php $__env->startBlock$2; ?>', $value);
    },
    'endblock' => function($value, $compiler) {
        $pattern = $compiler->createPlainMatcher('endblock');
        return preg_replace($pattern, '$1<?php $__env->stopBlock(); ?>$2', $value);
    },
    'renderPartial' => function($value, $compiler) {
        $pattern = $compiler->createMatcher('render');
        return preg_replace($pattern, '$1<?php echo $__env->renderBlock$2; ?>', $value);
    },
];