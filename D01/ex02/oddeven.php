#!/usr/bin/php
<?php
    while (1)
    {
        printf("Enter a number: ");
        if (!($str = fgets(STDIN)))
            exit ;
        $str = trim($str);
        if (!is_numeric($str))
        {
            printf("'%s' is not a number\n", $str);
        }
        else
        {
            if ($str % 2)
                printf("The number %s is odd\n", $str);
            else
                printf("The number %s is even\n", $str);
        }
    }
?>