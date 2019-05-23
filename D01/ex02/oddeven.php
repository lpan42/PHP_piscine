#!/usr/bin/php
<?php
    while (1)
    {
        print("Enter a number: ");
        if (!($str = fgets(STDIN)))
            exit ;
        $str = trim($str);
        if (!is_numeric($str))
        {
            print("'$str' is not a number\n");
        }
        else
        {
            if ($str % 2)
                print("The number $str is odd\n");
            else
                print("The number $str is even\n");
        }
    }
?>
