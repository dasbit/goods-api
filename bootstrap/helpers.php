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


if(!function_exists('generateUniqueField')){
    /**
     * Generate unique value for model field
     *
     * @param string $table
     * @param string $field
     * @param callable $value_generator
     * @return mixed
     */
    function generateUniqueField(string $table, string $field, callable $value_generator){
        $value = $value_generator();
        while (DB::table($table)->select($field)->where($field, '=', $value)->count() > 0){
            $value = $value_generator();
        }
        return $value;
    }
}
