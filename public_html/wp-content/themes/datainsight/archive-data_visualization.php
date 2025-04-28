<?php
/**
 * Template para exibir arquivos de visualizações de dados
 *
 * @package DataInsight
 */

get_header();
?>

<div class="container">
    <div class="site-content">
        <header class="page-header">
            <h1 class="page-title">Visualizações de Dados</h1>
            <p class="archive-description">Explore nossas visualizações de dados interativas.</p>
        </header>

        <div class="data-visualization-archive">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    $chart_type = get_post_meta(get_the_ID(), '_chart_type', true);
                    ?>
                    <article class="data-visualization-card">
                        <div class="data-visualization-thumbnail">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else : ?>
                                <i class="fas fa-chart-<?php echo $chart_type === 'line' ? 'line' : ($chart_type === 'pie' || $chart_type === 'doughnut' ? 'pie' : 'bar'); ?> fa-3x"></i>
                            <?php endif; ?>
                        </div>
                        <div class="data-visualization-content">
                            <h2 class="data-visualization-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="data-visualization-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="button">Ver Visualização</a>
                        </div>
                    </article>
                    <?php
                endwhile;

                the_posts_pagination();
            else :
                ?>
                <p>Nenhuma visualização de dados encontrada.</p>
                <?php
            endif;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
