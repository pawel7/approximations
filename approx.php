<!DOCTYPE html>
<html lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
$lang = isset( $_GET['lang'] ) && $_GET['lang'] == 'pl' ? 'pl' : 'en';
$title =    $lang == 'pl' ? 'Przybliżenia liczb' : 'Approximations of numbers';
$hdr_text = $lang == 'pl' ? 'Przybliżenia liczb algebraicznych i przestępnych' : 'Approximations of algebraic and transcendental numbers';
$p_text = $lang == 'pl' ? 'Kolejne, oraz to lepsze przybliżenia liczb za pomocą ułamków o mianownikach będących kolejnymi liczbami naturalnymi.' : 
'Consecutive, better and better approximations of numbers with fractions with denominators which are successive natural numbers.';
$a_text = $lang == 'pl' ? 'English version' : 'Po polsku';
$a_href = $lang == 'pl' ? '?lang=en' : '?lang=pl';
?>
<title><?= $title ?></title>
  <style media="screen" type="text/css">
	body { background-color:#a0c0b0; }
	p, h1 { text-align: center; }
	pre { margin: 0 auto; width:1040px; }
	.nagl { background-color: #E0D8D0; color:#012;}
	.odd  { background-color: #C0f0D0;}
	.even { background-color: #C0D0f0;}
	.odd:hover, .even:hover  { background-color: #A0E0C0;}
  </style>
</head>
<body>
<h1><?= $hdr_text ?></h1>
<p><?= $p_text ?></p>
<a href="<?= $a_href ?>"><?= $a_text ?></a>
<pre>
<?php
$alfa  = 137.03599907444; 
$alfa1 = 137.03599903791; 
$alfa2 = 137.03599908451;
$alfa3 = 137.03599911;
$random_number = 2.3962610645827138793264;
$random_number2 = 7.1963874952918563207152;

$pi_str='3.141592653589793238462643383279502884197169';
$pi = 3.141592653589793238462643383279502884197169;
$e=2.71828182845904523536028747135266249775724709369995;
$e_str='2.71828182845904523536028747135266249775724709369995';
$fi = (sqrt( 5.0 ) + 1)/2;

$r3_5 = pow( 5.0, 1.0/3 );
$r4_5 = pow( 5.0, 1.0/4 );

$r2_2 = sqrt( 2.0 );
$r3_2 = pow( 2.0, 1.0/3 );
$r4_2 = pow( 2.0, 0.25 );
$r5_2 = pow( 2.0, 0.2 );

$Z0=376.730313461; //characteristic impedance of vacuum
$g = 5.585694713; // proton g factor

$max = 1000*100;
$milion = 1000*1000;

//Approximations( $r3_5, $max, '5<sup>1/3</sup>' );
//Approximations( $r4_5, $max, '5<sup>1/4</sup>' );

$name = $lang == 'pl' ? 'Złoty podział' :  'Golden ratio';
$name .= ', &phi; = ( 1 + &radic;<span style="text-decoration:overline;">5</span> ) / 2';
Approximations( $fi, $max, $name);

Approximations( $r2_2, $max, '2<sup>1/2</sup>' );
Approximations( $r3_2, $max, '2<sup>1/3</sup>' );
//Approximations( $r4_2, $max, '2<sup>1/4</sup>' );
//Approximations( $r5_2, $max, '2<sup>1/5</sup>' );
                                        
Approximations( $pi, $milion, '&pi;', $pi_str );
Approximations( $e, $milion, 'e', $e_str );

Approximations( $alfa,  $max, 'alpha' );
Approximations( $alfa1, $max, 'alpha1' );
//Approximations( $alfa2, $max, 'alpha2' );
//Approximations( $alfa3, $max, 'alpha3' );
Approximations( $Z0, $max, 'characteristic impedance of vacuum (Z0)' );
Approximations( $g, $max, 'proton g factor' );

Approximations( $random_number, $max, 'A random number' );
Approximations( $random_number2, $max, 'Another random number' );

function Approximations( $liczba, $max, $nazwa, $dokladniej='' )
{
	$lang = isset( $_GET['lang'] ) && $_GET['lang'] == 'pl' ? 'pl' : 'en';
	$str = $lang == 'pl' ? ', dokładniej = ' : ', more precise = ';
	$dokl = ( $dokladniej != '' ) ? $str.$dokladniej : '';
	printf( "\n<b>%22s = %16.12f%s</b>\n", $nazwa, $liczba, $dokl );
	$dif = 1; 
	$cnt = 0;
	$liczniki = array();
	$mianowniki = array();
	for( $m = 2; $m <= $max; $m++ )
	{
		$l = round( $liczba * $m );
		$iloraz = 1.0 * $l / $m;
		$delta = $liczba - $iloraz; 
		
		if ( abs( $delta ) < $dif )
		{	 
			$liczniki[] = $l;
			$mianowniki[] = $m;
			$cnt++;
			$class = ( $cnt % 2 == 1 ) ? 'odd' : 'even';
			if ( $cnt % 50 == 1 )
			{	                      // Lp liczn  mian iloraz  różn róż*m r*m2  r*m3  r*m4
				if( $lang == 'pl' )
				{
					printf( "<span class=\"nagl\">%3s %9s / %8s = %14s  %12s  %12s  %21s  %17s %26s</span>\n",  
						'Lp', 'licznik', 'mianow m', 'iloraz',   '   różnica D', 'D * m', 'D * m&sup2;', 'D * m&sup3;', 'D * m&#8308;' );
				}
				else
				{
					printf( "<span class=\"nagl\">%3s %9s / %8s = %14s  %12s  %12s  %21s  %17s %26s</span>\n",  
						'#', 'numerator', 'denom m', 'quotient', 'difference D', 'D * m', 'D * m&sup2;', 'D * m&sup3;', 'D * m&#8308;' );
				}
			}
			printf( "<span class=\"%s\">%3d %9d / %8d = %14.10f %+14.12f", $class, $cnt, $l, $m, $iloraz, $delta );
			
			$potegi[0] = $delta;
			
			for ( $wykl = 1; $wykl <= 4; $wykl++ )
			{
				$potegi[ $wykl ] = $potegi[ $wykl - 1 ] * $m;
			}

			//if ( $nazwa == 'Złoty podział (fi)' ) $potegi[2] *= sqrt(5.0);
			
			printf( "%+17.8f  %+10.3f  %+12.3f  %+19.3f </span>\n", $potegi[1], $potegi[2], $potegi[3], $potegi[4] );
			
			$dif = abs( $delta );
		}
	}
	/*echo '</pre>';
	foreach( $liczniki as $i => $licznik )
	{
		echo "<b>{$i}.</b> $licznik / {$mianowniki[$i]} ";
	}
	echo '<pre>';*/
	
}

?>
</pre>
</body>  
</html>
