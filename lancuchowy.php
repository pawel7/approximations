<?php 
function to_cont( $x, $verbose = 2 ) 
{
	if( $verbose >= 2 ) printf( "to_cont: x = %25.15f\n", $x );
	$r = $x; $n = 0;
	$fl= floor( $x ); 
	$arr[] = $fl;	// pierwszy element ułamka łańcuchowego
	
	$p[0] = $fl;
	$q[0] = 1;
	
	$frac_part =  $x - $fl; 
	if( abs($frac_part) < 1.0e-18 ) 
	{ 
		$int = intval( $fl );
		// echo "Liczba całkowita\n";
		
		return array( 
			'text' => "[ $int ]",
			'coefs' => $array( $int ),
			'numerators' => $p,
			'denominators' => $q );
	}

	$dif = $frac_part;
	$a[0] = $fl;
	$approx = $fl;
	
	//echo "floor = ".floor($x);
	$p[-1]= 1;
	$q[-1] = 0;
		
	$r = 1.0/$frac_part;
	//$frac_part =  $r - $fl; 
		
	//echo "$n. x=$x, r=$r, fl=$fl, frac_part = $frac_part, {$p[$n]} / {$q[$n]} = $approx, dif=$dif\n";
	
	while ( true )
	{
	//	echo "$n. r=$r, fl=$fl, frac_part = $frac_part, {$p} / {$q} = $approx, dif=$dif\n";
		$n++;
		$fl = floor( $r );	// nie daję intval, bo może być nadmiar
		$frac_part =  $r - $fl; 
		
		$arr[] = $fl;	// kolejny element ułamka łańcuchowego
		
		$p[$n] = $fl*$p[$n-1]+$p[$n-2];
		$q[$n] = $fl*$q[$n-1]+$q[$n-2];
		//$p[$n] = $fl*$p[1+$p0;
		//$q[$n] = $fl*$q1+$q0;
		$approx = 1.0*$p[$n]/$q[$n];
		//$p0=$p1; $q0 = $q1;
		//$p1=$p; $q1=$q;
	
		$dif = $x - $approx;
	
		if( $verbose >= 2 ) echo "$n. r=$r, fl=$fl, frac_part = $frac_part, {$p[$n]} / {$q[$n]} = $approx, dif=$dif\n";
	
			// liczymy max 50 wyrazów ułamka łańcuchowego
		if( $n >= 50 || abs($dif) < 1.0e-18 ) break;
		$r = 1.0 / $frac_part;
	}
	$text = '[ '.implode( ', ', $arr ). ' ]';
	if( $verbose >= 1 ) 
	{
		$str = trim( sprintf( "%25.15f", $x ));
		echo "$str = $text\n";
	}
	//if( $verbose >= 2 ) echo "\n +++\n";
	 unset( $p[-1] ); unset( $q[-1] );
	
	if( $verbose >= 2 ) 
	{
		echo implode( "\n", $q );
	}
	if( $verbose >= 3 ) 
	{
		var_dump( $p ); 
		var_dump( $q );
	}
	
	return array( 'text' => $text,
			'coefs' => $arr,
			'numerators' => $p,
			'denominators' => $q );
}

function real2cont( $x ) 
{
	echo "real2cont: x=$x\n";
	$r = $x; $n = 0;
	//for( $i= 1; $i<5; $i++ )
	
	while ( true )
	{
		$a =  floor( $r );
		$dif = $r - $a;
		
		$arr[] = $a;
		$dif_arr[] = $dif;
		$n++;
		if( $n == 30 || abs($dif) < 1.0e-8 ) break;
		$r = 1.0 / ( $r - $a );
		
	}
	$text = implode( ', ', $arr );
	$difs = implode( "\n", $dif_arr );
	echo "$text\n";
	echo $difs;
	echo "\n ----\n";
}
 
function real2frac( $x ) 
{
	echo "real2frac: x =$x\n";
	$r = $x; $n = 0;
	//for( $i= 1; $i<5; $i++ )
	$p0 = 1;
	$q0 = 0;
	$p1 = floor( $x );
	$q1 = 1;
	while ( true )
	{
		$a =  floor( $r );
		$dif = $r - $a;
		$quot = 1.0*$p1/(1.0*$q1);
		
		echo "$n. {$p1} / {$q1} = $quot, a = $a, r = $r\n";
		
		if( $n == 30 || abs($dif) < 1.0e-8 ) break;
		$arr[] = $a;
		$dif_arr[] = $dif;
		$n++;
		//echo "$n. {$p1} / {$q1} = $quot, a = $a, r = $r\n";
		$p = $a*$p1+$p0;
		$q = $a*$q1+$q0;
		$p0=$p1; $q0 = $q1;
		$p1=$p; $q1=$q;
		$r = 1.0 / ( $r - $a );
		
	}
	$text = implode( ', ', $arr );
	$difs = implode( "\n", $dif_arr );
	echo "$text\n";
	echo $difs;
	echo "\n ===========\n";
}

