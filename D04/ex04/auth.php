<?php
    function auth($login, $passwd)
    {
        $path = "../private/passwd";
        if(!$login || !$passwd)
            return(FALSE);
        $file = file_get_contents($path);
        $arr = unserialize($file);
        if($arr)
        {
            foreach($arr as $key => $value)
            {
                if(($value["login"] == $login) && ($value["passwd"] == hash("sha256", $passwd)))
                    return(TRUE);
            }
        }
       return(FALSE);
    }
?>