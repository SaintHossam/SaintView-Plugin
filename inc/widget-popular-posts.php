<?php

class saint_views_widget_popular extends WP_Widget {

	public function __construct() {
		// actual widget processes

		parent::__construct(
			'saint_views_popular_posts',
			'Popular Posts',
			array( 'description' => __( 'description', 'Start pls' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		// outputs the content of the widget

		$posts = array(
			'numberposts'   =>  $instance['posts_number'],
            'meta_key'      =>  'num_views',
            'orderby'       =>  'meta_value_num',
            'order'         =>  $instance['posts_order'],
		);

		echo $args['before_widget'];
        echo $args['before_title'] . $instance['title'] . $args['after_title'];

		$popular_posts = get_posts($posts);

		foreach ($popular_posts as $post) { ?>

			<div class="row pb-3">
				<div class="col-5 align-self-center">
                    <img src="<?php echo get_the_post_thumbnail($post); ?>" alt="<?php the_title(); ?>" class="saint_most_trading">
                </div>
				<div class="col-7 paddding">
					<div class="most_saint_treding_font"><?php echo $post->post_title; ?></div>
					<div class="most_saint_treding_font_views">
                        <?php if($instance['show_counter'] == 1 ) { ?>
                            <i class="<?php echo get_option('saint_views_icon');?>"></i>
                            <?php echo get_views($post->ID); ?>
                        <?php } ?>

						<?php if($instance['show_date'] == 1 ) { ?>
                            <?php echo "-" . get_the_date("Y M d");?>
						<?php } ?>
                    </div>
				</div>
			</div>

		<?php }

		echo $args['after_widget'];
	}

	public function form( $instance ) {
		// outputs the options form in the admin

        $title = (isset($instance['title'])) ? $instance['title'] : "Popular Posts" ;

        $posts_number = (isset($instance['posts_number'])) ? $instance['posts_number'] : 6 ;

		$posts_order = (isset($instance['posts_order'])) ? $instance['posts_order'] : 'desc' ;

		$show_counter = (isset($instance['show_counter'])) ? $instance['show_counter'] : 0 ;

		$show_date = (isset($instance['show_date'])) ? $instance['show_date'] : 0 ;

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input type="text"
                   class="widefat"
                   name="<?php echo $this->get_field_name('title');  ?>"
                   id="<?php echo $this->get_field_id('title'); ?>"
                   value="<?php echo $title; ?>"
            >
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('posts_number'); ?>">Page Number:</label>
            <input type="number"
                   class="widefat"
                   name="<?php echo $this->get_field_name('posts_number');  ?>"
                   id="<?php echo $this->get_field_id('posts_number'); ?>"
                   value="<?php echo $posts_number; ?>"
                   min="1" max="10"
            >
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('posts_order'); ?>">Order:</label>
            <select
                    class="widefat"
                    name="<?php echo $this->get_field_name('posts_order'); ?>"
                    id="<?php echo $this->get_field_id('posts_order'); ?>">
                <option value="asc" <?php echo ($posts_order =='asc')? 'selected' :  '' ?>>ASC</option>
                <option value="desc" <?php echo ($posts_order =='desc')? 'selected' :  '' ?>>DESC</option>
            </select>
        </p>

        <p>
            <input type="checkbox"
                    name="<?php echo $this->get_field_name('show_counter'); ?>"
                    id="<?php echo $this->get_field_id('show_counter'); ?>"
                    value="1"
                    <?php checked('1', $show_counter) ?>
            >
            <label for="<?php echo $this->get_field_id('show_counter'); ?>">Show Counter:</label>
        </p>

        <p>
            <input type="checkbox"
                   name="<?php echo $this->get_field_name('show_date'); ?>"
                   id="<?php echo $this->get_field_id('show_date'); ?>"
                   value="1"
				<?php checked('1', $show_date) ?>
            >
            <label for="<?php echo $this->get_field_id('show_counter'); ?>">Show date:</label>
        </p>

	<?php }

	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
	}
}



function saint_views_register_widgets() {
	register_widget( 'saint_views_widget_popular' );
}

add_action( 'widgets_init', 'saint_views_register_widgets' );
