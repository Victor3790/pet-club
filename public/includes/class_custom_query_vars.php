<?php

if(!class_exists('Custom_Query_Vars'))
{
    class Custom_Query_Vars
    {
        function set_vars( $vars )
        {

            $vars[] = 'search_id';
            $vars[] = 'service';
            $vars[] = 'dog';
            $vars[] = 'cat';
            $vars[] = 'region';
          
            return $vars;
        }
    }
}