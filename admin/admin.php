<?php

/*********************** dashboard settings (add plugin to dashboard) ***********************/
//add_menu_page( string $page_title(require), string $menu_title(require), string $capability(require), string $menu_slug(require), callable $callback = '', string $icon_url = '', int|float $position = null ): string

function saint_views_settings() {
	add_menu_page(
		'Saint Views',
		'Saint Views',
		'manage_options',
		'saint-view',
		'saint_views_callback',
		'dashicons-welcome-view-site',
		70

	);
}
function saint_views_callback() { ?>

	<div class="wrap">
		<h1>Saint Views Settings </h1>
        <div class="tab">
            <ul class="tabs">
                <li class="active">
                    <a href="javascript:void(0)">
                        العرض
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        الصلاحيات
                    </a>
                </li>
            </ul> <!-- / tabs -->
            <form action="options.php" method="post">
                <!-- hidden input (security) -->
                <?php settings_fields('saint_views_global_settings');
                /** echo get_option('saint_views_word'); */
                $saint_viewing_position = get_option('viewing_place');
                ?>
                <div class="tab_content">
                    <div class="tabs_item">
                        <table class="form-table">
                            <tbody>
                                <tr>
                                    <th> تغيير الكلمة </th>
                                    <td>
                                        <input class="regular-text"
                                               type="text"
                                               name="saint_views_word"
                                               value="<?php echo get_option('saint_views_word'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th> تغيير الأيقونة </th>
                                    <td>
                                        <input class="regular-text icon_picker"
                                               type="text"
                                               name="saint_views_icon"
                                               placeholder="اضغط هنا"
                                               value="<?php echo get_option('saint_views_icon'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th> وضعية الظهور </th>
                                    <td>
                                        <fieldset>
                                            <label for="saint_views_top">
                                                <input  type="radio"
                                                        name="viewing_place"
                                                        id="saint_views_top"
                                                        value="saint_views_top"
                                                        <?php echo($saint_viewing_position == 'saint_views_top') ? 'checked' : ''; ?>
                                                >
                                                <span> أعلى </span>
                                                <code> قبل المحتوى </code>
                                            </label>
                                            <br>
                                            <label for="saint_views_bottom">
                                                <input  type="radio"
                                                        name="viewing_place"
                                                        id="saint_views_bottom"
                                                        value="saint_views_bottom"
                                                        <?php echo($saint_viewing_position == 'saint_views_bottom') ? 'checked' : ''; ?>
                                                >
                                                <span> أسفل </span>
                                                <code> بعد المحتوى </code>
                                            </label>
                                            <br>
                                            <label for="saint_views_both">
                                                <input  type="radio"
                                                        name="viewing_place"
                                                        id="saint_views_both"
                                                        value="saint_views_both"
                                                        <?php echo($saint_viewing_position == 'saint_views_both') ? 'checked' : ''; ?>
                                                >
                                                <span> أعلى وأسفل </span>
                                                <code> قبل وبعد المحتوى </code>
                                            </label>
                                            <br>
                                            <label for="saint_views_contain">
                                                <input  type="radio"
                                                        name="viewing_place"
                                                        id="saint_views_contain"
                                                        value="saint_views_contain"
                                                    <?php echo($saint_viewing_position == 'saint_views_contain') ? 'checked' : ''; ?>
                                                >
                                                <span> إخفاء عنصر المشاهدة من المحتوى </span>
                                            </label>
                                        </fieldset>
                                        <br>
                                        <p>
                                            <strong>توضيح: </strong>
                                            <span>اختر مكان ظهور العداد في المحتوى أو إخفاءه</span>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tabs_item">
                        <table class="form-table">
                            <tbody>
                                <fieldset>
                                    <tr>
                                        <th> تمكين هذه الأنواع من المقالة </th>
                                        <td>
	                                        <?php
	                                        // Get post types
	                                        $args       = array(
		                                        'public' => true,
	                                        );
	                                        $post_types = get_post_types( $args, 'objects' );
	                                        ?>
                                            <fieldset>
                                                <legend class="screen-reader-text">تمكين هذه الأنواع من المقالة</legend>
                                            <?php foreach ( $post_types as $post_type_obj ):
                                                $labels = get_post_type_labels( $post_type_obj );
                                                ?>
                                                <input type="checkbox"
                                                       name="duplicate_post_types_enabled[]"
                                                       id="saint-<?php echo esc_attr( $post_type_obj->name ); ?>"
                                                       value="<?php echo esc_attr( $post_type_obj->name ); ?><?php echo esc_html( $labels->name ); ?>"
	                                                <?php checked('1') ?>
                                                >
                                                <label for="duplicate-post-post"><?php echo esc_attr( $post_type_obj->name ); ?></label>
                                                <br>
                                            <?php endforeach; ?>
                                                <p>
                                                    تحديد أنواع المقالات التي تريد من الإضافة تمكينها.
                                                    <br>
                                                    ما إذا كانت الروابط المعروضة لأنواع المقالة المخصصة المسجلة من جهة القوالب أو الإضافات يعتمد على استخدامها لعناصر واجهة مستخدم ووردبريس القياسية.
                                                </p>
                                            </fieldset>
                                        </td>
                                    </tr>
                                </fieldset>
                            </tbody>
                        </table>

                    </div>
                </div>
                <?php submit_button(); ?>
            </form>
        </div>
    </div>
	</div>

<?php }

add_action('admin_menu','saint_views_settings');



//register_setting( string $option_group, string $option_name, array $args = array() )
function saint_views_register_fields() {
	register_setting('saint_views_global_settings' ,'saint_views_word');
	register_setting('saint_views_global_settings' ,'viewing_place');
	register_setting('saint_views_global_settings' ,'saint_views_icon');
}
add_action('admin_init','saint_views_register_fields');






/*********************** icon-picker with External Plugin (@author Javi Aguilar)  ***********************/

 function add_scripts_to_admin() {
    wp_enqueue_style('icon_picker', plugin_dir_url(__FILE__) . 'assets/css/fontawesome-iconpicker.min.css');
    wp_enqueue_style('font-icon', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css');
	 wp_enqueue_style('style', plugin_dir_url(__FILE__) . 'assets/css/style.css');



    //    Js Files
    wp_enqueue_script('icon_picker', plugin_dir_url(__FILE__) . 'assets/js/fontawesome-iconpicker.min.js', array('jquery'), '1', true);
    wp_enqueue_script('saint-view-external', plugin_dir_url(__FILE__) . 'assets/js/saint-view-external.js', array('jquery'), '1', true);

 }

 add_action('admin_enqueue_scripts','add_scripts_to_admin'); /** admin_enqueue_scripts is responsible for style and scripts in admin */












