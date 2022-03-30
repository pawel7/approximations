<?php

// dołóż parametry do $link
// ze zmiennych $istotnie
// A nIE ze zmiennych $name, $number 
function Set_Link( $lng, $link, $lim, $text, $param='' )
{
	global $istotnie;
	$char = strpos( $link, '?' ) === false ? '?' : '&';
	$href = $link.$char."lang=$lng&limit=$lim&istotnie=$istotnie";
	if( $param != '' ) $href .= '&'.$param;
	
	$html = "<a href=\"$href\">$text</a>";
	//$href = "$link?lang=$lang&limit=$limit&name=$name&number=$number&istotnie=$istotnie";
	return $html;
}

// wyświetl menu z linkami do przybliżeń różnych liczb
function Show_Menu()
{
	global $number, $p_text, $hdr_text;
	global $short_menu;
	
	if( $number == '' )
	{
		echo "<h1>$hdr_text</h1>\n";
		echo "<p>$p_text</p>\n";
	}
	
	//echo "<a href="$a_href"> $a_text </a>";
		// wyświetl menu z linkami do przybliżeń różnych liczb
	echo $short_menu;
}

function Test_Root_Range_Approximations()
{
	Root_Range_Approximations( 3.0, 12.0, 1.0 );
	Approximations( sqrt( 7.2 ));
	Approximations( sqrt( 72.0 ));
}

// Pokaż aproksymacje pierwiastka z $num
function Root_Approximation( $num )
{
	global $lang, $limit, $istotnie;
	global $pierwiastkowana, $root_n;
	$pierwiastkowana = $num;
	$x = sqrt( $num );
	$root_n = 2;	// wyciągamy pierwiastek stopnia 2
	$name = "&radic;A = $x, A = $num";
	Approximations( $x, $limit, $name, '', $istotnie);
//	Approximations( pow($num, 1.0/3), $limit, $name, '', $istotnie);
}

// Pokaż aproksymacje pierwiastka trzeciego stopnia z $num
function Cube_Root_Approximation( $num )
{
	global $lang, $limit, $istotnie;
	global $pierwiastkowana, $root_n;
	$pierwiastkowana = $num;
	$x = pow($num, 1.0/3);
	$root_n = 3;	// wyciągamy pierwiastek stopnia 3
	$name = "&sup3;&radic;A = $x, A = $num";
//	Approximations( sqrt($num), $limit, $name, '', $istotnie);
	Approximations( $x, $limit, $name, '', $istotnie);
}

function Test_Root_List_Approximations()
{
	global $number_list;
	$number_list = '2, 3, 5, 7, 8, 10, 11, 12, 7.2, 72, 80, 71';
	Root_List_Approximations( $number_list );
}
	
// Pokaż aproksymacje pierwiastków z wybranych liczb
function Root_List_Approximations( $number_list )
{
	global $lang, $limit, $istotnie;
	$numbers = explode( ',', $number_list );
	foreach( $numbers as $num )
	{
		Root_Approximation( trim($num) );
	}
}

// Pokaż aproksymacje pierwiastków sześciennych z wybranych liczb
function Cube_Root_List_Approximations( $number_list )
{
	global $lang, $limit, $istotnie;
	$numbers = explode( ',', $number_list );
	foreach( $numbers as $num )
	{
		Cube_Root_Approximation( trim($num) );
	}
}

function Root_Range_Approximations( $from, $to, $step )
{
	global $lang, $limit, $istotnie;
	$num = $from;
	while( $num <= $to )
	{
		$name = '&radic;'.$num;
		Approximations( sqrt($num), $limit, $name, '', $istotnie);
		$num += $step;
	}
}
	
