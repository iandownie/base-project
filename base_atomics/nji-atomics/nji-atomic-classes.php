<?php
/**
 * Defines the base element class
 * This base class should be extended by child classes in order to make more specific types of element builders
 * Build a new element by setting a $variable = new content_element([$arguments]). 
 * You can assign data to the element when initiating it, but you can also modify or fetch that data with the classes' various methods
 * When you are ready to print the content element call the ->render() method on it, and print the returned HTML.
 * Optionally, you can render the beginning and the end of the element separately, if you uneed to use it to wrap other content. 
 */
class basic_element {
	var $element, $classes, $attributes, $content, $url;
	function __construct($init_content = null, $init_classes = null, $init_element = 'div', $init_attributes = null, $init_url = null){
		$this->content = $init_content;
		$this->classes = $init_classes;
		$this->element = $init_element;
		$this->attributes = $init_attributes;
		$this->url = $init_url;
	}
	function add_classes($additional_classes){
		$this->classes .= " $additional_classes ";
	}
	function set_classes($new_classes){
		$this->classes = " $new_classes ";
	}
	function add_attributes($additional_attributes){
		$this->attributes .= " $additional_attributes ";
	}
	function add_url($additional_url){
		$this->url = $additional_url;
	}
	function add_content($additional_content){
		$this->content .= $additional_content;
	}
	function set_content($new_content){
		$this->content = $new_content;
	}
	function get_content(){
		return $this->content;
	}
	// By splitting up the start and end rendering, we can add additional contetn between those steps.
	function start_render(){
		$elem = $this->element;
		$classes = $this->classes;
		$attributes = $this->attributes;
		$content = $this->content;
		$url = $this->url;
		if(!empty($url)){
			$rendered_element = "<$elem class='$classes' $attributes ><a href='$url'>$content</a>";
		}else{
			$rendered_element = "<$elem class='$classes' $attributes >$content";
		}
		return $rendered_element;
	}
	function end_render(){
		$element = $this->element;
		$rendered_element = "</$element>";
		return $rendered_element;
	}
	function render(){
		$rendered_element = $this->start_render();
		$rendered_element .= $this->end_render();
		return $rendered_element;
	}
}

/**
 * Extends the base element class into a complex element builder
 * Complex elements are defiend here as elements with multiple other elements within them.
 */
class complex_element extends basic_element {
	// Allows us to change the properties of elements within the complex element with a single function.
	function customize_content($layer, $property, $data){
		$property = 'add_'.$property;
		$this->$layer->$property($data);
	}
}

/**
 * Extends the complex element class to specifically build Section elements
 * Section elements are intended to contain a content section. They consist of a full width Section element, a width-constraining .container element, and a height-constraining .inner element
 * The section's actual content is added to the .inner element.
 */
class content_section extends complex_element {
	var $id, $inner, $container, $container_content;
	function __construct($init_content = null, $init_classes = null, $init_element = 'section', $init_attributes = null, $init_url = null){
		$this->classes = $init_classes;
		$this->element = $init_element;
		$this->attributes = $init_attributes;
		$this->url = $init_url;
		$this->inner = new content_element($init_content, ' inner ');
		$this->container = new content_element('', ' container ');
	}
	function set_id($new_id){
		$this->id = $new_id;
	}
	function add_container_content($content){
		$this->container_content = $content;
	}
	function section_start_render(){
		$container_content = $this->container->get_content();
		$this->container->set_content($this->inner->render());
		$this->container->add_content($container_content);
		$this->set_content($this->container->start_render());
		return $this->start_render();
	}
	function section_end_render(){
		$rendered_element = $this->container->end_render();
		$rendered_element .= $this->end_render();
		return $rendered_element;
	}
	function render(){
		$rendered_element = $this->section_start_render();
		if(! empty($this->container_content)){
			$rendered_element .= $this->container_content;
		}
		$rendered_element .= $this->section_end_render();
		return $rendered_element;
	}
}
