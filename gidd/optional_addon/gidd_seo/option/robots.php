<?php
$robots	= ___subpage( 'Robots' );

//field
$noifadmin		= ___checkbox( 'Admin Layout', 'Apply noindex,nofollow to admin layout.' );
$nodp			= ___checkbox( 'Apply nodp to the site', 'Prevent search engines from looking up your site information at odp directory.' );
$nodir			= ___checkbox( 'Apply nodir to the site', 'Prevent search engines from looking up your site information at yahoo directory.' );
$noindex		= ___checkbox( 'Apply noindex to home page', 'Prevent home page from being indexed by search engines.' );
$nofollow		= ___checkbox( 'Apply nofollow to home page', 'Prevent search engines to follow links in home page. ' );
$noarchive		= ___checkbox( 'Apply noarchive to home page', 'Prevent home page from being cached by search engines.' );
$noindsearch	= ___checkbox( 'No indexing for search result archives', 'Prevent search engines to index search results.' );
$noindcat		= ___checkbox( 'No indexing for categories', 'Prevent search engines to index categories.' );
$noindtag		= ___checkbox( 'No indexing for tag archives', 'Prevent search engines to index tag archives.' );
$noindauthor	= ___checkbox( 'No indexing for author archives', 'Preent search engines to index author archives.' );
$noindattach	= ___checkbox( 'No indexing for attachment archives', 'Prevent search engines to index attachment archives.' );
$noindarchives	= ___checkbox( 'No indexing for archives', 'Prevent search engines to index archives.' );
$noinddate		= ___checkbox( 'No indexing for date based archives', 'Prevent search engines to index date based archives' );
$nofollowind	= ___checkbox( 'Add nofollow to all noindex archives', 'Add nofollow to all noindex archives.' );

//array of fields
$arr_robots	= array(
						$noifadmin,
						$nodp, 
						$nodir,
						$noindex,
						$nofollow,
						$noarchive,
						$noindsearch,
						$noindcat,
						$noindtag,
						$noindauthor,
						$noindattach,
						$noindarchives,
						$noinddate,
						$nofollowind
					);
					
					
___section( array ( 'Gidd SEO', 'g952d9bb5' ), $robots, $arr_robots, "<b>Robot settings for search engines.</b>" );
unset( $arr_robots );


/** end **/