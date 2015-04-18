<?php get_header(); ?>

<main>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<article <?php post_class( array('article', 'article--excerpt' ) ); ?>>
			<header class="article__info">
				<h1 class="article__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<p class="article__author"><?php the_author_link(); ?></p>
				<p class="article__time"><?php the_date(); ?>
			</header>

			<?php the_excerpt(); ?>

			<footer class="article__lesser-info">
				<p class="article__category"><?php the_category(); ?></p>
			</footer>
		</article>

	<?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>