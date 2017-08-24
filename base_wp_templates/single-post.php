<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage NJI Media 2017
 * @since NJI Media 1.0
 */

get_header(); 

setup_postdata($post);
$options = set_default_options();

// Display Banner
$options['template'] = '01_atoms/section-start.php';
$options = load_content( $options );
$image_sizes = '100vw';
if(!empty(get_field('custom_banner'))){
	$options['attributes'] = get_preview(get_field('custom_banner'));
	$options['img'] = get_src_set(get_field('custom_banner'), $image_sizes);
} elseif(!empty(get_the_post_thumbnail())) {
	$options['img'] = get_featured_src_set($post, $image_sizes);
}else{
	$options['attributes'] = get_preview(get_field('default_banner', 'options'));
	$options['img'] = get_src_set(get_field('default_banner', 'options'), $image_sizes);
}
$options['template'] = '02_molecules/hero.php';
$options = load_content( $options );
$options['template'] = '01_atoms/section-end.php';
$options = load_content( $options );
// End Display Banner

// Display Post Heading
$author = njimedia2017_build_author($post);
$date = get_the_date('F jS, Y');
$highlight_text = njimedia2017_build_highlight($post);
$icon = new simple_element('', 'fa fa-user', 'i', 'aria-hidden="true"' );
$author = new simple_element($icon->render().$author, 'author italic label capitalize');
$icon->set_classes('fa fa-calendar-o');
$date = new simple_element($icon->render().$date, 'date italic label capitalize');
$meta_data = new simple_element($author->render().$date->render(), ' meta-data justify -column ');
$highlight = new simple_element($highlight, ' color -brand bold capitalize label  text ');
$pre_heading = new simple_element(get_field('post_label'),' label italic capitalize  text');
$heading = new simple_element($post->post_title, '', 'h1');
$heading_section = new content_section($highlight->render().$pre_heading->render().$heading->render(), ' blogpost-heading background -gray-light ');
$heading_section->customize_content('inner', 'classes', ' justify -wrap '); 
$heading_section->customize_content('container', 'classes', ' justify width -space-between -large ');
$heading_section->customize_content('container', 'content', $meta_data->render());
print $heading_section->render();
// End Display Post Heading

// Display Content
$ghost_text = new simple_element(get_the_date('n/j'),' capitalize color -gray-light ', 'h1');
$ghost_section = new content_section($ghost_text->render(), ' ghost-text -vertical ');
$main_content = new simple_element($post->post_content, ' text width -narrow ');
$main_section = new content_section($main_content->render(), ' main-content ');
print $ghost_section->render();
print $main_section->render();
// End Display Content

// Start Custom Content Sections
$options['post'] = $post;
$options['template'] = '03_cells/content-sections.php';
$options = load_content( $options );
// end Custom Content Sections

// Start Pagination Section
while ( have_posts() ) :
	the_post();
	$previous = new simple_element('Previous Post', 'pager -prev color -brand capitalize bold text -arrow ', 'span', '', get_permalink(c2c_get_previous_or_loop_post()));
	$next = new simple_element('Next Post', 'pager -next color -brand capitalize bold text -arrow ', 'span', '', get_permalink(c2c_get_next_or_loop_post()));
endwhile;
$pagination_section = new content_section($previous->render().$next->render(), 'pagination border width -gray-medium-light -solid -large -top ');
$pagination_section->customize_content('inner', 'classes', 'justify -space-between ');
print $pagination_section->render();
// End Pagination Section

get_footer();
?>