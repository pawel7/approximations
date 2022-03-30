<?php
// a python script continued_fraction.py written by John Burkardt 
// converted to a php script continued_fraction.php by Pawel Lechowicz 
// Converted on 28 February 2018
#
function i4cf_evaluate( $n, $a, $b )
{
#*****************************************************************************80;
#
## I4CF_EVALUATE evaluates a continued fraction with I4 entries.
#
#  Discussion
#
#    For convenience, we omit the parentheses or multiline display.
#
#    CF = A(0) + B(1) / A(1) + B(2) / A(2) + ... A(N-1) + B(N) / A(N).
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
#    Input, integer A(0:N), B(0:N), the continued fraction 
#    coefficients.
#
#    Output, integer P(0:N), Q(0:N), the N+1 successive 
#    approximations to the value of the continued fraction.
#
  

//  $p = np.zeros( $n + 1, dtype = np.int32 );
//  $q = np.zeros( $n + 1, dtype = np.int32 );

foreach( range( 0, $n /*+ 1*/ ) as $i )
{
    if( $i == 0 )
{      $p[ $i ] =  $a[ $i ] * 1 + 0;
      $q[ $i ] =  $a[ $i ] * 0 + 1;
}    elseif( $i == 1 )
{      $p[ $i ] =  $a[ $i ] * $p[ $i - 1 ] +  $b[ $i ] * 1;
      $q[ $i ] =  $a[ $i ] * $q[ $i - 1 ] +  $b[ $i ] * 0;
}    else
{      $p[ $i ] =  $a[ $i ] * $p[ $i - 1 ] +  $b[ $i ] * $p[ $i - 2 ];
      $q[ $i ] =  $a[ $i ] * $q[ $i - 1 ] +  $b[ $i ] * $q[ $i - 2 ];
}
}
  return array( $p, $q );
}

function i4cf_evaluate_test()
{
#*****************************************************************************80;
#
## I4CF_EVALUATE_TEST tests I4CF_EVALUATE.
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
  

  $n = 19;

  $a = array( 
    3, 
    6, 6, 6, 6, 6, 
    6, 6, 6, 6, 6, 
    6, 6, 6, 6, 6, 
    6, 6, 6, 6 );

   $b  = array( 
      0, 
      1,   9,  25,  49,  81, 
    121, 169, 225, 289, 361, 
    441, 529, 625, 729, 841, 
    961, 1089, 1225, 1369 );

  print( "" );
  print( "I4CF_EVALUATE_TEST:\n" );

  list( $p, $q ) = i4cf_evaluate( $n, $a, $b );

  print( "" );
  print( "  CF numerators, denominators, ratios:\n" );
  print( "" );

foreach( range( 0, $n /*+ 1*/ ) as $i )
{    $t = (double)( $p[ $i ] ) / (double)( $q[ $i ] );
    printf( "  %2d  %12d  %12d  %24.16f\n" , $i, $p[ $i ], $q[ $i ], $t);
}
}
 

function i4scf_evaluate( $n, $a )
{
#*****************************************************************************80;
#
## I4SCF_EVALUATE evaluates a simple continued fraction with I4 entries.
#
#  Discussion
#
#    The simple continued fraction with integer coefficients is
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
  

  //$p = np.zeros( $n + 1, dtype = np.int32 );
  //$q = np.zeros( $n + 1, dtype = np.int32 );

foreach( range( 0, $n /*+ 1*/ ) as $i )
{
    if( $i == 0 )
{   
	  $p[ $i ] =  $a[ $i ] * 1 + 0;
      $q[ $i ] =  $a[ $i ] * 0 + 1;
}    elseif( $i == 1 )
{   
	  $p[ $i ] =  $a[ $i ] * $p[ $i - 1 ] + 1;
      $q[ $i ] =  $a[ $i ] * $q[ $i - 1 ] + 0;
}    else
{
	  $p[ $i ] =  $a[ $i ] * $p[ $i - 1 ] + $p[ $i - 2 ];
      $q[ $i ] =  $a[ $i ] * $q[ $i - 1 ] + $q[ $i - 2 ];
}
}
  return array( $p, $q );
}

