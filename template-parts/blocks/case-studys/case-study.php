<?php

/**
 * Case study Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'case-study-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'case-study';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>

<div class="case-studies__filter">

<?php $field_name = 'field_63ce95ed5423d';
$field = get_field_object($field_name);

if( $field )
{
    echo '<div class="case-studies__filter--type active" data-type="all">All</div>';
    foreach( $field['choices'] as $k => $v ) {
        echo '<div class="case-studies__filter--type" data-type="' . $k . '">' . $v . '</div>';
    }
}
?>
</div>

<section class="case-studies">
<?php if(have_rows('case_study')): ?>
    <?php while(have_rows('case_study')) : the_row(); 
    $image = get_sub_field('image');
    if( $image ) {
        // Image variables.
        $imageUrl = $image['url'];
        $imageTitle = $image['title'];
        $imageAlt = $image['alt'];
        $imageCaption = $image['caption'];
    }
    $type = get_sub_field('type');
    $title = get_sub_field('title');
    $button = get_sub_field('button');
    if( $button ) {
        // Button variables
        $button_url = $button['url'];
        $button_title = $button['title'];
        $button_target = $button['target'] ? $button['target'] : '_self';
    };
    ?>
        <article class="<?php echo $className; ?>" data-type="<?php echo implode( ' ', $type); ?>">
            <div class="<?php echo $className; ?>__image">
            <figure>
                <img src="<?php echo $imageUrl; ?>" alt="<?php echo $imageAlt; ?>">
            </figure>
            </div>
            <div class="<?php echo $className; ?>__description">
                <div class="<?php echo $className; ?>__type"><?php echo implode( '<span> / </span>', $type); ?></div>
                <div class="<?php echo $className; ?>__title"><?php echo $title; ?></div>
                <div class="<?php echo $className; ?>__button">
                    <a href="<?php echo esc_url($button_url); ?>" taget="<?php echo esc_attr($button_target); ?>"><?php echo esc_html($button_title); ?></a>
                </div>
            </div>
        </article>    
    <?php endwhile; ?>
<?php endif; ?>
</section>