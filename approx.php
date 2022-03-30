<!DOCTYPE html>
<html lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Approximations of numbers</title>
  <style media="screen" type="text/css">
	body { background-color:#a0c0b0; margin: 0 auto; width:1260px;  text-align: center;}
	.nagl { background-color: #E0D8D0; color:#012;}
	.odd  { background-color: #C0f0D0;}
	.even { background-color: #C0D0f0;}
	.lepsze { font-weight:bold; color: #063;}
	.best  { font-weight:bold; background-color: white; }
	/*.in_fraction{ border: 1px solid blue; } */
	/*.almostbest  { font-weight:bold; background-color: #e0f0f0;  }*/
	span{display:inline-block;}
	.odd:hover, .even:hover  { background-color: #A0E0C0;}
	a { margin: 8px; }
	label { text-align: right; display: inline-block; width: 250px; }
  </style>
</head>
<body>
<?php
if ( empty( $_GET ) || isset( $_GET['any'] ))
	{ 
		// wypisz formularz do pobrania liczby
	?>
		
  <h2><?=  $_GET['lang']=='pl' ? 'Przybliżenia liczb':'Approximations of numbers'?></h2>
  <form>
    <label><?=  $_GET['lang']=='pl' ? 'Podaj liczbę':'Number to be approximated'?></label> 
		<input type="text" name="number" id="number" value=""><br>
    <label><?=  $_GET['lang']=='pl' ? 'Podaj jej nazwę':'Its name'?></label> 
		<input type="text" name="name" id="name" value=""><br>
    <label> </label> 
		<input type="submit"  value="OK" autofocus/><br>
		<input type="hidden" name="lang" id="lang" value="<?= $_GET['lang']; ?>">
  </form>
<?php } 
else
{
	require_once "set_values.php";
	//require_once "lib_fraction.php";
 
 	require_once "lancuchowy.php";
//Test_Continuous_Fractions(); die();	
	Set_Numbers();
	Set_Parameters();

	Show_Menu();
	echo "<pre>\n";

	if( isset( $_GET['rootlist'] ))
	{
		$number_list = $_GET['rootlist'] == '' ? $root_number_list : $_GET['rootlist'];
		Root_List_Approximations( $number_list );
	}
	else	
	if( isset( $_GET['root3list'] ))
	{
		$number_list = $_GET['root3list'] == '' ? $root_number_list : $_GET['root3list'];
		Cube_Root_List_Approximations( $number_list );
	}
	else	
	if( isset( $_GET['range'] ))
	{
		Test_Root_Range_Approximations();
	}
	else	
	if( $number != '' ) 
	{
		Approximations( $number, $limit, $full_name, '', $istotnie);
	}
	else
	{
		// Pokaż aproksymacje wybranych liczb
		Show_Approximations();
	}
}

function Display_Approximation_Line( $lang, $is_much_better, $cnt, $l, $m, $dif_m, $iloraz, $delta, $ile_times_better )
{
	global $pierwiastkowana, $root_n, $denominators, $coefs, $coef_ind;
	define( 'REPEAT_HEADER_LINES', 50 );
	$class = ( $cnt % 2 == 1 ) ? 'odd' : 'even';
	$better = $is_much_better;// || $delta == 0.0;
	$class .= $better ? ' lepsze' : '';
	$lepsze = $better ? '    &#10004;' : '     ';
	
		// mianownik jest mianownikiem $coef_ind reduktu ulamka lancuchowego
	$jest_z_cf = $m == intval($denominators[ $coef_ind ]);
	
	$lepsze .= $jest_z_cf ? ' '.sprintf( "%4d", $coefs[$coef_ind]).' &#10004;    ' : '           ';
	if( $jest_z_cf ) $coef_ind++;
	
	$potegi2 = $delta * $m * $m;
	$potegi3 = $potegi2 * $m;
	
	switch ( $root_n ) {
		case 2: $diff = $l * $l - $pierwiastkowana * $m * $m;
				$class .= $pierwiastkowana > 6 && in_array( $diff, array( 1, -1 )) ? ' best' : '';
				$class .= $pierwiastkowana > 10 && in_array( $diff, array( 2, -2 )) ? ' almostbest' : '';
				$hdr = "      l&sup2;-A*m&sup2;";
				$hdr_format = '%15s';
				$dif_format = '%12d ';
				break;
		case 3: $diff = $l * $l * $l - $pierwiastkowana * $m * $m * $m;
				$hdr = "      l&sup3;-A*m&sup3;";
				$hdr_format = '%15s';
				$dif_format = '%12d ';
				break;
		default:$diff= ''; 
				$hdr = '';
				$hdr_format = '%0s';
				$dif_format = '%0s';
				break;
	}
	
	if( $jest_z_cf ) $class .= ' in_fraction';
	
	//$diff2= $l * $l - $pierwiastkowana * $m * $m;
	//$diff3 = $l * $l * $l - $pierwiastkowana * $m * $m * $m;
					
		if ( $cnt % REPEAT_HEADER_LINES == 1 )
			{
					//   cnt  l     m   Dm  ilor  różn  wyrażenie    *lep  r*m2 r*m3 lepsze
				$format ='%3s %9s / %9s%10s %16s %14s  '.$hdr_format.'%12s %16s %17s %13s ';
				
				if( $lang == 'pl' )
				{
					printf( "<span class=\"nagl\">$format</span>\n",  
						'Lp', '  licznik', 'mianow m', ' różnica m', 'iloraz   ', '    różnica D ', $hdr, '* lepiej', 'D * m&sup2;', 'D * m&sup3;', 'Lepsze Łańcuch' );
				}
				else
				{
					printf( "<span class=\"nagl\">$format</span>\n",  
						'#', 'numerator', 'denom m', '  differ m', 'quotient ', '  difference D', $hdr, '* better', 'D * m&sup2;', 'D * m&sup3;',   'Better Cont fr' );
				}
			}
					$ile = $delta == 0.0 ? ($lang =='pl' ? '  Dokładnie' :' Precisely') : $ile_times_better;
					$format = $delta == 0.0 ?
					        "<span class=\"%s\">%3d %9d / %9d%10d %16.12f  %+14.12f $dif_format%+11s %+10.3f %+12.3f %15s</span>\n" :
					        "<span class=\"%s\">%3d %9d / %9d%10d %16.12f  %+14.12f $dif_format%+11.4f %+10.3f %+12.3f %15s</span>\n";
					//                   class  cnt  l     m  Dm iloraz   delta    * lepiej  pot2     pot3  lepsze				
				//	printf( "<span class=\"%s\">%3d %9d / %9d%10d %16.12f  %+14.12f %+11.4f %+10.3f %+12.3f %10s</span>\n",
					printf( $format,
						$class, $cnt, $l, $m, $dif_m, $iloraz, $delta, $diff, $ile, $potegi2, $potegi3, $lepsze );
}

function Approximations( $liczba, $lim=0, $name='', $dokladniej='', $istotnie=2 )
{
	global $limit, $root_n, $denominators, $coefs, $coef_ind;
	if( $lim == 0 ) $lim = $limit;
	$nazwa = $name == '' ? "$liczba" : $name;
	$lang = isset( $_GET['lang'] ) && $_GET['lang'] == 'en' ? 'en' : 'pl';
	$str = $lang == 'pl' ? ', dokładniej = ' : ', more precise = ';
	$dokl = ( $dokladniej != '' ) ? $str.$dokladniej : '';
	$html = $lang == 'pl' ? "Przybliżenia liczby $nazwa" :
							"Approximations of $nazwa";
	if( $root_n == 0 ) $html .= " = $liczba$dokl";
	echo "<h3>$html</h3>";
	
	
	$cont_frac = to_cont( $liczba, 0 );
		
	//var_dump( $cont_frac ); 
	//$numerators = $cont_frac['numerators'];
	$denominators = $cont_frac['denominators'];
	if( count($denominators) == 1 ) 
	{
		echo $lang == 'pl' ? "Liczba całkowita !\n" : "Whole number\n";
		return;
	}
	$coefs = $cont_frac['coefs'];
	$coef_ind = 1;// pomijamy zerowy indeks, numerators[0] = roumd( $liczba ), denominators[0] = 1;
	
		// pobierz pierwszy coef_ind taki, ze $denominators[$coef_ind] >= 2, bo główna petla jest od 2
	while( $coef_ind <= count($denominators) && $denominators[$coef_ind] < 2 ) $coef_ind++;

	
	//printf( "\n<b>%22s = %19.15f%s</b>\n", $nazwa, $liczba, $dokl );
	$last_delta = $liczba - round($liczba);	// poprzednia różnica między liczbą, a jej przybliżeniem
	$dif = 1; 	// Różnica między liczbą, a jej, do tej pory, najlepszym przybliżeniem
	
	$cnt = 0;
	$cnt_lepsze = 0;
	$liczniki = array();
	$mianowniki = array();
	$liczniki_lepsze = array();
	$mianowniki_lepsze = array();
	$times_better = array();
	
	//$liczniki[] = round( $liczba );
	//$mianowniki[] = 1;
	//$z0_test_mian = array(41,152, 2362, 9029,14261,108945,430548);
	$last_m = 1;	// poprzedni mianownik
	
		// główna petla
	for( $m = 2; $m <= $lim; $m++ )
	{
		$l = round( $liczba * $m );
		$iloraz = 1.0 * $l / $m;
		$delta = $liczba - $iloraz; // Różnica między liczbą, a jej przybliżeniem
		//if( $delta == 0.0 ) die('zero');
		
			// znaleziono lepsze przybliżenie
		$approx_is_better = abs( $delta ) < $dif;
		
			// bardzo podobnych NIE bierzemy
		//$approx_is_better = ( abs( $delta ) < $dif * 1.02 ); //|| in_array( $m, $z0_test_mian );
			
		if ( $approx_is_better )
		{	 
			$liczniki[] = $l;
			$mianowniki[] = $m;
			
			$mian_rozn = $m - $last_m;
			//$mian_rozn = $l*$l*$l*$l-2*$m*$m*$m*$m;
			
			$last_m = $m;
			$cnt++;
			
				// ile razy to przybliżenie jest lepsze od poprzedniego
			$ile_times_better = $delta == 0.0  ? 'dokladnie' : $last_delta / $delta;
			$last_delta = $delta;
			$dif = abs( $delta );
	
			$is_much_better = $delta == 0.0 || abs( $ile_times_better ) >= $istotnie;
			if( $is_much_better )	
			{
				$liczniki_lepsze[] = $l;
				$mianowniki_lepsze[] = $m;
				$times_better[] = $ile_times_better;
				$cnt_lepsze++;
			}
			Display_Approximation_Line( $lang, $is_much_better, $cnt, $l, $m, $mian_rozn, $iloraz, $delta, $ile_times_better );
		}
	}
	
	$html = $lang == 'pl' ? "przybliżeń co najmniej $istotnie razy lepszych." : "approximations at least $istotnie times better.";
	echo "<p>( $cnt_lepsze / $cnt ) $html</p>";
	
	$ile_razy = 1.5;
		// nie wyswietlamy osobnej tabeli przybliżeń istotnie lepszych, bo prawie wszystkie są istotnie lepsze
	if( $cnt_lepsze * $ile_razy > $cnt ) return;
		// dla listy też nie wyświetlamy
	if( isset( $_GET['rootlist'] )  || isset( $_GET['root3list'] )) return;
	
	$html = $lang == 'pl' ? "Co najmniej $istotnie razy lepsze, przybliżenia liczby $nazwa = $liczba" :
							"Approximations of $nazwa = $liczba, at least $istotnie times better";
	echo "<h3>$html</h3>";
	
	// wypisz listotnie epsze przybliżenia, jeśli jest ich przynajmniej $ile_razy mniej niż wszystkich
	foreach( $liczniki_lepsze as $i => $l )
	{
		$m = $mianowniki_lepsze[$i];
		$l = round( $liczba * $m );
		$iloraz = 1.0 * $l / $m;
		$delta = $liczba - $iloraz; 
		$ile_times_better = $times_better[ $i ];
				
		Display_Approximation_Line( $lang, true, $i+1, $l, $m, 0, $iloraz, $delta, $ile_times_better );
	}
}

?>
</pre>
</body>  
</html>