function i4scf_evaluate_test()
{
#*****************************************************************************80;
#
## I4SCF_EVALUATE_TEST tests I4SCF_EVALUATE.
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
  

  $n = 19;

  $a = array( 
    3, 7, 15, 1, 292, 
    1, 1, 1, 2,  1, 
    3, 1, 14, 2,  1, 
    1, 2, 2, 2,  2 );

  print( "" );
  print( "I4SCF_EVALUATE_TEST:\n" );

  list( $p, $q ) = i4scf_evaluate( $n, $a );

  print( "" );
  print( "  SCF numerators, denominators, ratios:\n" );
  print( "" );

foreach( range( 0, $n /*+ 1*/ ) as $i )
{
	$t = (double)( $p[ $i ] ) / (double)( $q[ $i ] );
    printf( "  %2d  %12d  %12d  %24.16f\n" , $i, $p[ $i ], $q[ $i ], $t);
}
}

function i4vec_print( $n, $a, $title )
{
#*****************************************************************************80;
#
## I4VEC_PRINT prints an I4VEC.
#
#  Licensing
#
#    This code is distributed under the GNU LGPL license.
#
#  Modified
#
#    31 August 2014
#
#  Author
#
#    John Burkardt
#
#  Parameters
#
#    Input, integer N, the dimension of the vector.
#
#    Input, integer A(N), the vector to be printed.
#
#    Input, string TITLE, $a  title.
#
  print( "" );
  print( $title );
  print( "" );
foreach( range( 0, $n-1 ) as $i )
    printf( "%6d  %6d\n" , $i, $a[ $i ] );
}
 
function i4vec_print_test()
{
#*****************************************************************************80;
#
## I4VEC_PRINT_TEST tests I4VEC_PRINT.
#
#  Licensing
#
#    This code is distributed under the GNU LGPL license.
#
#  Modified
#
#    25 September 2016
#
#  Author
#
#    John Burkardt
#
  
  print( "" );
  print( "I4VEC_PRINT_TEST" );
  print( "  I4VEC_PRINT prints an I4VEC." );

  $n = 4;
  $v = array( 91, 92, 93, 94 );
  i4vec_print( $n, $v, "  Here is an I4VEC:" );
#
#  Terminate.
#
  print( "" );
  print( "I4VEC_PRINT_TEST:\n" );
  print( "  Normal end of execution." );
}

function i8cf_evaluate( $n, $a, $b )
{
#*****************************************************************************80;
#
## I8CF_EVALUATE evaluates a continued fraction with I8 entries.
#
#  Discussion
#
#    For convenience, we omit the parentheses or multiline display.
#
#    CF = A(0) + B(1) / A(1) + B(2) / A(2) + ... A(N-1) + B(N) / A(N).
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
#    Input, integer A(0:N), B(0:N), the continued fraction 
#    coefficients.
#
#    Output, integer P(0:N), Q(0:N), the N successive 
#    approximations to the value of the continued fraction.
#
  
foreach( range( 0, $n /*+ 1*/ ) as $i )
{
    if( $i == 0 )
{      $p[ $i ] =  $a[ $i ] * 1 + 0;
      $q[ $i ] =  $a[ $i ] * 0 + 1;
}    elseif( $i == 1 )
{      $p[ $i ] =  $a[ $i ] * $p[ $i - 1 ] +  $b[ $i ] * 1;
      $q[ $i ] =  $a[ $i ] * $q[ $i - 1 ] +  $b[ $i ] * 0;
}    else
{      $p[ $i ] =  $a[ $i ] * $p[ $i - 1 ] +  $b[ $i ] * $p[ $i - 2 ];
      $q[ $i ] =  $a[ $i ] * $q[ $i - 1 ] +  $b[ $i ] * $q[ $i - 2 ];
}
}
  return array( $p, $q );
}