// Pokaż aproksymacje wybranych liczb
function Show_Approximations()
{
	global $lang, $limit, $limit2, $name, $number, $full_name, $istotnie, $title, $p_text, $hdr_text;
	global $name_2_numbers, $name_2_full_names, $short_menu;
	global $alfa, $alfa_1, $alfa1, $alfa2, $alfa3, $random_number, $random_number2, $pi, $e, $exp_pi, $pi_e, $pi_str, $e_str, $fi, $r2_2, $r3_2, $r32, $r532, $r4_2, $r5_2, $r3_5, $r4_5, $g, $Z0;

	$name = $lang == 'pl' ? 'Złoty podział' :  'Golden ratio';
	$name .= ', &phi; = ( 1 + &radic;<span style="text-decoration:overline;">5</span> ) / 2';
	Approximations( $fi, $limit, $name, '', $istotnie);
//&radic;<xx>3</xx> - &radic;<xx>2</xx> 
// zamiast 2<sup>1/3</sup>
	Approximations( $r2_2, $limit, '&radic;<xx>2</xx>', '', $istotnie );
	Approximations( $r32, $limit, '&radic;<xx>3</xx> - &radic;<xx>2</xx>', '', $istotnie );
	Approximations( $r532, $limit, '&radic;<xx>5</xx> - &radic;<xx>3</xx> + &radic;<xx>2</xx>', '', $istotnie );
	Approximations( $r3_2, $limit, '<sup>3</sup>&radic;<xx>2</xx>', '', $istotnie );
	Approximations( $r4_2, $limit, '<sup>4</sup>&radic;<xx>2</xx>','',  $istotnie );
	Approximations( $r5_2, $limit, '<sup>5</sup>&radic;<xx>2</xx>', '', $istotnie );

	Approximations( $Z0, $limit, 'characteristic impedance of vacuum (Z0)', '', $istotnie );
	Approximations( $g, $limit, 'proton g factor', '', $istotnie );
											
	Approximations( $pi, $limit, '&pi;', $pi_str, $istotnie );
	Approximations( $e, $limit, 'e', $e_str, $istotnie );
	Approximations( $exp_pi, $limit, 'e<sup>&pi;</sup>', '', $istotnie );
	Approximations( $pi_e, $limit, '&pi;<sup>e</sup>', '', $istotnie );

	Approximations( $alfa_1,  $limit, '1/alpha', '', $istotnie );
	Approximations( $alfa,  $limit, 'alpha', '', $istotnie );
	Approximations( $alfa1, $limit, 'alpha1', '', $istotnie );
	//Approximations( $alfa2, $limit2, 'alpha2', $istotnie );
	//Approximations( $alfa3, $limit2, 'alpha3', $istotnie );

	Approximations( $random_number, $limit, 'A random number', '', $istotnie );
	Approximations( $random_number2, $limit, 'Another random number', '', $istotnie );
}

