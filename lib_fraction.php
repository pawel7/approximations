<?php
// a python script continued_fraction.py written by John Burkardt 
// converted to a php script continued_fraction.php by Pawel Lechowicz 
// and simplified to lib_fraction.php
// Converted on 28 February 2018

/*class cf {
	protected $coefs;
	protected $n;
	protected $numerators;
	protected $denominators;
	protected $text;
	*/
	
	
function to_cont( $x, $verbose = 0 ) 
{
	if( $verbose >= 2 ) printf( "to_cont: x = %25.15f\n", $x );
	$n = 12;
	$a_coefs = real2cf( $x, $n );
	
	list( $numerators, $denominators ) = cf2pq( $n, $a_coefs );
	if( $verbose >= 2 ) list_pq( $n, $numerators, $denominators );
	
	
	return array( 'text' => to_str( $a_coefs ),
			'coefs' => $a_coefs,
			'numerators' => $numerators,
			'denominators' => $denominators );
}


function real2cf( $r, $n )
{
#*****************************************************************************80;
#
## real2cf converts a real number $r to a simple continued fraction 
#
#  Parameters
#
#    Input, real R, the real value.
#
#    Input, integer N, the number of convergents to compute.
#
#    Output, integer A(0:N), the partial quotients.
#
  

  $a = array_fill( 0, $n + 1, 0 );

  if( $r == 0.0 )
  {    
	return $a ;
  }
  
  $r2 = $r;
  $a[0] = intval( $r2 );

  foreach( range( 1, $n ) as $i )
  {    
	$r2 = 1.0 / ( $r2 - (double)( $a[ $i - 1 ] ) );
    $a[ $i ] = intval( $r2 );
  }
  //echo "real2cf( $r, $n ), a =\n";
  //var_dump( $a ); //die();
  return $a;
} 

function real2cf_test()
{
#*****************************************************************************80;
#
## real2cf_test tests real2cf.
#

  $n = 19;

  print( "" );
  print( "real2cf_test:\n" );

  $r = pi();

  $a = real2cf( $r, $n );

  vec_print( $n + 1, $a, "  SCF coefficients:\n" );

  list( $p, $q ) = cf2pq( $n, $a );

  print( "" );
  print( "  SCF numerators, denominators, ratios:\n" );
  print( "" );

  foreach( range( 0, $n /*+ 1*/ ) as $i )
  { 
	$t = (double)( $p[ $i ] ) / (double)( $q[ $i ] );
    printf( "  %2d  %20d  %20d  %24.16f\n" , $i, $p[ $i ], $q[ $i ], $t );
  }
}

function cf2pq( $n, $a )
{
#*****************************************************************************80;
#
## cf2pq calculates the numerators and denominators 
#  of successive approximations of a simple continued fraction with integer coefficients 
#
#      SCF = A(0) + 1 /( A(1) + 1 /( A(2) ... + 1 / A(N) ) );
#
#    This routine returns the successive approximants P[ i ]/Q[ i ];
#    to the value of the rational number represented by the continued
#    fraction, with the value exactly equal to the final ratio P(N)/Q(N).
#
#  Licensing
#
#    I don't care what you do with this code.
#
#  Modified
#
#    09 August 2017
#
#  Author
#
#    John Burkardt
#
#  Reference
#
#    John Hart, Ward Cheney, Charles Lawson, Hans Maehly, Charles Mesztenyi,
#    John Rice, Henry Thatcher, Christoph Witzgall,
#    Computer Approximations,
#    Wiley, 1968.
#
#  Parameters
#
#    Input, integer N, the number of continued fraction
#    coefficients.
#
#    Input, integer A(0:N), the continued fraction coefficients.
#
#    Output, integer P(0:N), Q(0:N), the numerators and
#    denominators of the successive approximations.
#
 
 // $p = np.zeros( $n + 1, dtype = np.int64 );
 // $q = np.zeros( $n + 1, dtype = np.int64 );

foreach( range( 0, $n /*+ 1*/ ) as $i )
{
    if( $i == 0 )
{      $p[ $i ] =  $a[ $i ] * 1 + 0;
      $q[ $i ] =  $a[ $i ] * 0 + 1;
}    elseif( $i == 1 )
{      $p[ $i ] =  $a[ $i ] * $p[ $i - 1 ] + 1;
      $q[ $i ] =  $a[ $i ] * $q[ $i - 1 ] + 0;
}    else
{      $p[ $i ] =  $a[ $i ] * $p[ $i - 1 ] + $p[ $i - 2 ];
      $q[ $i ] =  $a[ $i ] * $q[ $i - 1 ] + $q[ $i - 2 ];
}
}
  return array( $p, $q );
}

