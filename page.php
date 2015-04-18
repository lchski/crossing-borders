<?php get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<main>
			<article <?php post_class( array('article', 'article--full' ) ); ?>>
				<header class="article__info">
					<h1 class="article__title"><?php the_title(); ?></h1>
					<p class="article__author"><?php the_author_link(); ?></p>
					<p class="article__time"><?php the_date(); ?>
				</header>

				<?php the_content(); ?>

				<footer class="article__lesser-info">
					<p class="article__category"><?php the_category(); ?></p>
				</footer>
			</article>
		</main>

	<?php endwhile; endif; ?>

<?php get_footer(); ?>