<?php  get_header(); ?>

<?php
    echo '<ul class="nav nav-tabs" role="tablist">';
    $args = array(
        'hide_empty'=> 1,
        'orderby' => 'name',
        'order' => 'ASC'
    );
    $categories = get_categories($args);
    foreach($categories as $category) { 
        echo 
            '<li>
                <a href="#'.$category->slug.'" role="tab" data-toggle="tab">    
                    '.$category->name.'
                </a>
            </li>';
    }
    echo '</ul>';

    echo '<div class="tab-content">';
    foreach($categories as $category) { 
        echo '<div class="tab-pane" id="' . $category->slug.'">';
        $the_query = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 100,
            'category_name' => $category->slug
        ));

        while ( $the_query->have_posts() ) : 
        $the_query->the_post();
        echo '<h1>';
            the_title();
        echo '</h1>';
        endwhile; 
        echo '</div>';
    } 
    echo '</div>';
?>

<?php get_footer(); ?>
