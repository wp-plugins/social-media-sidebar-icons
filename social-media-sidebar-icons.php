<?php
/**
* Plugin Name: Social Media Sidebar Icons
* Plugin URI: http://www.maucher-online.com
* Description: WP Social Media ermöglicht das Einfügen von Youtube, Twitter, Facebook und Google+ als Widget in der Sidebar oder in anderen Widget Bereichen.
* Version: 0.1
* Author: David Maucher
* Author URI: http://www.maucher-online.com
* License: GPL2
**/

add_action('widgets_init', 'socialbuttons');
	function socialbuttons() {
		register_widget('Social_Buttons');
	}
//function wp_social_buttons_styles() {
	wp_enqueue_style( 'social-buttons', plugins_url( 'style.css', __FILE__ ) );
	wp_enqueue_style( 'fontawesome', plugins_url( '/font-awesome-4.3.0/css/font-awesome.min.css', __FILE__ ) );
//}
//add_action('wp_head', 'wp_social_buttons_styles');

if ( is_admin() ) {
	wp_enqueue_style( 'social-admin', plugins_url( 'admin-style.css', __FILE__ ) );
}
class Social_Buttons extends WP_Widget {
	function __construct(){
		parent::__construct(
			'social-buttons',
			'Social Buttons',
			array( 'description' => 'Einfach die URL Ihrer Kanäle eintragen und das Widget auf Ihrer Webseite platzieren.' )
		);
	}
	function widget( $args, $instance ) {
		if ($instance['widget-class'] == "round-coloured" || 
			$instance['widget-class'] == "round-black" ) 
		{
			$facebook = "<i class='fa fa-facebook-square'></i>";
			$twitter = "<i class='fa fa-twitter-square'></i>";
			$googleplus = "<i class='fa fa-google-plus-square'></i>";
			$youtube = "<i class='fa fa-youtube-square'></i>";
		} 

		elseif ( $instance['widget-class'] == "corners-coloured" ) 
		{
			$facebook = "<span class='fa-stack fa-lg'>
							<i class='fa fa-stop fa-stack-2x'></i>
							<i class='fa fa-facebook fa-stack-1x fa-inverse'></i>
						</span>";
			$twitter = "<span class='fa-stack fa-lg'>
							<i class='fa fa-stop fa-stack-2x'></i>
							<i class='fa fa-twitter fa-stack-1x fa-inverse'></i>
						</span>";
			$googleplus = "<span class='fa-stack fa-lg'>
							<i class='fa fa-stop fa-stack-2x'></i>
							<i class='fa fa-google-plus fa-stack-1x fa-inverse'></i>
						</span>";
			$youtube = "<span class='fa-stack fa-lg'>
							<i class='fa fa-stop fa-stack-2x'></i>
							<i class='fa fa-youtube fa-stack-1x fa-inverse'></i>
						</span>";
		}
		elseif ( $instance['widget-class'] == "corners-black" ) 
		{
			$facebook = "<span class='fa-stack fa-lg'>
							<i class='fa fa-stop fa-stack-2x'></i>
							<i class='fa fa-facebook fa-stack-1x fa-inverse'></i>
						</span>";
			$twitter = "<span class='fa-stack fa-lg'>
							<i class='fa fa-stop fa-stack-2x'></i>
							<i class='fa fa-twitter fa-stack-1x fa-inverse'></i>
						</span>";
			$googleplus = "<span class='fa-stack fa-lg'>
							<i class='fa fa-stop fa-stack-2x'></i>
							<i class='fa fa-google-plus fa-stack-1x fa-inverse'></i>
						</span>";
			$youtube = "<span class='fa-stack fa-lg'>
							<i class='fa fa-stop fa-stack-2x'></i>
							<i class='fa fa-youtube fa-stack-1x fa-inverse'></i>
						</span>";
		}
		echo $args['before-widget'];
		echo "<div class='social-widget " .$instance['widget-class'] ."'>";
		echo $args['before-title'] .apply_filters( 'widget-title', '<h2>' .$instance['title'] .'</h2>' ) .$args['after-title'];
		echo "<br />";
		echo "<ul>";
		echo "<li><a href='" .$instance['facebook'] ."'> $facebook </a></li>";
		echo "<li><a href='" .$instance['twitter'] ."'> $twitter </a></li>";
		echo "<li><a href='" .$instance['googleplus'] ."'> $googleplus </a></li>";
		echo "<li><a href='" .$instance['youtube'] ."'> $youtube </a></li>";
		echo "</ul>";
		echo "</div>";
		echo $args['after-widget'];
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['facebook'] = $new_instance['facebook'];
		$instance['twitter'] = $new_instance['twitter'];
		$instance['googleplus'] = $new_instance['googleplus'];
		$instance['youtube'] = $new_instance['youtube'];
		$instance['widget-class'] = $new_instance['widget-class'];
		return $instance; 
	}
	function form( $instance ) {
		$defaults = array(  'title' => 'Überschrift eintragen...',
							'facebook' => 'Facebook URL',
							'twitter' => 'Twitter URL',
							'googleplus' => 'Google+ URL',
							'youtube' => 'Youtube URL',
							'widget-class' => 'Style'
						 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<div class="social-button-input">
			<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Überschrift: </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"></p>
			
			<p><label for="<?php echo $this->get_field_id( 'facebook' ); ?>">Facebook URL: </label>
			<input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>"></p>
			
			<p><label for="<?php echo $this->get_field_id( 'twitter' ); ?>">Twitter URL: </label>
			<input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>"></p>
			
			<p><label for="<?php echo $this->get_field_id( 'googleplus' ); ?>">Google+ URL: </label>
			<input id="<?php echo $this->get_field_id( 'googleplus' ); ?>" name="<?php echo $this->get_field_name( 'googleplus' ); ?>" value="<?php echo $instance['googleplus']; ?>"></p>
			
			<p><label for="<?php echo $this->get_field_id( 'youtube' ); ?>">Youtube URL: </label>
			<input id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>"></p>
			<p>
				<label for="<?php echo $this->get_field_id( 'widget-class' ); ?>">Style wählen: </label>
				<select 
						id="<?php echo $this->get_field_id( 'widget-class' ); ?>" 
						name="<?php echo $this->get_field_name( 'widget-class' ); ?>" >
						<option <?php if($instance['widget-class'] == "round-coloured") echo "selected='selected'"; ?>value="round-coloured">Rund &amp; farbig</option>
						<option <?php if($instance['widget-class'] == "round-black") echo "selected='selected'"; ?>value="round-black">Rund &amp; schwarz</option>
						<option <?php if($instance['widget-class'] == "corners-coloured") echo "selected='selected'"; ?>value="corners-coloured">Eckig &amp; farbig</option>
						<option <?php if($instance['widget-class'] == "corners-black") echo "selected='selected'"; ?>value="corners-black">Eckig &amp; schwarz</option>
				</select>
			</p>
		</div>
	<?php
	}
}
?>