<?php
namespace DevExtreme;

class LoadHelper {
    public static function LoadModule($className) {
        $namespaceNamePos = strpos($className, __NAMESPACE__);
        error_log($className,0);
        if ($namespaceNamePos === 0) {
            $subFolderPath = substr($className, $namespaceNamePos + strlen(__NAMESPACE__));
            error_log( " subFolderPath=".$subFolderPath,0);
            $filePath = __DIR__.str_replace("\\", DIRECTORY_SEPARATOR, $subFolderPath).".php";
            require_once($filePath); 
        }
    }
}