// Ustaw zmienne globalne wg parametrów $_GET 
// ustaw zmienną short_menu
function Set_Parameters()
{
	global $lang, $limit, $limit2, $name, $number, $full_name, $istotnie, $title, $p_text, $hdr_text;
	global $name_2_numbers, $name_2_full_names, $short_menu, $number_list, $root_number_list;
	global $alfa, $alfa1, $alfa2, $alfa3, $random_number, $random_number2, $pi, $e, $exp_pi, $pi_e, $pi_str, $e_str, $fi, $r2_2, $r3_2, $r32, $r532, $r4_2, $r5_2, $r3_5, $r4_5, $g, $Z0;
	
	 $name_2_numbers =
		array( 
			'pi' => $pi, 
			'e'=>$e, 
			'exp_pi'=> $exp_pi,
			'pi_e' => $pi_e,
			'phi' => $fi, 
			'r2' => $r2_2, 
			'r3_2' => $r3_2, 
			'r4_2' => $r4_2, 
			'r5_2' => $r5_2, 
			'r32' => $r32,
			'r532' => $r532,
			'alpha' => $alfa, 
			'g' => $g,
			'z0' => $Z0, 
			'random' => $random_number );
	
	$name_2_full_names = array(
		'pl' => array( 
			'pi' => '&pi;', 
			'e' => 'e', 
			'exp_pi' => 'e<sup>&pi;</sup>',
			'pi_e' => '&pi;<sup>e</sup>',
			'phi' => '&phi; Złoty podział', 
			'r2' => '&radic;<xx>2</xx>', 
			'r3_2' => '<sup>3</sup>&radic;<xx>2</xx>', 
			'r4_2' => '<sup>4</sup>&radic;<xx>2</xx>', 
			'r5_2' => '<sup>5</sup>&radic;<xx>2</xx>', 
			'r32' => '&radic;<xx>3</xx> - &radic;<xx>2</xx>', 
			'r532' => '&radic;<xx>5</xx> - &radic;<xx>3</xx> + &radic;<xx>2</xx>', 
			'alpha' => 'alfa', 
			'g' => 'proton g factor', 
			'z0' => 'characteristic impedance of vacuum', 
			'random' => 'liczba losowa' ),
		'en' => array( 
			'pi' => '&pi;', 
			'e' => 'e', 
			'exp_pi' => 'e<sup>&pi;</sup>',
			'pi_e' => '&pi;<sup>e</sup>',
			'phi' => '&phi; Golden ratio', 
			'r2' => '&radic;<xx>2</xx>', 
			'r3_2' => '<sup>3</sup>&radic;<xx>2</xx> ', 
			'r4_2' => '<sup>4</sup>&radic;<xx>2</xx>', 
			'r5_2' => '<sup>5</sup>&radic;<xx>2</xx>', 
			'r32' => '&radic;<xx>3</xx> - &radic;<xx>2</xx>', 
			'r532' => '&radic;<xx>5</xx> - &radic;<xx>3</xx> + &radic;<xx>2</xx>', 
			'alpha' => 'alpha', 'g' => 'proton g factor', 'z0' => 'characteristic impedance of vacuum', 'random' => 'A random number' ));
		
	$short_names = 
	array( 
			'pi' => '&pi;',
			'e'=>'e', 
			'exp_pi' => 'e<sup>&pi;</sup>',
			'pi_e' => '&pi;<sup>e</sup>',
			'phi' => '&phi;', 
			'r2' => '&radic;<xx>2</xx>', 
			'r3_2' => '<sup>3</sup>&radic;<xx>2</xx> ', 
			'r4_2' => '<sup>4</sup>&radic;<xx>2</xx>', 
			'r5_2' => '<sup>5</sup>&radic;<xx>2</xx>', 
			'r32' => '&radic;<xx>3</xx> - &radic;<xx>2</xx>', 
			'r532' => '&radic;<xx>5</xx> - &radic;<xx>3</xx> + &radic;<xx>2</xx>', 
			'alpha' => 'alpha', 
			'g' => 'g',
			'z0' => 'Z0', 
			'random' => 'random_number' );
	
	//( , 'e', '&phi;', '2^1/2', '2^1/3', 'alfa', 'g', 'z0', 'random' );
	
	$root_number_list = '7, 13, 17, 19, 29, 61, 71';
	//$root_number_list = '2, 3, 5, 7, 8, 10, 11, 12, 7.2, 72, 80, 71';
	
	$lang   = isset( $_GET['lang'] ) && $_GET['lang'] == 'en' ? 'en' : 'pl';
	$limit  = isset( $_GET['limit'] )  ? $_GET['limit']  : 1000;
	$limit2 = isset( $_GET['limit2'] ) ? $_GET['limit2'] : 10000;
	$number_list = isset( $_GET['rootlist'] ) ? $_GET['rootlist'] : '2, 3, 5';

	$name = '';
	$number = '';
	$full_name = isset( $_GET['name'] ) ? $_GET['name'] : '';
	
	$istotnie = isset( $_GET['istotnie'] ) ? $_GET['istotnie'] : 2;

	$title =    $lang == 'pl' ? 'Przybliżenia liczb' : 'Approximations of numbers';

	if( isset( $_GET['name'] ))
	{
		$name = $_GET['name'];
		if( array_key_exists( $name, $name_2_numbers ))
		{
			$number = $name_2_numbers[ $name ];
			$full_name = $name_2_full_names[ $lang][ $name ];
			//die( $full_name );
		}
		//else die("Nie znam liczby o nazwie $name" );
		else $number = isset( $_GET['number'] ) ? $_GET['number'] : '';
	}
	else
	{
		$number = isset( $_GET['number'] ) ? $_GET['number'] : '';
	}
	
	$short_menu = '';// kod html - menu z linkami do przybliżeń różnych liczb

	foreach( $name_2_numbers as $aname => $num )
	{
		$a_text = $short_names[ $aname ];
		$a_href = 'approx.php?number='.$num.'&name='.$aname.'&lang='.$lang.'&limit='.$limit;
		$short_menu .= "<a href=\"$a_href\"> $a_text </a>";
	}
	
	$this_link = 'approx.php';
	
	if( isset( $_GET['rootlist'] ))
	{
		$short_menu .= '<br>';
		$number_list = $_GET['rootlist'] == '' ? $root_number_list : $_GET['rootlist'];
		$number_array = explode( ',', $number_list );
	
		foreach( $number_array as $num )
		{
			$a_text = '&radic;'.$num;
			$val = sqrt($num);
			$a_href = 'approx.php?number='.$val.'&name='.$a_text.'&lang='.$lang.'&limit='.$limit;
			$short_menu .= "<a href=\"$a_href\"> $a_text </a>";
		}
	}
	
	list( $item1, $item2 ) = $lang == 'pl' ? array('Dowolna', 'Wszystkie' ) : array( 'Any', 'All' );
	
	$short_menu .= Set_Link( $lang, $this_link.'?any',  $limit, $item1 );
	$short_menu .= Set_Link( $lang, $this_link, 		$limit, $item2 );

	if( !isset( $_GET['rootlist'] )) $short_menu .= '<br>'.Set_Link( $lang, $this_link.'?rootlist',  $limit, '√7 √ 13 √ 17 √ 19 √ 29 √ 61 √ 71' );
	
	if( !isset( $_GET['root3list'] ))$short_menu .= '<br>'.Set_Link( $lang, $this_link.'?root3list',  $limit, '³√2 ³√3 ³√4' );
	
	if( $number != '' ) 
	{
		$this_link .= '?number='.$number.'&name='.$name;
	}

	$param = isset( $_GET['rootlist'] ) ? 'rootlist' : '';
	if( isset( $_GET['root3list'] )) $param = 'root3list';
	
	$other_lang = $lang == 'pl' ? 'en' : 'pl';
	$inny =  $lang == 'pl' ? 'English' : 'polski';
	$short_menu .= Set_Link( $other_lang, $this_link, $limit, $inny, $param );
	
	$short_menu .= 'Limit'.Set_Link( $lang, $this_link, 1000, '1000', $param );
	//if( isset( $_GET['rootlist'] )) $short_menu .= '&rootlist';
	//if( isset( $_GET['root3list'] )) $short_menu .= '&root3list';
	
	$short_menu .= Set_Link( $lang, $this_link, 1000000, '10<sup>6</sup>', $param );
	$short_menu .= $lang == 'pl' ? "<a href=\"pomoc.html\">Pomoc</a>" : "<a href=\"help.html\"> Help</a>";
	
	$hdr_text = $number != '' ? ($lang == 'pl' ? "Przybliżenia liczby $full_name = $number" : "Approximations of number $full_name = $number" ) : 
	( $lang == 'pl' ? 'Przybliżenia liczb algebraicznych i przestępnych' : 'Approximations of algebraic and transcendental numbers');

	$p_text = $lang == 'pl' ? "Coraz to lepsze przybliżenia liczb za pomocą ułamków o mianownikach będących kolejnymi liczbami naturalnymi. <br> Lepsze <span class=\"lepsze\"> &#10004;</span> oznacza przybliżenie co najmniej {$istotnie} razy lepsze ": 
	"Ever better approximations of numbers with fractions, whose denominators are consecutive natural numbers. <br> Better <span class=\"lepsze\"> &#10004;</span> means approximation at least {$istotnie} times better"; 

	$a_text = $lang == 'pl' ? 'English version' : 'Po polsku';

	$a_href = $lang == 'pl' ? '?lang=en' : '?lang=pl';
	if ( $number != '' ) $a_href .= '&number='.$number;
	if ( $name != '' ) $a_href .= '&name='.$name;
}

