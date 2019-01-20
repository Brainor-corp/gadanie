<h2 class="header-category">Рубрика</h2>

<div class="posts-container posts-container--two-columns">

    <?php
    for ( $i=0; $i<3; $i++ ) {
        get_template_part( 'inc/the-designer/elements/post', 'card' );
    }
    ?>


</div>