<?php
$title	= ___subpage( 'Site Title' );

//field
$general_title		= ___textarea( 'General Title', 'Set a general tile format' );
$home_title			= ___textarea( 'Home Title', 'Set title for homepage.' );
$post_title_format	= ___text( 'Post title format', 'Set title format for posts.' );
$page_title_format	= ___text( 'Page title format', 'Set title format for pages.' );
$cat_title_format	= ___text( 'Category title format', 'Set title format for categories.' );
$tag_title_format	= ___text( 'Tag title format', 'Set title format for tags.' );
$search_title_format= ___text( 'Search title format', 'Set title format for search.' );
$fof_title_format	= ___text( '404 title format', 'Set title format for 404 error page.' );
$paged_title_format	= ___text( 'Paged title format', 'Set paged title format.' );


//field value
$general_title->value = "%blog_name% - %blog_description%";
$home_title->value = "%blog_name% - %blog_description%";
$post_title_format->value = "%blog_name% - %post_title%";
$page_title_format->value = "%blog_name% - %page_title%";
$cat_title_format->value = "%blog_name% - %category_title%";
$tag_title_format->value = "%blog_name% - %tag_title%";
$search_title_format->value = "%blog_name% - %search%";
$fof_title_format->value = "%blog_name% - Page Not Found";
$paged_title_format->value = "- Part %paged%";


//array of fields
$arr_title = array(
					$general_title,
					$home_title, 
					$post_title_format,
					$page_title_format,
					$cat_title_format,
					$tag_title_format,
					$search_title_format,
					$fof_title_format,
					$paged_title_format
			);
				
					
___section( array ( 'Gidd SEO', 'g952d9bb5' ), $title, $arr_title, "<b>Title settings for search engines.</b>" );
unset( $arr_title );


/** end **/