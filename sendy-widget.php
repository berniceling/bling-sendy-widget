<?php
/*
  Plugin Name: Bling Sendy Widget
  Description: A Widget customized for Neyrinck use. It allows users to subscribe to newsletter via Sendy
  Author: Bernice Ling
 */

add_action( 'widgets_init', 'register_Sendy_widget' );

function register_Sendy_widget() {
    register_widget( 'Sendy_Widget' );
}


/**
 * Adds Sendy_Widget widget.
 */
class Sendy_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'sendy_widget', // Base ID
			'Sendy Widget', // Name
			array( 'description' => __( 'A simple Widget to integrate Sendy', 'sendywidget' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
                ?>

                   <script type="text/javascript">


                       function validate_sendy_form(){

                       		// jQuery("#captcha").show();
                       		// return;
                       		
                             var email_id=document.getElementById('subscriber-email').value;

                             var filter = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;

                             valid= String(email_id).search (filter) != -1;

                            if(!valid){

                                alert('Please enter a valid email address');

                                return false;
                            }
                            else{
                                return true;
                            }
                       }


                </script>

          
                <form id="subscribe-form" action="/newsletter-subscription">
                  <?php if($instance['hidename']!='on'){ ?>
                    <label for="name">Name</label><br/>
                    <input type="text" name="name" id="subscriber-name"/>
                    <br/>
                    <?php } ?>
                    <!-- <label for="email">Email</label><br/> -->
                    <div style='float:right;'>
                    <input class='footer_email_subscribe'  type="submit" name="sub-submit" value="Subscribe"  id="sub-submit"/>
                   
                    <!--<input class="footer_email" type="text" name="email" id="subscriber-email" placeholder='YOUR EMAIL ADDRESS'/>
                    </div>-->
                   <!--  <br/> -->
                    
                    
                </form>




	<?php	echo $after_widget;

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
                $instance['sendyurl'] = strip_tags( $new_instance['sendyurl'] );
                $instance['listid'] = strip_tags( $new_instance['listid'] );
                 $instance['hidename'] = strip_tags( $new_instance['hidename'] );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( ' ', 'sendywidget' );
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Heading:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
                </p><p>
                <label for="<?php echo $this->get_field_id( 'sendyurl' ); ?>"><?php _e( 'Sendy Url:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'sendyurl' ); ?>" name="<?php echo $this->get_field_name( 'sendyurl' ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'sendyurl' ] ); ?>" />
                 </p><p>
                <label for="<?php echo $this->get_field_id( 'listid' ); ?>"><?php _e( 'List ID:' ); ?></label>
		<input class="text" id="<?php echo $this->get_field_id( 'listid' ); ?>" name="<?php echo $this->get_field_name( 'listid' ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'listid' ] ); ?>" />
                </p><p>

                <input class="checkbox" id="<?php echo $this->get_field_id( 'hidename' ); ?>" name="<?php echo $this->get_field_name( 'hidename' ); ?>" type="checkbox"  <?php echo ($instance[ 'hidename' ]=='on')?'checked="checked"':'' ; ?>  />
                <label for="<?php echo $this->get_field_id( 'hidename' ); ?>"><?php _e( 'Hide Name' ); ?></label>

                </p>
		<?php
	}

} // class Sendy_Widget