function to_str( $a )
{
	return '[ '.implode( ', ', $a ).' ]';
}

function list_pq( $n, $p, $q )
{
  print( "  SCF numerators, denominators, ratios:\n" );
 
	foreach( range( 0, $n ) as $i )
	{
		$t = (double)( $p[ $i ] ) / (double)( $q[ $i ] );
		printf( "  %2d  %20d  %20d  %24.16f\n" , $i, $p[ $i ], $q[ $i ], $t);
	}
}

function cf2pq_test()
{
  $n = 19;

  $a = array( 
    3, 7, 15, 1, 292, 
    1, 1, 1, 2,  1, 
    3, 1, 14, 2,  1, 
    1, 2, 2, 2,  2 );

  print( "" );
  print( "I8Scf_test:\n" );

  list( $p, $q ) = cf2pq( $n, $a );
  list_pq( $n, $p, $q );

  
}

function vec_print( $n, $a, $title )
{
#*****************************************************************************80;
#
## I8VEC_PRINT prints an I8VEC.
#
#  Parameters
#
#    Input, integer N, the dimension of the vector.
#
#    Input, integer A(N), the vector to be printed.
#
#    Input, string TITLE, a title.
#
  print( "" );
  print( $title );
  print( "" );
  foreach( range( 0, $n-1 ) as $i )
  { 
	 printf( "%6d  %6d\n" , $i, $a[ $i ] );
  }
}
 

function vec_print_test()
{
#*****************************************************************************80;
#
## I8VEC_PRINT_TEST tests I8VEC_PRINT.
#


  print( "" );
  print( "I8VEC_PRINT_TEST\n" );
  print( "  I8VEC_PRINT prints an I8VEC.\n" );

  $n = 3;
  $v = array( 123456789, 1234567890987654321, -7 );
  vec_print( $n, $v, "  Here is an I8VEC:\n" );
#
#  Terminate.
#
  print( "" );
  print( "I8VEC_PRINT_TEST:\n" );
  print( "  Normal end of execution.\n" );
 
}

function timestamp()
{
#*****************************************************************************80;
#
## TIMESTAMP prints the date as a timestamp.
#
#  Licensing
#
#    This code is distributed under the GNU LGPL license. 
#
#  Modified
#
#    06 April 2013
#
#  Author
#
#    John Burkardt
#
#  Parameters
#
#    None
#
  

  //$t = time.time();
  //print( time.ctime( $t ) );

  return;
}

function cf_test()
{
#*****************************************************************************80;
#
## cf_test tests the CONTINUED_FRACTION library.
#
  print( "" );
  print( "cf_test:\n" );
  //print( "  PHP version ".phpversion()."\n" );
  print( "  CONTINUED_FRACTION is a library for dealing with" );
  print( "  expresssions representing a continued fraction.\n" );

  cf2pq_test();
  real2cf_test();
  vec_print_test();
#  Terminate.
#
  print( "" );
  print( "cf_test:\n" );
  print( "  Normal end of execution.\n" );
}

function Test_All()
{  
  timestamp();
  cf_test();
  timestamp();
}
