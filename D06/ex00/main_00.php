<?php

require_once 'Color.class.php';


print( Color::doc() );
Color::$verbose = True;

$red     = new Color( array( 'red' => 0xff, 'green' => 0   , 'blue' => 0    ) );//(255,0,0)ff0000
$green   = new Color( array( 'rgb' => 255 << 8 ) );//(0,255,0) 00ff00
$blue    = new Color( array( 'red' => 0   , 'green' => 0   , 'blue' => 0xff ) );//(0,0,255)0000ff

$yellow  = $red->add( $green );
$cyan    = $green->add( $blue );
$magenta = $blue->add( $red );

$white   = $red->add( $green )->add( $blue );

print($red     . PHP_EOL ); //PHP_EOL: a constant, the EOL sign in the current system.
print($green   . PHP_EOL );
print($blue    . PHP_EOL );
print($yellow  . PHP_EOL );
print($cyan    . PHP_EOL );
print($magenta . PHP_EOL );
print($white   . PHP_EOL );

Color::$verbose = False;

$black = $white->sub( $red )->sub( $green )->sub( $blue );
print( 'Black: ' . $black . PHP_EOL );

Color::$verbose = True;

$darkgrey = new Color( array( 'rgb' => (10 << 16) + (10 << 8) + 10 ) );//(160,160,160)a0a0a0
print( 'darkgrey: ' . $darkgrey . PHP_EOL );
$lightgrey = $darkgrey->mult( 22.5 );//(225,225,225)e1e1e1
print( 'lightgrey: ' . $lightgrey . PHP_EOL );

$random = new Color( array( 'red' => 12.3, 'green' => 31.2, 'blue' => 23.1 ) );//
print( 'random: ' . $random . PHP_EOL );//0c1f17

?>
