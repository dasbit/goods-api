<?php
if ( ! function_exists('config_path'))
{
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}
//
//if (! function_exists('dd')) {
//    /**
//     * Dump the passed variables and end the script.
//     *
//     * @param  mixed  $args
//     * @return void
//     */
//    function dd(...$args)
//    {
//        header('Access-Control-Allow-Origin: *');
//        header('Access-Control-Allow-Methods: *');
//        header('Access-Control-Allow-Headers: *');
//        http_response_code(500);
//
//        foreach ($args as $x) {
//            (new \Symfony\Component\VarDumper\VarDumper())->dump($x);
//        }
//
//        die(1);
//    }
//}
