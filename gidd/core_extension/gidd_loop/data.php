<?php

$loop = array(	'readmore' => array( 'text' => 'Read more &raquo;', 'class' => '' ),
				'header'	=> array( 'title' => '', 'author' => 'by: ',
									  'comment' => array( "No Comments", "1 Comment", "% Comments", "", "Comments off" ) ),
				'footer' 	=> array( 'date' => array('text' => '', 'format' => 'F jS, Y') ),
				'clear'		=> "",
				'content'	=> "the_excerpt",
				'thumbnail'	=> array( 'position' => 'before-title', 
									  'dimension' => array( 'width' => 160, 'height' => 120 ), 
									  'link' => "show-link" ),
				'paged'		=> "show-paged",
				"context"	=> "",
				"pagename"	=> "",
				"args"		=> "",
		);
		
___registry( 'gidd_loop', ___data( $loop ) );

unset ( $loop );

/** end */