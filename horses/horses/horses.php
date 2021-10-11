<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://1k-horse.com/
 * @since             1.0.0
 * @package           horses
 *
 * @wordpress-plugin
 * Plugin Name:       Лошади
 * Plugin URI:        https://sagittarius.group/
 * Description:       Удобный каталог лошадей.
 * Version:           1.0.0
 * Author:            Sagittarius Group (Дикое поле)
 * Author URI:        https://lasana.ru/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       horses
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
define( 'horses_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-horses-activator.php
 */
function activate_horses() {
require_once plugin_dir_path( __FILE__ ) . 'includes/class-horses-activator.php';
horses_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-horses-deactivator.php
 */
function deactivate_horses() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-horses-deactivator.php';
	horses_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_horses' );
register_deactivation_hook( __FILE__, 'deactivate_horses' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-horses.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_horses() {

	$plugin = new horses();
	$plugin->run();

}
run_horses();


/* Хочу сюда вставить функцию добавления пункта меню 
 * Когда плагин разрастётся и обрастёт настройками - они будут храниться здесь

add_action( 'admin_menu', 'admin_horse_menu' );
function admin_horse_menu() {
	add_menu_page('Лошади. Администрирование', 'Лошади', 'manage_options', 'horse-menu', 'horse_menu_options','dashicons-buddicons-activity', 22 );
	add_submenu_page('horse-menu', 'Настройки', 'Настройки', 'manage_options', 'horse-options', 'horse_menu_options',20);

}
function horse_menu_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '</pre>
<div class="wrap">';
 echo '
<h1>Лошади</h1>
<p>Добро пожаловать на страницу плагина <b>Лошади</b>!</p>
<p>Когда-нибудь я заменю это на отдельный файл и добавлю сюда опций. А пока кликайте по подпунктам слева</p>
';
 echo '</div>
<pre>
';
}
*/

// Лошадиные таксономии.
// Вначале регистрируются таксономии, а потом - тип, к которому они принадлежат

function create_horse_tax(){
	register_taxonomy( 'horse_tax', array ('horse'), [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => __( 'Категории лошадей', 'horses' ),
			'singular_name'     => __( 'Категория лошадей', 'horses' ),
			'search_items'      => __( 'Искать категорию', 'horses' ),
			'all_items'         => __( 'Все категории', 'horses' ),
			'view_item '        => __( 'Просмотреть категорию', 'horses' ),
			'parent_item'       => __( 'Родительская категория', 'horses' ),
			'parent_item_colon' => __( 'Родительская категория', 'horses' ),
			'edit_item'         => __( 'Редактировать категорию', 'horses' ),
			'update_item'       => __( 'Обновить категорию', 'horses' ),
			'add_new_item'      => __( 'Добавить новую категорию', 'horses' ),
			'new_item_name'     => __( 'Название новой категории', 'horses' ),
			'menu_name'         => __( 'Категории лошадей', 'horses' ),
		],
		'description'           => 'Категории лошадей: жеребцы, кобылы, мерины и т.п.', // описание таксономии
		'public'                => true,
	    'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_quick_edit'    => true, // равен аргументу show_ui
		'hierarchical'          => true,
		'rewrite'               => true,
		'query_var'             => 'horse_tax', // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box', 
		'show_admin_column'     => true, 
		'show_in_rest'          => true, 
		'rest_base'             => null, 
	] );
}
add_action( 'init', 'create_horse_tax',0 );	

function create_horse_breed_tax(){
	register_taxonomy( 'horse_breed', array ('horse'), [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => __( 'Породы лошадей', 'horses' ),
			'singular_name'     => __( 'Порода лошадей', 'horses' ),
			'search_items'      => __( 'Искать породу', 'horses' ),
			'all_items'         => __( 'Все породы', 'horses' ),
			'view_item '        => __( 'Просмотреть породу', 'horses' ),
			'parent_item'       => __( 'Родительская категория', 'horses' ),
			'parent_item_colon' => __( 'Родительская категория', 'horses' ),
			'edit_item'         => __( 'Редактировать породу', 'horses' ),
			'update_item'       => __( 'Обновить породу', 'horses' ),
			'add_new_item'      => __( 'Добавить новую породу', 'horses' ),
			'new_item_name'     => __( 'Название новой породы', 'horses' ),
			'menu_name'         => __( 'Породы лошадей', 'horses' ),
		],
		'description'           => 'Породы лошадей', // описание таксономии
		'public'                => true,
	    'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_quick_edit'    => true, // равен аргументу show_ui
		'hierarchical'          => true,
		'rewrite'               => true,
		'query_var'             => 'horse_breed', // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box', 
		'show_admin_column'     => true, 
		'show_in_rest'          => true, 
		'rest_base'             => null, 
	] );
}
add_action( 'init', 'create_horse_breed_tax',0 );	



// Соревнования	
function create_horse_race_tax(){ 
	register_taxonomy( 'horse_race', array ('horse'), [
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => [
			'name'              => __( 'Соревнования', 'horses' ),
			'singular_name'     => __( 'Соревнование', 'horses' ),
			'search_items'      => __( 'Искать соревнонвание', 'horses' ),
			'all_items'         => __( 'Все соревнования', 'horses' ),
			'view_item '        => __( 'Просмотреть соревнование', 'horses' ),
			'parent_item'       => __( 'Родительское соревнование', 'horses' ),
			'parent_item_colon' => __( 'Родительское соревнование', 'horses' ),
			'edit_item'         => __( 'Редактировать соревнование', 'horses' ),
			'update_item'       => __( 'Обновить соревнование', 'horses' ),
			'add_new_item'      => __( 'Добавить соревнование', 'horses' ),
			'new_item_name'     => __( 'Название соревнования', 'horses' ),
			'menu_name'         => __( 'Соревнования', 'horses' ),
		],
		'description'           => 'Соревнования: скачки, конкур, выездка', // описание таксономии
		'public'                => true,
	    'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_quick_edit'    => false, // равен аргументу show_ui
		'hierarchical'          => false,
		'rewrite'               => true,
		'query_var'             => 'horse_race', // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box', 
		'show_admin_column'     => true, 
		'show_in_rest'          => true, 
		'rest_base'             => null, 
	] );
}
add_action( 'init', 'create_horse_race_tax',0 );	
// Порода
// 

/* Хочу создать свой тип записей "лошадь"  */

function create_horse_posttype() {
    $labels = array(
        'name' => __( 'Лошади', 'horses' ),
        'singular_name' => __( 'Лошадь', 'horses' ),
        'menu_name' => __( 'Лошади', 'horses' ),
        'all_items' => __( 'Все лошади', 'horses' ),
        'view_item' => __( 'Просмотр карточки лошади', 'horses' ),
        'add_new_item' => __( 'Добавить лошадь', 'horses' ),
        'add_new' => __( 'Добавить новую особь', 'horses' ),
        'edit_item' => __( 'Редактировать карточку лошади', 'horses' ),
        'update_item' => __( 'Обновить карточку лошади', 'horses' ),
        'search_items' => __( 'Искать лошадь', 'horses' ),
        'not_found' => __( 'Не найдено', 'horses' ),
        'not_found_in_trash' => __( 'Не найдено в корзине', 'horses' ),
    );

    $args = array(
        'label' => __( 'Лошадь', 'horses' ),
        'description' => __( 'Каталог лошадей', 'horses' ),
        'labels' => $labels,
        'supports' => array( 'title', 'editor', 'thumbnail'),
        'taxonomies' => array( 'horse_tax', 'horse_race' ),
        'hierarchical' => false,
        'public' => true,
		'menu_position' => 22,
		'menu_icon' =>'dashicons-buddicons-activity',
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 25,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );

    register_post_type( 'horse', $args );

}
add_action( 'init', 'create_horse_posttype', 0 );


// Добавляем метабоксы к лошадям
// 
// ОБЩИЕ ДАННЫЕ
// 
// 1. Пол _horse_sex (0 - жеребец, 1 - кобыла, 2 - мерин если вдруг)
// 2. Порода _horse_breed из таксономий horse_breed
// 3. Тавро (текстовый) _horse_tavro
// 4. Год рождения (текстовый) horse_birthyear
// 5. Масть (текстовый) horse_coatcolor
// 6. Промеры (три числа) horse_height, horse_width, horse_depth


add_action('add_meta_boxes', 'horse_info_metabox_init'); 
add_action('save_post', 'horse_info_metabox_save'); 

function horse_info_metabox_init() { 
add_meta_box('info_metabox', 'Общие данные', 'horse_info_metabox_showup', 'horse', 'advanced', 'default'); 
} 

function horse_info_metabox_showup($post, $box) { 

$horse_sex = get_post_meta($post->ID, '_horse_sex', true);
if(!isset($horse_sex)) $horse_sex=0;
	
$horse_breed = get_post_meta($post->ID, '_horse_breed', true);
if ((isset($horse_breed))&&($horse_breed>0))
{$br = get_term($horse_breed, 'horse_breed');
 $horse_breedname = $br->name;
}
 else
 {$horse_breed=0;
  $horse_breedname='Выберите породу из списка';}
	
$horse_tavro = get_post_meta($post->ID, '_horse_tavro', true);
$horse_birthyear = get_post_meta($post->ID, '_horse_birthyear', true); 
$horse_coatcolor = get_post_meta($post->ID, '_horse_coatcolor', true); 	
$horse_height = get_post_meta($post->ID, '_horse_height', true); 	
$horse_width = get_post_meta($post->ID, '_horse_width', true); 	
$horse_depth = get_post_meta($post->ID, '_horse_depth', true); 		
	

$allbreeds=get_terms('horse_breed','orderby=name&hide_empty=0');	
	
wp_nonce_field('horse_info_metabox_action', 'horse_info_metabox_nonce'); 
echo '<script src="https://kit.fontawesome.com/befd316b8b.js" crossorigin="anonymous"></script>';
$javascript_url = plugins_url( '/admin/js/horses-admin.js', __FILE__ );
$jquery_url = plugins_url( '/admin/js/gallery-metabox.js', __FILE__ );
	
echo '<script src="'.$javascript_url.'"></script>';	
echo '<script src="'.$jquery_url.'"></script>';		
echo '<div class="container">';	
echo '<div class="row"><div class="col-md-4 name">Пол: </div><div class="col-md-8"><select name="horse_sex">'; 
if ($horse_sex==0)
 {
	echo '<option value="0">Жеребец</option>';
	echo '<option value="1">Кобыла</option>';
	echo '<option value="2">Мерин</option>';
	   } 
elseif ($horse_sex==1)
 {
	echo '<option value="1">Кобыла</option>';
	echo '<option value="0">Жеребец</option>';
	echo '<option value="2">Мерин</option>';
	   } 	
	else {
	echo '<option value="2">Мерин</option>';
	echo '<option value="1">Кобыла</option>';
	echo '<option value="0">Жеребец</option>';
	   } 		
	echo '</select></div></div>'; 	
    echo '<div class="row"><div class="col-md-4 name">Порода: </div><div class="col-md-8">'; 
	
	if ((isset ($allbreeds))&&(sizeof($allbreeds)>0))
	{	
      echo '<select name="horse_breed"><option value="'.$horse_breed.'">'.$horse_breedname.'</option>';
		foreach ($allbreeds as $breed)
		{
			echo '<option value="'.$breed->term_id.'">'.$breed->name.'</option>';
		}
		echo '</select>';
	} else
		echo '<h4>Вы не создали ещё ни одной породы. Создайте их в меню слева и возвращайтесь, пожалуйста.</h4>';
	  echo '</div></div>'; 
echo '<div class="row"><div class="col-md-4 name">Тавро: </div><div class="col-md-8"><input type="text" name="horse_tavro" value="'. esc_attr($horse_tavro) . '"/></div></div>'; 
echo '<div class="row"><div class="col-md-4 name">Год рождения:  </div><div class="col-md-8"><input type="text" name="horse_birthyear" value="'. esc_attr($horse_birthyear) . '"/></div></div>'; 
echo '<div class="row"><div class="col-md-4 name">Масть: </div><div class="col-md-8"><input type="text" name="horse_coatcolor" value="'. esc_attr($horse_coatcolor) . '"/></div></div>'; 
echo '<div class="row"><div class="col-md-4 name">Промеры:</div><div class="col-md-8"> <input type="text" name="horse_height" value="'. esc_attr($horse_height) . '"/> <input type="text" name="horse_width" value="'. esc_attr($horse_width) . '"/> <input type="text" name="horse_depth" value="'. esc_attr($horse_depth) . '"/></div></div>';	
echo '</div>';	
	
}

function horse_info_metabox_save($postID) { 

if ((!isset($_POST['horse_tavro']))&&(!isset($_POST['horse_birthyear']))&&(!isset($_POST['horse_coatcolor']))&&(!isset($_POST['horse_height']))&&(!isset($_POST['horse_width']))&&(!isset($_POST['horse_depth']))) 
return; 
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
return; 
if (wp_is_post_revision($postID)) 
return; 
	
check_admin_referer('horse_info_metabox_action', 'horse_info_metabox_nonce'); 

if (isset($_POST['horse_sex']))
    {  
     $data = (int)$_POST['horse_sex'];
     update_post_meta($postID, '_horse_sex', $data); 
	 if ($data==0)  wp_set_object_terms( $postID, 77, 'horse_tax',true);	  
     if ($data==1)  wp_set_object_terms( $postID, 78, 'horse_tax',true);
	 if ($data==2)  wp_set_object_terms( $postID, 82, 'horse_tax',true);
     }
if (isset($_POST['horse_breed']))
    {  
     $data = (int)$_POST['horse_breed']; 
	 if ($data!=0){
     update_post_meta($postID, '_horse_breed', $data);
	 wp_set_object_terms( $postID, $data, 'horse_breed',false);	  
     }	
}
if (isset($_POST['horse_tavro']))
    {  
     $data = sanitize_text_field($_POST['horse_tavro']); 
	 if ($data!="")
     update_post_meta($postID, '_horse_tavro', $data); 
     }
if (isset($_POST['horse_birthyear']))
    {  
     $data = sanitize_text_field($_POST['horse_birthyear']);
	 if ($data!="")
     update_post_meta($postID, '_horse_birthyear', $data); 
     }
	
if (isset($_POST['horse_coatcolor']))
    {  
     $data = sanitize_text_field($_POST['horse_coatcolor']); 
	 if ($data!="")
     update_post_meta($postID, '_horse_coatcolor', $data); 
     }

if (isset($_POST['horse_height']))
    {  
     $data = sanitize_text_field($_POST['horse_height']); 
     if ($data!="")
     update_post_meta($postID, '_horse_height', $data); 
     }
if (isset($_POST['horse_width']))
    {  
     $data = sanitize_text_field($_POST['horse_width']); 
	 if ($data!="")
     update_post_meta($postID, '_horse_width', $data); 
     }
if (isset($_POST['horse_depth']))
    {  
     $data = sanitize_text_field($_POST['horse_depth']); 
	 if ($data!="")
     update_post_meta($postID, '_horse_depth', $data); 
     }	
	
}


// 7. Отец (выпадающий список типа horse, horse_tax='stallion') horse_father и horse_other_father
// 8. Мать (выпадающий список типа horse, horse_tax='mare') horse_mother и horse_other_mother
// 9. Потомки (выпадающий список типа horse) horse_child_1, horse_child_2, ... horse_child_n (числа) и horse_other_child_1, horse_other_child_2, ... horse_other_child_n
// 10. Кол-во потомков (скрытый инпут) all_children_num и all_other_children_num

add_action('add_meta_boxes', 'horse_family_init'); 
add_action('save_post', 'horse_family_save'); 

function horse_family_init() { 
add_meta_box('horse_family', 'Родители и потомство', 'horse_family_showup', 'horse', 'advanced', 'default'); 
} 

function horse_family_showup($post, $box) { 
	
$all_metas=get_post_meta($post->ID);
echo "<!-----------  ALL POST META ";
print_r($all_metas);
echo "---->";	
	
$stalnum = get_post_meta($post->ID, '_horse_father', true);	
$stalname =	get_post_meta($post->ID, '_horse_other_father', true);

$marenum = get_post_meta($post->ID, '_horse_mother', true);	
$marename = get_post_meta($post->ID, '_horse_other_mother', true);

$chnum = get_post_meta($post->ID, '_all_children_num', true);
$chnum=(int)$chnum;
	
$otherchnum =  get_post_meta($post->ID, '_all_other_children_num', true);
$otherchnum=(int)$otherchnum;	
	
$children=array();	
if ((isset($chnum))&&($chnum>0))
{
	for ($i=0; $i<$chnum; $i++)
	{
	 $children[$i]['id'] = get_post_meta($post->ID, '_horse_child_'.$i, true); 	
	 $child=get_post($children[$i]['id']);
	 $children[$i]['name']=$child->post_title;	
	}
}
	else 
	{$children[0]['id']=0;
	 $children[0]['name']='Выберите особь из списка или введите имя не из каталога';}
	
$other_children=array();
if ((isset($otherchnum))&&($otherchnum>0))
	for ($i=0; $i<$otherchnum; $i++)
	{   
		$other_children[$i]= get_post_meta($post->ID, '_horse_other_child_'.$i, true);
	}
	
echo "<!-----------  OTHER CHILDREN ";
print_r($all_metas);
echo "---->";	
	
wp_nonce_field('horse_family_action', 'horse_family_nonce'); 
	
// Найти horse с ID=$stalnum и взять его title - это будет имя отца
if ((isset ($stalnum))&&($stalnum>0)){
    $father = get_post($stalnum);
    $fathername = $father->post_title;
}
	else
	{
	$stalnum=0;	
    $fathername = 'Выберите жеребца из списка или введите имя не из каталога';
	}
	
	
	 $his_children=(int)$father->_all_children_num;
	  // Надо проверить - вдруг отец уже знает об этом
	    $allch=array();
		for ($i=0; $i<$his_children; $i++)
			$allch[$i]=get_post_meta($stalnum, '_horse_child_'.$i, true);
		
	echo '<!----------';
	if (in_array($post->ID, $allch))
		echo '-Отец уже знает. Потомок - '.$post->ID;
	    print_r($allch);
	echo '--------->';
if ((isset ($marenum))&&($marenum>0)){
    $mother = get_post($marenum);
    $mothername = $mother->post_title;
}
	else
	{
	$marenum=0;	
    $mothername = 'Выберите кобылу из списка или введите имя не из каталога';
	}
	
// Найти список всех horse (кроме текущего номера) и сделать с ними выпадающий список
// Отдельно у меня жеребцы(stallions) и кобылы (mares) 		

$stallions = get_posts( array(
	'tax_query' => array(
		array(
			'taxonomy' => 'horse_tax',
			'field'    => 'slug',
			'terms'    => 'stallion'
		)
	),
	'post_type' => 'horse',
	'posts_per_page' => -1,
	'exclude' => $post->ID
) );
	
$mares = get_posts( array(
	'tax_query' => array(
		array(
			'taxonomy' => 'horse_tax',
			'field'    => 'slug',
			'terms'    => 'mare'
		)
	),
	'post_type' => 'horse',
	'posts_per_page' => -1,
	'exclude' => $post->ID
) );	

// Батя
// 	
echo '<div class="container">';	
echo '<h4>Выберите, пожалуйста, родителей и потомков особи из списка. Если лошади нет в списке и у вас нет о ней никакой информации, кроме имени - выберите опцию "не из каталога" и введите имя. Если у вас есть подробная информация об этой лошади - тогда сначала заведите ей отдельную карточку, а затем выберите из списка, пожалуйста.</h4>';	
echo '<div class="row"><div class="col-md-2 name">Отец:</div><div class="col-md-4"> <select name="horse_father">'; 
echo '<option value="'.$stalnum.'">'.$fathername.'</option>';
	
	foreach( $stallions as $stallion ){		
		echo '<option value="'.$stallion->ID.'" >'.$stallion->post_title.'</option>';
}
	echo '</select></div>';
	echo '<div class="col-md-6"><input type="checkbox" name="another_stallion" onClick="Javascript: if(getElementById(\'otherstal\').style.display==\'none\') getElementById(\'otherstal\').style.display=\'block\'; else getElementById(\'otherstal\').style.display=\'none\'"';
	if ((isset($stalname))&&($stalname!=''))
		 echo ' checked ';
	echo '> Отец не из каталога';
	echo '<span id="otherstal"';
	if ((isset($stalname))&&($stalname!=''))
    	  echo ' style="display: block;">';
	else 
		echo ' style="display: none;">';
	echo 'Имя жеребца <input type="text" name="horse_other_father" value="'. esc_attr($stalname) . '"/></span></div>';
	echo "</div>";	
	
// Мамка
// 
	
echo '<div class="row"><div class="col-md-2 name">Мать: </div><div class="col-md-4"><select name="horse_mother">'; 
echo '<option value="'.$marenum.'">'.$mothername.'</option>';
	
	foreach( $mares as $mare ){ 
			echo '<option value="'.$mare->ID.'" >'.$mare->post_title.'</option>';
        }
	echo '</select></div>';
	echo '<div class="col-md-6"><input type="checkbox" name="another_mare" onClick="Javascript: if(getElementById(\'othermare\').style.display==\'none\') getElementById(\'othermare\').style.display=\'block\'; else getElementById(\'othermare\').style.display=\'none\'"';
	if ((isset($marename))&&($marename!=''))
		echo ' checked ';
	echo '> Мать не из каталога';
	echo '<span id="othermare"';
	if ((isset($marename))&&($marename!=''))
    	  echo ' style="display: block;">';
	else 
		echo ' style="display: none;">';
	echo 'Имя кобылы <input type="text" name="horse_other_mother" value="'. esc_attr($marename) . '"/></span></div>';
	echo "</div>";

// ДЕТКИ
// 
	

// Детки с номерами из каталога

if ((isset($chnum))&&($chnum>0))
{
	echo '<input type="hidden" name="all_children_num" id="all_children_num" value="'.$chnum.'">';
	for ($i=0; $i<$chnum; $i++)
	{
	   echo '<div class="row" id="div_horse_child_'.$i.'"><div class="col-md-2 name">Потомок: </div>'; 
	   echo '<div class="col-md-4"><select class="horse_child" name="horse_child_'.$i.'" id="horse_child_'.$i.'">'; 
       echo '<option id="no_children" value="'.$children[$i]['id'].'">'.$children[$i]['name'].'</option>';
	   foreach( $stallions as $stallion ){	
		
		echo '<option value="'.$stallion->ID.'" >'.$stallion->post_title.'</option>';
             }	
	   foreach( $mares as $mare ){ 
			echo '<option value="'.$mare->ID.'" >'.$mare->post_title.'</option>';
        }
	
	echo '</select></div>';
	echo '<div class="col-md-4"><a style="color: #a50007" onClick="JavaScript: deleteChild('.$i.')"><i class="fas fa-times"></i></a> Удалить потомка</div>';
		
	echo '</div>';
	}
}
	else
	{
	   echo '<input type="hidden" name="all_children_num" id="all_children_num" value="1">';
	   echo '<div class="row" id="div_horse_child_0"><div class="col-md-2 name">Потомок: </div>';
	   echo '<div class="col-md-4"><select class="horse_child" name="horse_child_0" id="horse_child_0">';
	   echo '<option id="no_children" value="0" >Выберите потомка из каталога</option>';	
       foreach( $stallions as $stallion ){		
		echo '<option value="'.$stallion->ID.'" >'.$stallion->post_title.'</option>';
             }	
	   foreach( $mares as $mare ){ 
			echo '<option value="'.$mare->ID.'" >'.$mare->post_title.'</option>';
        }
	
	echo '</select></div>';
	echo '</div>';	
	}
	echo '<div class="row"><div class="col-md-5"></div><div class="col-md-7" id="add_child"><a style="color: #008005" onClick="JavaScript: addChild();"><i class="fas fa-plus"></i></a> Добавить потомка из каталога</div></div>';
	
	
    if ((isset($otherchnum))&&($otherchnum>0))
{
    echo '<input type="hidden" name="all_other_children_num" id="all_other_children_num" value="'.$otherchnum.'">';
		
	for ($i=0; $i<$otherchnum; $i++)
	{
	 echo '<div class="row" id="div_horse_other_child_'.$i.'"><div class="col-md-4 name">Имя потомка: </div>';
	 echo '<div class="col-md-4"> <input type="text" class="horse_other_child" name="horse_other_child_'.$i.'" value="'. esc_attr($other_children[$i]) . '"/></div>';	
	 echo '<div class="col-md-4"><a style="color: #a50007" onClick="JavaScript: deleteOtherChild('.$i.')"><i class="fas fa-times"></i></a> Удалить потомка</div>';	
	 echo '</div>';
	}
	}
	
	else 
		 echo '<input type="hidden" name="all_other_children_num" id="all_other_children_num" value="0">';
	
	echo '<div class="row" id="add_new_other_child"><div class="col-md-5"></div><div class="col-md-7" id="add_other_child_'.$i.'"><a style="color: #008005" onClick="JavaScript:addOtherChild();"><i class="fas fa-plus"></i></a> Добавить потомка не из каталога</div></div>';
	
	echo '</div>';
}
function horse_family_save($postID) { 

if ((!isset($_POST['horse_father']))&&(!isset($_POST['horse_other_father']))&&(!isset($_POST['horse_mother']))&&(!isset($_POST['horse_other_mother'])))
return; 
	
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
return; 
if (wp_is_post_revision($postID)) 
return; 
check_admin_referer('horse_family_action', 'horse_family_nonce'); 

	// Папа
if (isset($_POST['horse_father']))
	{
     $data = (int)$_POST['horse_father'];
	 if ($data!=0)
     update_post_meta($postID, '_horse_father', $data); 
	 // У нас трогательная миссия - найти отца и сказать ему, что у него есть ребёнок.
	 $father=get_post($data);
	 $his_children=(int)$father->_all_children_num;
	  // Надо проверить - вдруг отец уже знает об этом
	    $allch=array();
		for ($i=0; $i<$his_children; $i++)
			$allch[$i]=get_post_meta($data, '_horse_child_'.$i, true);
		 
	if (!in_array((int)$postID, $allch))	
	{
	 update_post_meta($data,'_horse_child_'.$his_children,$postID);
	 $his_children++;
	 update_post_meta($data,'_all_children_num',$his_children);
	}
	}
	// Папа не из каталога
if (isset($_POST['horse_other_father']))
	{
     $data = sanitize_text_field($_POST['horse_other_father']);
	 if ($data!="")
     update_post_meta($postID, '_horse_other_father', $data); 	
	}
	// Мама
if (isset($_POST['horse_mother']))
	{
     $data = (int)$_POST['horse_mother'];
	 if ($data!=0)
     update_post_meta($postID, '_horse_mother', $data); 
	// У нас трогательная миссия - найти мать и сказать ей, что у неё есть ребёнок.
	 $mother=get_post($data);
	 $her_children=(int)$mother->_all_children_num;
	 $isnot=true;
		$i=0;
		while(($i<$her_children)&&($isnot))
		 {
			$nur=get_post_meta($data, '_horse_child_'.$i, true);
			if ((int)$nur==$postID)
				$isnot=false;
			 else $i++;
		 }
	if ($isnot)
	{
	 update_post_meta($data,'_horse_child_'.$her_children,$postID);
	 $her_children++;
	 update_post_meta($data,'_all_children_num',$her_children);
	}
	}
	// Мама не из каталога
if (isset($_POST['horse_other_mother']))
	{
     $data = sanitize_text_field($_POST['horse_other_mother']);
	 if ($data!="")
     update_post_meta($postID, '_horse_other_mother', $data); 	
	}
	
   // Детки
	if (isset($_POST['all_children_num']))
	{
	 	
     $all_children_num = (int)$_POST['all_children_num']; 
	 if (($all_children_num==1)&&($_POST['horse_child_0']=='0')) return;
		
	 update_post_meta($postID, '_all_children_num', $all_children_num); 
		
	for ($i=0; $i<$all_children_num; $i++)
	{
	  if (isset($_POST['horse_child_'.$i]))
	   {
         $data = (int)$_POST['horse_child_'.$i]; 
         update_post_meta($postID, '_horse_child_'.$i, $data);  
		 $child=get_post($data); 
		 if($post->_horse_sex==0)
		    update_post_meta($data, '_horse_father', $postID );  
		  if($post->_horse_sex==1)
		    update_post_meta($data, '_horse_mother', $postID );   
	    }	
	  }
	}
	
	// Детки не из каталога
	if (isset($_POST['all_other_children_num']))
	{
     $all_children_num = (int)$_POST['all_other_children_num']; 
     update_post_meta($postID, '_all_other_children_num', $all_children_num); 
		
	for ($i=0; $i<$all_children_num; $i++)
	{
	  if (isset($_POST['horse_other_child_'.$i]))
	   {
         $data = sanitize_text_field($_POST['horse_other_child_'.$i]); 
         update_post_meta($postID, '_horse_other_child_'.$i, $data); 
	    }	
	  }
	}
	
} 

// 11. Соревнование (выпадающий список таксономий horse_race + число) horse_race_1 horse_place_1, horse_race_2, horse_place_2, ... , horse_race_n, horse_place_n
// n берётся из all_horse_races

add_action('add_meta_boxes', 'horse_races_init'); 
add_action('save_post', 'horse_races_save'); 

function horse_races_init() {
add_meta_box('horse_races', 'Участие в скачках', 'horse_races_showup', 'horse', 'advanced', 'default');
}

function horse_races_showup($post, $box) {

	
$chnum = get_post_meta($post->ID, '_all_horse_races', true);
$chnum=(int)$chnum;	
	
$races=array();
if ((isset($chnum))&&($chnum>0))
{
	for ($i=0; $i<$chnum; $i++)
	{
	 $races[$i]['id'] = get_post_meta($post->ID, '_horse_race_'.$i, true);
	 $race=get_term($races[$i]['id'], 'horse_race');
	 $races[$i]['name']=$race->name;
	 $races[$i]['place']=  get_post_meta($post->ID, '_horse_place_'.$i, true);	
	}
}
	else
	{
	 $races[0]['id']=0;
	 $races[0]['name']='Выберите соревнование из списка';
	 $races[0]['place']=0;
	}

wp_nonce_field('horse_races_action', 'horse_races_nonce');	
	
$races_cats=get_terms('horse_race','orderby=name&hide_empty=0');
	
echo '<div class="container">';
echo '<h4>Выберите, пожалуйста, название соревнований из списка и укажите место, которое заняла особь. Если в списке нет пока такого соревнования - пожалуйста, создайте </h4>';
	
	
 if ((isset($chnum))&&($chnum>0))
 {  echo '<input type="hidden" name="all_horse_races" id="all_horse_races" value="'.$chnum.'">';

	 // Если есть уже заполненные места в соревнованиях
     if ($races_cats)
	    { // Если в списке соревнований есть хоть одно
		 for ($i=0; $i<$chnum; $i++)
		 {
		  echo '<div class="row" id="div_horse_race_'.$i.'">';
          echo '<div class="col-md-2 name">Соревнование:</div><div class="col-md-4"> <select class="horse_race" name="horse_race_'.$i.'"  id="horse_race_'.$i.'">';
		  echo '<option id="first_value_'.$i.'" value="'.$races[$i]['id'].'">'.$races[$i]['name'].'</option>';
 
			 foreach($races_cats as $cat)
			 { echo '<option value="'.$cat->term_id.'">'.$cat->name.'</option>';}
		 echo '</select>';
		 echo '</div><div class="col-md-4 name">Место: <input type="text" class="horse_place" name="horse_place_'.$i.'" id="horse_place_'.$i.'" value="'.$races[$i]['place'].'"></div>';
		 echo '<div class="col-md-2"><a style="color: #a50007" id="delete_button_'.$i.'" onClick="JavaScript: deleteRace('.$i.')"><i class="fas fa-times"></i></a> Удалить участие</div>';	 
         echo '</div>';	 
		 }
 } // Если есть уже заполненные места в соревнованиях	  
	 else
	 {
		echo '<h4>Вы ещё не завели ни одного соревнования. Пожалуйста, создайте соревнование в меню слева, а затем возвращайтесь на эту страницу и выберите его.</h4>'; 
	 }
echo '</div>';	
}
	else
	{  if ($races_cats)
	     {  
		  echo '<input type="hidden" name="all_horse_races" id="all_horse_races" value="1">';
		  echo '<div class="row" id="div_horse_race_0">';
          echo '<div class="col-md-2 name">Соревнование:</div><div class="col-md-4"> <select name="horse_race_0" class="horse_race" id="horse_race_0">';
		  echo '<option id="first_value_0" value="'.$races[0]['id'].'" >'.$races[0]['name'].'</option>'; 
			 foreach($races_cats as $cat)
			 { echo '<option value="'.$cat->term_id.'">'.$cat->name.'</option>';}
		 echo '</select>';
		 echo '</div><div class="col-md-4 name" style="text-align: left">Место: <input type="text" class="horse_place" name="horse_place_0" id="horse_place_0" value=""></div>';
		 echo '<div class="col-md-2"><a style="color: #a50007" id="delete_button_0" onClick="JavaScript: deleteRace(0)"><i class="fas fa-times"></i></a> Удалить участие</div>';
         echo '</div>';	 }

	   else
	   {
		   	echo '<h4>Вы ещё не завели ни одного соревнования. Пожалуйста, создайте соревнование в меню слева, а затем возвращайтесь на эту страницу и выберите его.</h4>'; 
	
	   }
	}
	
	// Добавить новое место в соревновании
	
	echo '<div class="row"><div class="col-md-5"></div><div class="col-md-7" id="add_race"><a style="color: #008005" onClick="JavaScript: addRace();"><i class="fas fa-plus"></i></a> Добавить участие в соревновании</div></div>';

}
function horse_races_save($postID) {
if (isset ($_POST['all_horse_races']))
{
$races=(int)$_POST['all_horse_races'];	
if (($races==0)||(($races==1)&&($_POST['horse_place_0']=="")))
{
 update_post_meta($postID, '_all_horse_races', 0);	
 return;
}
}
	else return;
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
return;
	
if (wp_is_post_revision($postID))
return;
	
check_admin_referer('horse_races_action', 'horse_races_nonce');

     $all_races_num = (int)$_POST['all_horse_races'];
     update_post_meta($postID, '_all_horse_races', $all_races_num);

	for ($i=0; $i<$all_races_num; $i++)
	{
	  if ((isset($_POST['horse_race_'.$i]))&&(isset($_POST['horse_place_'.$i])))
	   {
         update_post_meta($postID, '_horse_race_'.$i, $_POST['horse_race_'.$i]);
		 $data = sanitize_text_field($_POST['horse_place_'.$i]);
         update_post_meta($postID, '_horse_place_'.$i, $data);
		 wp_set_object_terms($postID,(int)$_POST['horse_race_'.$i],'horse_race',true); 
	     
	    }
	  }
	
}

// 
// 12. Галерея (мультифайлы)  horse_gallery
// 
  add_action('add_meta_boxes', 'horse_gallery_init');
  add_action('save_post', 'horse_gallery_save'); 

function horse_gallery_init() {
add_meta_box('horse_gallery', 'Фотогалерея', 'horse_gallery_showup', 'horse', 'advanced', 'default');
}

function horse_gallery_showup($post, $box) 
{
	  $ids = get_post_meta($post->ID, '_horse_gallery_id', true);	  
	  wp_nonce_field('horse_gallery_action', 'horse_gallery_nonce');
	   ?>
        <table class="form-table">
          <tr>
          <td>
          <a class="gallery-add" href="#" data-uploader-title="Добавить картинки в галерею"><i class="fas fa-plus"></i></a>Добавить картинки
          <ul id="horse-gallery-list">
          <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value); ?>
                 <li>
                   <input type="hidden" name="horse_gallery_id[<?php echo $key; ?>]" value="<?php echo $value; ?>">
                   <img class="image-preview" src="<?php echo $image[0]; ?>">
                   <a class="change-image" href="#" data-uploader-title="Поменять картинку"><i class="fas fa-pencil-alt"></i></a>Поменять картинку<br>
                  <small><a class="remove-image" href="#"><i class="fas fa-times"></i></a>Удалить картинку</small>
                  </li>
                  <?php
                 endforeach;
                 endif;
                        ?>
                    </ul>
                </td>
            </tr>
        </table>
        <?php
}

