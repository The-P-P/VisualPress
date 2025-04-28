<?php
/*
Theme Name: DataInsight
Theme URI: http://example.com/data-insight-theme/
Author: Estagiário TI
Author URI: http://example.com/
Description: Um tema WordPress personalizado para visualização de dados e análise.
Version: 1.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: datainsight
Tags: data, analytics, dashboard, responsive
*/

// Registrar menus de navegação
function datainsight_register_menus() {
    register_nav_menus(
        array(
            'primary-menu' => __('Menu Principal', 'datainsight'),
            'footer-menu' => __('Menu Rodapé', 'datainsight')
        )
    );
}
add_action('init', 'datainsight_register_menus');

// Adicionar suporte a recursos do tema
function datainsight_theme_setup() {
    // Adicionar suporte a imagens destacadas
    add_theme_support('post-thumbnails');
    
    // Adicionar suporte a título de página
    add_theme_support('title-tag');
    
    // Adicionar suporte a HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Adicionar suporte a logotipo personalizado
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'datainsight_theme_setup');

// Registrar e carregar scripts e estilos
function datainsight_enqueue_scripts() {
    // Estilos
    wp_enqueue_style('datainsight-style', get_stylesheet_uri());
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
    
    // Scripts
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), '5.3.0', true);
    wp_enqueue_script('chart-js', 'https://cdn.jsdelivr.net/npm/chart.js', array(), '3.7.0', true);
    wp_enqueue_script('datainsight-main', get_template_directory_uri() . '/js/main.js', array('jquery', 'chart-js'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'datainsight_enqueue_scripts');

// Registrar áreas de widgets
function datainsight_widgets_init() {
    register_sidebar(array(
        'name'          => __('Barra Lateral', 'datainsight'),
        'id'            => 'sidebar-1',
        'description'   => __('Adicione widgets aqui para aparecerem na barra lateral.', 'datainsight'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => __('Rodapé', 'datainsight'),
        'id'            => 'footer-1',
        'description'   => __('Adicione widgets aqui para aparecerem no rodapé.', 'datainsight'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'datainsight_widgets_init');

// Registrar tipo de post personalizado para Dados
function datainsight_register_post_types() {
    register_post_type('data_visualization', array(
        'labels' => array(
            'name'               => __('Visualizações', 'datainsight'),
            'singular_name'      => __('Visualização', 'datainsight'),
            'menu_name'          => __('Visualizações', 'datainsight'),
            'add_new'            => __('Adicionar Nova', 'datainsight'),
            'add_new_item'       => __('Adicionar Nova Visualização', 'datainsight'),
            'edit_item'          => __('Editar Visualização', 'datainsight'),
            'new_item'           => __('Nova Visualização', 'datainsight'),
            'view_item'          => __('Ver Visualização', 'datainsight'),
            'search_items'       => __('Buscar Visualizações', 'datainsight'),
            'not_found'          => __('Nenhuma visualização encontrada', 'datainsight'),
            'not_found_in_trash' => __('Nenhuma visualização encontrada na lixeira', 'datainsight'),
        ),
        'public'              => true,
        'has_archive'         => true,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon'           => 'dashicons-chart-area',
        'rewrite'             => array('slug' => 'visualizacoes'),
        'show_in_rest'        => true,
    ));
}
add_action('init', 'datainsight_register_post_types');

// Adicionar campos personalizados para visualizações de dados
function datainsight_add_meta_boxes() {
    add_meta_box(
        'datainsight_chart_data',
        __('Dados do Gráfico', 'datainsight'),
        'datainsight_chart_data_callback',
        'data_visualization',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'datainsight_add_meta_boxes');

// Callback para exibir campos personalizados
function datainsight_chart_data_callback($post) {
    wp_nonce_field('datainsight_save_chart_data', 'datainsight_chart_data_nonce');
    
    $chart_type = get_post_meta($post->ID, '_chart_type', true);
    $chart_data = get_post_meta($post->ID, '_chart_data', true);
    
    ?>
    <p>
        <label for="chart_type"><?php _e('Tipo de Gráfico:', 'datainsight'); ?></label>
        <select id="chart_type" name="chart_type">
            <option value="bar" <?php selected($chart_type, 'bar'); ?>><?php _e('Barras', 'datainsight'); ?></option>
            <option value="line" <?php selected($chart_type, 'line'); ?>><?php _e('Linha', 'datainsight'); ?></option>
            <option value="pie" <?php selected($chart_type, 'pie'); ?>><?php _e('Pizza', 'datainsight'); ?></option>
            <option value="doughnut" <?php selected($chart_type, 'doughnut'); ?>><?php _e('Rosca', 'datainsight'); ?></option>
        </select>
    </p>
    <p>
        <label for="chart_data"><?php _e('Dados do Gráfico (formato JSON):', 'datainsight'); ?></label>
        <textarea id="chart_data" name="chart_data" class="large-text code" rows="10"><?php echo esc_textarea($chart_data); ?></textarea>
        <span class="description"><?php _e('Insira os dados no formato JSON. Exemplo para gráfico de barras: {"labels":["Jan","Fev","Mar"],"datasets":[{"label":"Vendas","data":[10,20,30]}]}', 'datainsight'); ?></span>
    </p>
    <?php
}

// Salvar dados dos campos personalizados
function datainsight_save_chart_data($post_id) {
    if (!isset($_POST['datainsight_chart_data_nonce'])) {
        return;
    }
    
    if (!wp_verify_nonce($_POST['datainsight_chart_data_nonce'], 'datainsight_save_chart_data')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['chart_type'])) {
        update_post_meta($post_id, '_chart_type', sanitize_text_field($_POST['chart_type']));
    }
    
    if (isset($_POST['chart_data'])) {
        update_post_meta($post_id, '_chart_data', $_POST['chart_data']);
    }
}
add_action('save_post', 'datainsight_save_chart_data');

// Shortcode para exibir visualizações de dados
function datainsight_chart_shortcode($atts) {
    $atts = shortcode_atts(array(
        'id' => 0,
    ), $atts, 'datainsight_chart');
    
    if (empty($atts['id'])) {
        return '';
    }
    
    $post_id = absint($atts['id']);
    $chart_type = get_post_meta($post_id, '_chart_type', true);
    $chart_data = get_post_meta($post_id, '_chart_data', true);
    
    if (empty($chart_type) || empty($chart_data)) {
        return '';
    }
    
    $chart_id = 'chart-' . $post_id;
    
    ob_start();
    ?>
    <div class="datainsight-chart-container">
        <canvas id="<?php echo esc_attr($chart_id); ?>"></canvas>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('<?php echo esc_js($chart_id); ?>').getContext('2d');
        var chartData = <?php echo $chart_data; ?>;
        var chart = new Chart(ctx, {
            type: '<?php echo esc_js($chart_type); ?>',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('datainsight_chart', 'datainsight_chart_shortcode');
