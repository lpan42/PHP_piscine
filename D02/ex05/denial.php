#!/usr/bin/php
<?php
    if($argc == 3 && file_exists($argv[1]))
    {
        $fp = fopen($argv[1], 'r');
        while($fp && !feof($fp))
        {
            $content = fgets($fp);
            //print_r($content);
            $arr[] = explode(";", $content);
        }
        $format = $arr[0];
        unset($arr[0]);
        //print_r($arr);
        foreach ($format as $key => $value)
            $format[$key] = trim($value);
        //print_r($format);
        $keynumber = array_search($argv[2], $format); //search an array for a value and returns the key.
        //print_r($keynumber);
        if($keynumber == FALSE)
            exit();
        foreach($format as $key => $value)
        {
            $temp = array();
            foreach ($arr as $val)
            {
                if(isset($val[$keynumber])){
                    print_r($val[$key]);
                }
                    $temp[trim($val[$keynumber])] = trim($val[$key]);
            }
            $$value = $temp;
           // print_r($$value);
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
    }?>