function horse_gallery_save($postID)
{
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
    return;

    if (wp_is_post_revision($postID))
    return;
/*
    check_admin_referer('horse_gallery_action', 'horse_gallery_nonce');
 */
        if (isset($_POST['horse_gallery_id'])) {
            update_post_meta($postID, '_horse_gallery_id', $_POST['horse_gallery_id']);
        } 
}


// 13. Продажа (чекбокс) horse_is_on_stock
// 14. Цена (число) horse_price
// 15. Новая цена со скидкой (число) horse_new_price

add_action('add_meta_boxes', 'horse_sale_init');
add_action('save_post', 'horse_sale_save');

function horse_sale_init() {
add_meta_box('horse_sale', 'Продажа лошади', 'horse_sale_showup', 'horse', 'advanced', 'default');

}

function horse_sale_showup($post, $box) {

		
$all_metas=get_post_meta($post->ID);

	
$horse_is_on_stock = get_post_meta($post->ID, '_horse_is_on_stock', true);
$horse_price = get_post_meta($post->ID, '_horse_price', true);
$horse_new_price = get_post_meta($post->ID, '_horse_new_price', true);

wp_nonce_field('horse_sale_action', 'horse_sale_nonce');

echo '<div class="container">';
echo '<div class="row"><div class="col-md-4 name">Лошадь продаётся: </div><div class="col-md-8"><input type="checkbox" name="horse_is_on_stock" value="onStock"  onClick="Javascript: if(getElementById(\'price\').style.display==\'none\') getElementById(\'price\').style.display=\'block\'; else getElementById(\'price\').style.display=\'none\'"'; 
if ((isset($horse_is_on_stock))&&($horse_is_on_stock=="onStock"))
{
echo ' checked /></div></div>';
echo '<div id="price" style="display: block;"><div class="row">';
}
	else
	{
    echo ' /></div></div>';
    echo '<div id="price" style="display: none;"><div class="row">';
		
	}
 
echo '<div class="col-md-4 name">Цена:  </div><div class="col-md-8"><input type="text" name="horse_price" value="'.esc_attr($horse_price).'"/></div></div>';
echo '<div class="row"><div class="col-md-4 name">Цена со скидкой: </div><div class="col-md-8"><input type="text" name="horse_new_price" value="'. esc_attr($horse_new_price) . '"/></div></div>';

	
echo '</div></div>';

}

