<?php
/**
 * WordPress Shortcode Boilerplate.
 *
 * Shortcode functions accepts the following parameters:
 *
 * $atts (array) : When a user writes a shortcode into their WordPress post
 * which triggers your shortcode function, any attributes they assign to that
 * shortcode will be passed as an associative array to your function. For
 * example the shortcode [caption caption="foobar"] would result in an $atts
 * being assigned the associative array "array( 'caption' => 'foobar')"
 *
 * $content (string) : The content of the shortcode.  Like HTML tags a
 * shortcode can be either self-terminating (like the <img/> tag) or provide
 * opening and closing tags (like <p>...</p>). When a shortcode provides an
 * opening and closing tag, $content is assigned the data between the tags.
 * For example if we write the following shortcode [caption]This is the
 * content of my shortcode[/caption], $content would be assigned the string
 * "This is the content of my shortcode"
 *
 * $tag (string) : The name of the shortcode that triggered the function.
 * Multiple shortcodes can actually be assigned the same function, and $tag
 * allows us to determine programmatically which shortcode triggered the
 * function. For example we might create a function called headers() and
 * assign it to the shortcodes h1, h2, h3, h4, h5, h6. Using the shortcode
 * [h1]...[/h1] would call headers() with $tag being assigned the value "h1",
 * [h2]...[/h2] would call headers() with $tag being assigned the value "h2",
 * etc.
 *
 * Shortcode functions return a value. They do not output text.
 *
 * @param array  $atts    Attributes assigned to the shortcode.
 * @param string $content The text between the opening and closing tags.
 * @param string $tag     The shortcode tag that triggered the function.
 *
 * @return string Returns the text generated by the shortcode.
 */
function shortcode_func( $atts, $content = null, $tag = '' )
{
	/*
	 * The following lines utilize the shortcode_atts() WordPress function
	 * to mix-in default values for your shortcode's attributes.  For
	 * example if your shortcode accepts an attribute named "foo" it will
	 * be assigned the value "something" if the user did not specify a
	 * value.
	 *
	 * The PHP extract() function is then used to convert the shortcode's
	 * attributes into local variables. So we can refer to the "foo"
	 * attribute by checking the variable $foo rather than referring to
	 * $atts['foo'].
	 */
	extract( shortcode_atts( array(
		'foo' => 'something',
		'bar' => 'something else'
	), $atts ) );

	/*
	 * This is where we do custom processing for our shortcode. I'm just
	 * assigning the variable $html the content of the shortcode. The code
	 * that falls here is totally up to you.
	 */
	$html = $content;

	/*
	 * Process any nested shortcodes and return our processed data. If your
	 * shortcode has a start and end tag and contains content, this step is
	 * neccessary, otherwise nested shortcodes may display unprocessed to
	 * your readers!
	 */
	return do_shortcode( $html );
}

/*
 * Use the WordPress add_shortcode() function to register a shortcode with
 * WordPress. The first parameter specifies the shortcode tag that will be
 * used to trigger your function. The second parameter specifies the name
 * of the function to call when the shortcode is encountered.
 */
add_shortcode( '_shortcode', 'shortcode_func' );

/**
 * ================================================================
 *  Hipster Ipsum
 * ================================================================
 */
function shortcode_hipsteripsum( $atts, $content = null, $tag = '' )
{
  $endpoint = 'http://hipsterjesus.com/api/';

  $options = shortcode_atts( array(
		'paras' => '4',  // [1 - 99] (default 4)
		'type' => 'hipster-latin',  // ['hipster-latin', 'hipster-centric']
		'html' => 'true', // strips html from output, replaces p tags with newlines
		'headings' => 'false' // display headings above paragraphs?
	), $atts );

  //print_r($endpoint . '?' . http_build_query($options));die();

  $response = json_decode(file_get_contents( $endpoint . '?' . http_build_query($options) ));
	/*
	 * This is where we do custom processing for our shortcode. I'm just
	 * assigning the variable $html the content of the shortcode. The code
	 * that falls here is totally up to you.
	 */
  if( $options['headings'] == 'true' || $options['headings'] == '1')
  	$html = str_replace('<p>', '<h3>Sample Heading</h3><p>', $response->text);
  else
  	$html = $response->text;

	/*
	 * Process any nested shortcodes and return our processed data. If your
	 * shortcode has a start and end tag and contains content, this step is
	 * neccessary, otherwise nested shortcodes may display unprocessed to
	 * your readers!
	 */
	return do_shortcode( $html );
}

/*
 * Use the WordPress add_shortcode() function to register a shortcode with
 * WordPress. The first parameter specifies the shortcode tag that will be
 * used to trigger your function. The second parameter specifies the name
 * of the function to call when the shortcode is encountered.
 */
add_shortcode( 'hipsteripsum', 'shortcode_hipsteripsum' );