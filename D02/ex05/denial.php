#!/usr/bin/php
<?php
    if($argc == 3 && file_exists($argv[1]))
    {
        $fp = fopen($argv[1], 'r');
        while($fp && !feof($fp))
        {
            $content = fgets($fp);
            $arr[] = explode(";", $content);
        }
        $format = $arr[0];
        unset($arr[0]);
        //print_r($arr);
        //print_r($format);
        foreach ($format as $k => $v)
            $format[$k] = trim($v);
        $keynumber = array_search($argv[2], $format); //search an array for a value and returns the key.
        if($keynumber == FALSE)
            exit();
      
        foreach($format as $key => $value)
        {
            $temp = [];
            foreach ($arr as $val)
            {
                if(isset($val[$keynumber]))
                    $temp[trim($val[$keynumber])] = trim($val[$key]);
            }
            $$value = $temp;
        }
        while(1)
        {
            echo ("Enter your command: ");
            $command = fgets(STDIN);
            if($command)
                eval($command); //Evaluate a string as PHP code
            else
                break;
        }
        print("\n");
    }
?>