function horse_sale_save($postID) {

if ((!isset($_POST['horse_price']))&&(!isset($_POST['horse_new_price'])))
return;
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
return;
if (wp_is_post_revision($postID))
return;

check_admin_referer('horse_sale_action', 'horse_sale_nonce');

if ((isset($_POST['horse_is_on_stock']))&&($_POST['horse_is_on_stock']=="onStock"))
    {
     update_post_meta($postID, '_horse_is_on_stock', $_POST['horse_is_on_stock']);
	 wp_set_object_terms( $postID, 90, 'horse_tax',true);
     }
	else   
	{  update_post_meta($postID, '_horse_is_on_stock', '');
	   wp_remove_object_terms( $postID, 90, 'horse_tax',true);
     
	}
   
if ((isset($_POST['horse_price']))&&($_POST['horse_price']!=""))
    {
     $data = sanitize_text_field($_POST['horse_price']);
     update_post_meta($postID, '_horse_price', $data);
     }

   
if (isset($_POST['horse_new_price']))
    {
     $data = sanitize_text_field($_POST['horse_new_price']);
     update_post_meta($postID, '_horse_new_price', $data);
     }
}

// Создаём шорткод [showhorses id='0/номер лошади'
//                             cat='номер категории'
//                             num='сколько штук выводить' 
//                             perrow='делитель 12' 
//                             showyear=yes/no
//                             year='0 или год' 
//                             form='square/circle/rect'
//                             breed='yes/no'
//                             price='yes/no' (показывать цену или нет)
//                             forsale='yes/no' (на продажу или нет)
//                             breednum='0 или номер категории' 
//                             othertext='Любой текст, который будет подписан под карточкой лошади']
function create_horse_shortcode($args)
{
	$params=shortcode_atts(
	                   array(
						   'id'=>'0',
						   'cat'=>'0',
						   'num'=>'-1',
						   'perrow'=>'4',
						   'showyear'=>'yes',
						   'year'=>'0',
						   'form'=>'square',
						   'breed'=>'no',
						   'price'=>'no',
						   'forsale'=>'no',
						   'breednum' =>'0', 
						   'othertext'=>''
						), $args);
	$params['id']=(int)$params['id'];
	$params['cat']=(int)$params['cat'];
	$params['num']=(int)$params['num'];
	$params['perrow']=(int)$params['perrow'];
	$params['breednum']=(int)$params['breednum'];
	
	  if ($params['perrow']>12)  $params['perrow']=12;
	  if ($params['perrow']<1)   $params['perrow']=1;
	  if ($params['perrow']==5)  $params['perrow']=4;
	  if (($params['perrow']>6)&&($params['perrow']<12)) $params['perrow']=6;
	$colnum=12/$params['perrow'];

	// Это будет переменная, в которую мы будем записывать вывод на экран и которую будем возвращать
	$text_to_return='Нет лошадей для показа';
	if ($params['id']!=0)
	{   $args=array(
	       'post_type'=>'horse',
	       'include'=>$params['id']);
		$allposts=get_posts($args);
	}
	else
	{
	// В любом случае в запросе есть это: 
	// 
	
	$args=array(
		'post_type'=>'horse',
		'posts_per_page'=>$params['num'],
		'orderby'=>'title',
		'order'=>'ASC'); 
	//Если нам важна категория
	if ($params['cat']!=0)
	{
		  $args['tax_query'] = array(
		             array(
			         'taxonomy' => 'horse_tax',
			         'field'    => 'id',
		             'terms'    => $params['cat'],
		                 )
	                   ); 
	  }
	// Если у нас указана конкретная порода
	if ($params['breednum']!=0)
	{
		if (isset($args['tax_query']))
		  { array_push($args['tax_query'], array(
		                        'taxonomy'=>'horse_breed',
		                        'field' =>'id',
			                    'terms' => $params['breednum']) );
		   $args['tax_qery']['relation']='AND';
		  }
		else
			 $args['tax_query'] = array(
		             array(
			         'taxonomy' => 'horse_breed',
			         'field'    => 'id',
		             'terms'    => $params['breednum']
		                 )
	                  ); 
	}
	if ($params['forsale']=='yes')
	{   
		$args['meta_query']=array(
		            array(
					'key'=>'_horse_is_on_stock',
					'value'=>'onStock'	
					));
	}        
		if ($params['year']!='0')
			if (isset($args['meta_query']))
		    array_push($args['meta_query'], array(
		                        'key'=>'_horse_birthyear',
		                        'value'=>$params['year']) );
	       else
		     $args['meta_query']=array(array(
		                        'key'=>'_horse_birthyear',
		                        'value'=>$params['year']));
		      
	
	  $allposts=get_posts($args);
	}
		if ($allposts)
		{   
			if ($params['id']!=0) $text_to_return='';
			else $text_to_return='<div class="container"><div class="row">';
			foreach( $allposts as $otherhorse )
			{	
            $smallpic=get_the_post_thumbnail_url($otherhorse,'small');
			$text_to_return.='<div class="col-md-'.$colnum.' horse_catalog">';
			if ($params['form']=='circle')
			{
			$text_to_return.='<div class="outer"><div class="pic-'.$params['form'].'" style="background-image: url(\''.$smallpic.'\'"></div></div><div class="text-'.$params['form'].'"><a href="'.get_page_link($otherhorse).'">';
			}
			if ($params['form']=='rect')
			{
			$text_to_return.='<div class="outer-rect"><div class="pic-'.$params['form'].'" style="background-image: url(\''.$smallpic.'\'"></div></div><div class="text-'.$params['form'].'"><a href="'.get_page_link($otherhorse).'">';
			}
		    if ($params['form']=='square') {$text_to_return.='<div class="pic-'.$params['form'].'"><a href="'.get_page_link($otherhorse).'"><img src="'.$smallpic.'"></div><div class="text-'.$params['form'].'">';}
		    $text_to_return.=$otherhorse->post_title.'</a>';
			if ($params['showyear']=='yes') $text_to_return.=', '.$otherhorse->_horse_birthyear;
			if ($params['breed']=='yes')
			{
				$br = get_term($otherhorse->_horse_breed, 'horse_breed');
                $horse_breedname = $br->name;
				$text_to_return.='<br>'.$horse_breedname;}	
			if ($params['price']=='yes') 
			   {
				   if ((isset($otherhorse->_horse_new_price))&&($otherhorse->_horse_new_price!=0))
			          $text_to_return.='<br><b>'.$otherhorse->_horse_new_price.'Р</b>';	
		           else
			          $text_to_return.='<br><b>'.$otherhorse->_horse_price.'Р</b>';
			    }
			if ($params['othertext']!='')
				 $text_to_return.='<br><span style="color: #000">'.$params['othertext'].'</span>';
			$text_to_return.='</div></div>';	
			}
			if ($params['id']==0) $text_to_return.='</div></div>';	
			
		}
	
	   return $text_to_return;
	}

add_shortcode('showhorses', 'create_horse_shortcode');


function tax_template( $template ) {
    if ( is_post_type_archive( 'horse_breed' || is_tax( 'horse_breed' ))) {
        return get_stylesheet_directory_uri().'/taxonomy-horse_breed.php';
    }     
    return $template;
}
add_filter( 'template_include', 'tax_template' );

?> 