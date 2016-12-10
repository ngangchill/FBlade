<?php

return [
    'explode' => function ($expression) {
        list($delimiter, $string) = explode(', ', str_replace(['(', ')'], '', $expression));
        return "<?php echo explode({$delimiter}, {$string}); ?>";
    },
    'implode' => function ($expression) {
        list($delimiter, $array) = explode(', ', str_replace(['(', ')'], '', $expression));
        return "<?php echo implode({$delimiter}, {$array}); ?>";
    },
    'dd' => function ($expression) {
        return "<?php dd({$expression}); ?>";
    },
    'dump' => function ($data) {
        return sprintf("<?php (new Illuminate\Support\Debug\Dumper)->dump(%s); ?>",
            null !== $data ? $data : "get_defined_vars()['__data']"
        );
    },
    // Parse the given date and time and format it as in a format given in config
    'datetime'   => function ($expression) {

        preg_match_all('/\((.*?)\)/i', $expression, $matches);

        $match = $matches[1][0];

        $format = 'jS F Y, g:i a';

        $output = "<?php echo \Carbon\Carbon::parse($match)->format('$format'); ?>";

        return $output;
    },
    // Parse the given date and format it as in a format given in config
    'date' => function ($expression) {

        preg_match_all('/\((.*?)\)/i', $expression, $matches);

        $match = $matches[1][0];

        //$format = config('app.date_format');
        $format = 'jS F Y';

        $output = "<?php echo \Carbon\Carbon::parse($match)->format('$format'); ?>";

        return $output;
    },
    /* Parse the given date and time and format it as in a format given in config */
    'time' => function ($expression) {

        preg_match_all('/\((.*?)\)/i', $expression, $matches);

        $match = $matches[1][0];

        $format = 'g:i a';

        $output = "<?php echo \Carbon\Carbon::parse($match)->format('$format'); ?>";

        return $output;
    },
    /* Add 'use' directive for a particular class*/
    'use' => function ($parameter) {

        $parameter = trim($parameter, "()");
        return "<?php use {$parameter}; ?>";
    },
    /* Add 'namespace' directive for a particular class*/
    'namespace' => function ($parameter) {

        $parameter = trim($parameter, "()");
        return "<?php namespace {$parameter}; ?>";
    },
    'fa' => function ($expression) {
        return sprintf('<i class="fa fa-%s"></i>', trim($expression, "'"));
    },
];