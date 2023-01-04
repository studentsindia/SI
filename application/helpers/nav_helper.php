<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if ( ! function_exists('active_link'))
{
    function active_link($controller)
    {
        $CI = &get_instance();
         
       echo  $class = $CI->router->fetch_class();
 
        return ($class == $controller) ? 'active' : '';
    }
}
?>