function i8cf_evaluate_test()
{
#*****************************************************************************80;
#
## I8CF_EVALUATE_TEST tests I8CF_EVALUATE.
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
  

  $n = 19;

  $a = array( 
    3, 
    6, 6, 6, 6, 6, 
    6, 6, 6, 6, 6, 
    6, 6, 6, 6, 6, 
    6, 6, 6, 6 );

   $b  = array( 
      0, 
      1,   9,  25,  49,  81, 
    121, 169, 225, 289, 361, 
    441, 529, 625, 729, 841, 
    961, 1089, 1225, 1369 );

  print( "" );
  print( "I8CF_EVALUATE_TEST:\n" );

  list( $p, $q ) = i8cf_evaluate( $n, $a, $b );

  print( "" );
  print( "  CF numerators, denominators, ratios:\n" );
  print( "" );

foreach( range( 0, $n /*+ 1*/ ) as $i )
{    $t = (double)( $p[ $i ] ) / (double)( $q[ $i ] );
    printf( "  %2d  %20d  %20d  %24.16f\n" , $i, $p[ $i ], $q[ $i ], $t);
}
}

function i8scf_evaluate( $n, $a )
{
#*****************************************************************************80;
#
## I8SCF_EVALUATE evaluates a simple continued fraction with I8 entries.
#
#  Discussion
#
#    The simple continued fraction with integer coefficients is
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

function i8scf_evaluate_test()
{
#*****************************************************************************80;
#
## I8SCF_EVALUATE_TEST tests I8SCF_EVALUATE.
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
  

  $n = 19;

  $a = array( 
    3, 7, 15, 1, 292, 
    1, 1, 1, 2,  1, 
    3, 1, 14, 2,  1, 
    1, 2, 2, 2,  2 );

  print( "" );
  print( "I8SCF_EVALUATE_TEST:\n" );

  list( $p, $q ) = i8scf_evaluate( $n, $a );

  print( "" );
  print( "  SCF numerators, denominators, ratios:\n" );
  print( "" );

foreach( range( 0, $n /*+ 1*/ ) as $i )
{    $t = (double)( $p[ $i ] ) / (double)( $q[ $i ] );
    printf( "  %2d  %20d  %20d  %24.16f\n" , $i, $p[ $i ], $q[ $i ], $t);
}
}

function i8vec_print( $n, $a, $title )
{
#*****************************************************************************80;
#
## I8VEC_PRINT prints an I8VEC.
#
#  Licensing
#
#    This code is distributed under the GNU LGPL license.
#
#  Modified
#
#    09 August 2017
#
#  Author
#
#    John Burkardt
#
#  Parameters
#
#    Input, integer N, the dimension of the vector.
#
#    Input, integer A(N), the vector to be printed.
#
#    Input, string TITLE, a  title.
#
  print( "" );
  print( $title );
  print( "" );
foreach( range( 0, $n-1 ) as $i )
{    printf( "%6d  %6d\n" , $i, $a[ $i ] );
}
}
 

function i8vec_print_test()
{
#*****************************************************************************80;
#
## I8VEC_PRINT_TEST tests I8VEC_PRINT.
#
#  Licensing
#
#    This code is distributed under the GNU LGPL license.
#
#  Modified
#
#    09 August 2017
#
#  Author
#
#    John Burkardt
#
  
  

  print( "" );
  print( "I8VEC_PRINT_TEST\n" );
  print( "  I8VEC_PRINT prints an I8VEC.\n" );

  $n = 3;
  $v = array( 123456789, 1234567890987654321, -7  );
  i8vec_print( $n, $v, "  Here is an I8VEC:\n" );
#
#  Terminate.
#
  print( "" );
  print( "I8VEC_PRINT_TEST:\n" );
  print( "  Normal end of execution.\n" );
 
}

function r8_to_i4scf( $r, $n )
{
#*****************************************************************************80;
#
## R8_TO_I4SCF approximates an R8 with an I4 simple continued fraction.
#
#  Discussion
#
#    The simple continued fraction with real coefficients is
#
#      SCF = A(0) + 1 /( A(1) + 1 /( A(2) ... + 1 / A(N) ) );
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
#    Norman Richert,
#    Strang's Strange Figures,
#    American Mathematical Monthly,
#    Volume 99, Number 2, February 1992, pages 101-107.
#
#  Parameters
#
#    Input, real R, the real value.
#
#    Input, integer N, the number of convergents to compute.
#
#    Output, integer A(0:N), the partial quotients.
#
  

  //$a = np.zeros( $n + 1, dtype = np.int32 );
 $a = array_fill( 0, $n+1, 0 );
  if( $r == 0.0 )
{    return  $a;
}

  $r2 = $r;
   $a[0] = intval( $r2 );

foreach( range( 1, $n /*+ 1*/ ) as $i )
{    
	$r2 = 1.0 /( $r2 - (double)( $a[ $i - 1 ] ) );
    $a[ $i ] = intval( $r2 );
}

  return $a;
}

function r8_to_i4scf_test()
{
#*****************************************************************************80;
#
## R8_TO_I4SCF_TEST tests R8_TO_I4SCF.
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
  

  $n = 19;

  print( "" );
  print( "R8_TO_I4SCF_TEST:\n" );

  $r = pi();

  $a = r8_to_i4scf( $r, $n );

  i4vec_print( $n /*+ 1*/, $a, "  SCF coefficients:\n" );

  list( $p, $q ) = i4scf_evaluate( $n, $a );

  print( "" );
  print( "  SCF numerators, denominators, ratios:\n" );
  print( "" );

foreach( range( 0, $n /*+ 1*/ ) as $i )
{    $t = (double)( $p[ $i ] ) / (double)( $q[ $i ] );
    printf( "  %2d  %12d  %12d  %24.16f\n" , $i, $p[ $i ], $q[ $i ], $t);
}
}

function r8_to_i8scf( $r, $n )
{
#*****************************************************************************80;
#
## R8_TO_I8SCF approximates an R8 with an I8 simple continued fraction.
#
#  Discussion
#
#    The simple continued fraction with real coefficients is
#
#      SCF = A(0) + 1 /( A(1) + 1 /( A(2) ... + 1 / A(N) ) );
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
#    Norman Richert,
#    Strang's Strange Figures,
#    American Mathematical Monthly,
#    Volume 99, Number 2, February 1992, pages 101-107.
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
{    return  $a ;
}
  $r2 = $r;
   $a[0] = intval( $r2 );

foreach( range( 1, $n /*+ 1*/ ) as $i )
{    
	$r2 = 1.0 /( $r2 - (double)( $a[ $i - 1 ] ) );
    $a[ $i ] = intval( $r2 );
}
  return  $a;
} 

function r8_to_i8scf_test()
{
#*****************************************************************************80;
#
## R8_TO_I8SCF_EVALUATE_TEST tests R8_TO_I8SCF.
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
  

  $n = 19;

  print( "" );
  print( "R8_TO_I8SCF_TEST:\n" );

  $r = pi();

  $a = r8_to_i8scf( $r, $n );

  i8vec_print( $n /*+ 1*/, $a, "  SCF coefficients:\n" );

  list( $p, $q ) = i8scf_evaluate( $n, $a );

  print( "" );
  print( "  SCF numerators, denominators, ratios:\n" );
  print( "" );

foreach( range( 0, $n /*+ 1*/ ) as $i )
{    $t = (double)( $p[ $i ] ) / (double)( $q[ $i ] );
    printf( "  %2d  %20d  %20d  %24.16f\n" , $i, $p[ $i ], $q[ $i ], $t);
}
}

function r8cf_evaluate( $n, $a, $b )
{
#*****************************************************************************80;
#
## R8CF_EVALUATE evaluates a continued fraction with R8 entries.
#
#  Discussion
#
#    For convenience, we omit the parentheses or multiline display.
#
#    CF = A(0) + B(1) / A(1) + B(2) / A(2) + ... A(N-1) + B(N) / A(N).
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
#  Parameters
#
#    Input, integer N, the number of terms.
#
#    Input, real A(0:N), B(0:N), the continued fraction
#    terms.
#
#    Output, real P(0:N), Q(0:N), the numerators
#    and denominators of the successive partial sums of the continued
#    fraction.
#
  

 // $p = np.zeros( $n + 1, dtype = np.float64 );
 // $q = np.zeros( $n + 1, dtype = np.float64 );

foreach( range( 0, $n /*+ 1*/ ) as $i )
{
    if( $i == 0 )
{      $p[ $i ] =  $a[ $i ] * 1.0 + 0.0;
      $q[ $i ] =  $a[ $i ] * 0.0 + 1.0;
}    elseif( $i == 1 )
{      $p[ $i ] =  $a[ $i ] * $p[ $i - 1 ] +  $b[ $i ] * 1.0;
      $q[ $i ] =  $a[ $i ] * $q[ $i - 1 ] +  $b[ $i ] * 0.0;
}    else
{      $p[ $i ] =  $a[ $i ] * $p[ $i - 1 ] +  $b[ $i ] * $p[ $i - 2 ];
      $q[ $i ] =  $a[ $i ] * $q[ $i - 1 ] +  $b[ $i ] * $q[ $i - 2 ];
}
}
  return array( $p, $q );
}

function r8cf_evaluate_test()
{
#*****************************************************************************80;
#
## R8CF_EVALUATE_TEST tests R8CF_EVALUATE.
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
  

  $n = 20;

  print( "" );
  print( "R8CF_EVALUATE_TEST:\n" );

 // $a = np.zeros( $n + 1, dtype = np.float64 );
   $a[0] = 3.0;
   for( $i = 1; $i <= $n; $i++ ) $a[$i] = 6.0;

   //$b  = np.zeros( $n + 1, dtype = np.float64 );
   $b[0] = 0.0;
foreach( range( 1, $n /*+ 1*/ ) as $i )
{    $t = (double)( 2 * $i - 1 );
     $b[ $i ] = $t * $t;
}
  list( $p, $q ) = r8cf_evaluate( $n, $a, $b );

  print( "" );
  print( "  CF numerators, denominators, ratios:\n" );
  print( "" );

foreach( range( 0, $n /*+ 1*/ ) as $i )
{    printf( "  %2d  %28.0f  %28.0f  %24.16f\n", $i, $p[ $i ], $q[ $i ], $p[ $i ] / $q[ $i ] );
}
}

function r8scf_evaluate( $n, $a )
{
#*****************************************************************************80;
#
## R8SCF_EVALUATE evaluates a simple continued fraction with R8 entries.
#
#  Discussion
#
#    The simple continued fraction with real coefficients is
#
#      SCF = A(0) + 1 /( A(1) + 1 /( A(2) ... + 1 / A(N) ) );
#
#    This routine returns the N successive approximants P[ i ]/Q[ i ];
#    to the value of the rational number represented by the continued
#    fraction, with the value exactly equal to the final ratio C(N)/D(N).
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
#  Parameters
#
#    Input, integer N, the number of continued fraction
#    coefficients.
#
#    Input, real A(0:N), the continued fraction coefficients.
#
#    Output, real P(0:N), Q(0:N), the numerators and
#    denominators of the successive approximations.
#
  

 // $p = np.zeros( $n + 1, dtype = np.float64 );
  //$q = np.zeros( $n + 1, dtype = np.float64 );

foreach( range( 0, $n /*+ 1*/ ) as $i )
{
    if( $i == 0 )
{      $p[ $i ] =  $a[ $i ] * 1.0 + 0.0;
      $q[ $i ] =  $a[ $i ] * 0.0 + 1.0;
}    elseif( $i == 1 )
{      $p[ $i ] =  $a[ $i ] * $p[ $i - 1 ] + 1.0;
      $q[ $i ] =  $a[ $i ] * $q[ $i - 1 ] + 0.0;
}    else
{      $p[ $i ] =  $a[ $i ] * $p[ $i - 1 ] + $p[ $i - 2 ];
      $q[ $i ] =  $a[ $i ] * $q[ $i - 1 ] + $q[ $i - 2 ];
}
}
  return array( $p, $q );
}

function r8scf_evaluate_test()
{
#*****************************************************************************80;
#
## R8SCF_EVALUATE_TEST tests R8SCF_EVALUATE.
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
  

  $n = 19;

  $a = array( 
    3.0, 7.0, 15.0, 1.0, 292.0, 
    1.0, 1.0, 1.0, 2.0,  1.0, 
    3.0, 1.0, 14.0, 2.0,  1.0, 
    1.0, 2.0, 2.0, 2.0,  2.0 );

  print( "" );
  print( "R8SCF_EVALUATE_TEST:\n" );

  list( $p, $q ) = r8scf_evaluate( $n, $a );

  print( "" );
  print( "  SCF numerators, denominators, ratios:\n" );
  print( "" );

foreach( range( 0, $n /*+ 1*/ ) as $i )
{    printf( "  %2d  %20f  %20f  %24.16f\n", $i, $p[ $i ], $q[ $i ], $p[ $i ] / $q[ $i ] );
}
}

function r8vec_print( $n, $a, $title )
{
#*****************************************************************************80;
#
## R8VEC_PRINT prints an R8VEC.
#
#  Licensing
#
#    This code is distributed under the GNU LGPL license.
#
#  Modified
#
#    31 August 2014
#
#  Author
#
#    John Burkardt
#
#  Parameters
#
#    Input, integer N, the dimension of the vector.
#
#    Input, real A(N), the vector to be printed.
#
#    Input, string TITLE, $a  title.
#
  print( "" );
  print( $title );
  print( "" );
foreach( range( 0, $n-1 ) as $i )
{    
	printf( "%6d:  %12g" , $i, $a[ $i ] );
}
}

function r8vec_print_test()
{
#*****************************************************************************80;
#
## R8VEC_PRINT_TEST tests R8VEC_PRINT.
#
#  Licensing
#
#    This code is distributed under the GNU LGPL license.
#
#  Modified
#
#    29 October 2014
#
#  Author
#
#    John Burkardt
#
  
  

  print( "" );
  print( "R8VEC_PRINT_TEST\n" );
  print( "  R8VEC_PRINT prints an R8VEC.\n" );

  $n = 4;
  $v = array( 123.456, 0.000005, -1.0E+06, 3.14159265 );
  r8vec_print( $n, $v, "  Here is an R8VEC:\n" );
#
#  Terminate.
#
  print( "" );
  print( "R8VEC_PRINT_TEST:\n" );
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

function continued_fraction_test()
{
#*****************************************************************************80;
#
## CONTINUED_FRACTION_TEST tests the CONTINUED_FRACTION library.
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
  print( "" );
  print( "CONTINUED_FRACTION_TEST:\n" );
  //print( "  PHP version ".phpversion()."\n" );
  print( "  CONTINUED_FRACTION is a library for dealing with" );
  print( "  expresssions representing a continued fraction.\n" );

  i4cf_evaluate_test();
  i4scf_evaluate_test();
  i8cf_evaluate_test();
  i8scf_evaluate_test();
  r8_to_i4scf_test();
  r8_to_i8scf_test();
  r8cf_evaluate_test();
  r8scf_evaluate_test();
#
#  Terminate.
#
  print( "" );
  print( "CONTINUED_FRACTION_TEST:\n" );
  print( "  Normal end of execution.\n" );
}

{  
  timestamp();
  continued_fraction_test();
  timestamp();
}