// Nadaj wartości stałym liczbom w poniższej linii global
function Set_Numbers()
{
	global $alfa, $alfa1, $alfa_1, $alfa2, $alfa3, $random_number, $random_number2, $pi, $e, $exp_pi, $pi_e, $pi_str, $e_str, $fi, $r2_2, $r3_2, $r32, $r532, $r4_2, $r5_2, $r3_5, $r4_5, $g, $Z0;
	//$alfa  = 137.03599907444; 
	$alfa = 137.03599913931;
	$alfa1 = 137.03599903791; 
	$alfa2 = 137.03599908451;
	$alfa3 = 137.03599911;
	$alfa_1 = 0.007297352566417;
	/*
	 0: 0 = 0
137: 1/137 = 0.0072992700729927005
 27: 27/3700 = 0.007297297297297297
  1: 28/3837 = 0.007297367735209799
  3: 111/15211 = 0.00729735060153836
  1: 139/19048 = 0.007297354052918942
  1: 250/34259 = 0.0072973525205055605
 18: 4639/635710 = 0.007297352566421796
515: 2389335/327424909 = 0.0072973525664169914
  1: 2393974/328060619 = 0.007297352566417001
 11: 28723049/3936091718 = 0.007297352566417
...
Convergents:
137: 137/1 = 137
 27: 3700/27 = 137.03703703703704
  1: 3837/28 = 137.03571428571428
  3: 15211/111 = 137.03603603603602
  1: 19048/139 = 137.0359712230216
  1: 34259/250 = 137.036
 18: 635710/4639 = 137.0359991377452
 29: 18469849/134781 = 137.03599913934457
  1: 19105559/139420 = 137.03599913929136
  1: 37575408/274201 = 137.0359991393175
  1: 56680967/413621 = 137.0359991393087
  3: 207618309/1515064 = 137.0359991393103
  1: 264299276/1928685 = 137.03599913930995
  3: 1000516137/7301119 = 137.03599913931
...*/
	$random_number = 2.3962610645827138793264;
	$random_number2 = 7.1963874952918563207152;

	$lim = 100;
	$random_number = (float)(rand(0,9).'.'.mt_rand($lim,10*$lim).mt_rand($lim,10*$lim).mt_rand($lim,10*$lim));
	$random_number2 = (float)(rand(1,100).'.'.mt_rand($lim,10*$lim).mt_rand($lim,10*$lim).mt_rand($lim,10*$lim));
	//echo $random_number. ' '.$random_number2;exit;
	$pi_str='3.141592653589793238462643383279502884197169';
	$pi = (double)3.141592653589793238462643383279502884197169;
	$e=(double)2.71828182845904523536028747135266249775724709369995;
	$exp_pi = exp( $pi );
	$pi_e = pow( $pi, $e );
	
	$e_str='2.71828182845904523536028747135266249775724709369995';
	$fi = (sqrt( 5.0 ) + 1)/2;

	$r3_5 = pow( 5.0, 1.0/3 );
	$r4_5 = pow( 5.0, 1.0/4 );

	$r2_2 = sqrt( 2.0 );
	$r3_2 = pow( 2.0, 1.0/3 );
	$r4_2 = pow( 2.0, 0.25 );
	$r5_2 = pow( 2.0, 0.2 );

	$r32 = sqrt( 3.0 ) - sqrt( 2.0 );
	$r532 = sqrt( 5.0 ) - sqrt( 3.0 ) + sqrt( 2.0 );

	$Z0=376.730313461; //characteristic impedance of vacuum
	$g = 5.585694713; // proton g factor
}
