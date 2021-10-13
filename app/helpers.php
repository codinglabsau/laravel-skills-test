<?php

if(!function_exists('getTempName'))
{
    function getTempName($path, $extension, $includepath=false) {
        do {
            $temp_file= $path . str_replace([' ', '.'], '_', microtime()) . '.' . $extension;
        } while(file_exists($temp_file));
        if($includepath)
            return $temp_file;
        else
            return basename($temp_file);
    }
}

