<?php
/**
 * Template para exibir uma única visualização de dados
 *
 * @package DataInsight
 */

get_header();
?>

<div class="container">
    <div class="site-content">
        <?php
        while (have_posts()) :
            the_post();
            $chart_type = get_post_meta(get_the_ID(), '_chart_type', true);
            $chart_data = get_post_meta(get_the_ID(), '_chart_data', true);
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="entry-meta">
                        <span class="posted-on">Publicado em <?php the_date(); ?></span>
                        <span class="chart-type">Tipo: <?php echo ucfirst($chart_type); ?></span>
                    </div>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                    
                    <?php if ($chart_type && $chart_data) : ?>
                        <div class="datainsight-chart-container">
                            <canvas id="chart-<?php the_ID(); ?>"></canvas>
                        </div>
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var ctx = document.getElementById('chart-<?php the_ID(); ?>').getContext('2d');
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
                    <?php endif; ?>
                </div>

                <footer class="entry-footer">
                    <?php
                    // Exibir categorias e tags se existirem
                    $categories_list = get_the_category_list(', ');
                    if ($categories_list) {
                        echo '<span class="cat-links">Categorias: ' . $categories_list . '</span>';
                    }

                    $tags_list = get_the_tag_list('', ', ');
                    if ($tags_list) {
                        echo '<span class="tags-links">Tags: ' . $tags_list . '</span>';
                    }
                    ?>
                </footer>
            </article>
            <?php
        endwhile;
        ?>
    </div>
</div>

<?php get_footer(); ?>
