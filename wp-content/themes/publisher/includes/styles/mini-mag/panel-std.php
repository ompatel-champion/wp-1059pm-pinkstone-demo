<?php
//
// Custom default values for mini-mag Demo
// 


$std_id = $this->get_std_id();


$fields['section_heading_style'][ $std_id ] = 't1-s4';
$fields['layout-2-col'][ $std_id ] = array (
  'width' => '1210',
  'content' => '67',
  'primary' => '33',
);
$fields['layout_columns_space'][ $std_id ] = '50';
$fields['general_listing'][ $std_id ] = 'grid-1';
$fields['sticky_sidebar'][ $std_id ] = 'enable';
$fields['post_template'][ $std_id ] = 'style-3';
$fields['post_author_box_posts'][ $std_id ] = 'hide';
$fields['post_author_box_comments'][ $std_id ] = 'hide';
$fields['cat_top_posts'][ $std_id ] = 'style-5';
$fields['author_comments'][ $std_id ] = 'hide';
$fields['author_posts'][ $std_id ] = 'hide';
$fields['header_layout'][ $std_id ] = 'out-full-width';
$fields['header_style'][ $std_id ] = 'style-8';
$fields['topbar_style'][ $std_id ] = 'hidden';
$fields['off_canvas_position'][ $std_id ] = 'left';
$fields['social_share_top_style'][ $std_id ] = 'style-7';
$fields['social_share_bottom_style'][ $std_id ] = 'style-8';
$fields['footer_layout'][ $std_id ] = 'out-full-width';
$fields['footer_widgets'][ $std_id ] = '1-column';
$fields['footer_social_feed'][ $std_id ] = 'style-1';
$fields['footer_social'][ $std_id ] = 'hide';
$fields['theme_color'][ $std_id ] = '#000000';
$fields['header_top_border'][ $std_id ] = '0';
$fields['header_menu_text_color'][ $std_id ] = '#000000';
$fields['footer_link_color'][ $std_id ] = 'rgba(255,255,255,0.5)';
$fields['footer_link_hover_color'][ $std_id ] = '#ffffff';
$fields['footer_menu_bg_color'][ $std_id ] = '#000000';
$fields['footer_copy_bg_color'][ $std_id ] = '#000000';
$fields['footer_social_bg_color'][ $std_id ] = '#000000';
$fields['footer_bg_color'][ $std_id ] = '#000000';
$fields['section_title_color'][ $std_id ] = '#000000';
$fields['typo_body'][ $std_id ] = array (
  'family' => 'Roboto Condensed',
  'variant' => 'regular',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'inherit',
  'size' => '14',
  'letter-spacing' => '',
  'color' => '#7b7b7b',
);
$fields['typo_heading'][ $std_id ] = array (
  'family' => 'Roboto Condensed',
  'variant' => '700',
  'subset' => 'latin',
  'transform' => 'inherit',
  'letter-spacing' => '',
);
$fields['typo_meta'][ $std_id ] = array (
  'family' => 'Roboto Condensed',
  'variant' => 'regular',
  'subset' => 'latin',
  'transform' => 'none',
  'size' => '13',
  'letter-spacing' => '',
  'color' => '#959595',
);
$fields['typo_meta_author'][ $std_id ] = array (
  'family' => 'Roboto Condensed',
  'variant' => 'regular',
  'subset' => 'latin',
  'transform' => 'capitalize',
  'size' => '13',
  'letter-spacing' => '',
);
$fields['typo_badges'][ $std_id ] = array (
  'family' => 'Roboto Condensed',
  'variant' => '700',
  'subset' => 'latin',
  'transform' => 'uppercase',
  'size' => '12',
  'letter-spacing' => '.2px',
);
$fields['typo_post_heading'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'transform' => 'capitalize',
  'letter-spacing' => '',
);
$fields['typo_post_tp3_heading'][ $std_id ] = '36px';
$fields['typo_post_subtitle'][ $std_id ] = array (
  'family' => 'Roboto Condensed',
  'variant' => 'regular',
  'subset' => 'latin',
  'transform' => 'inherit',
  'size' => '18',
  'letter-spacing' => '',
);
$fields['typo_entry_content'][ $std_id ] = array (
  'family' => 'Roboto Condensed',
  'variant' => 'regular',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'initial',
  'size' => '17',
  'line_height' => '25',
  'letter-spacing' => '',
  'color' => '#222222',
);
$fields['typo_post_summary'][ $std_id ] = array (
  'family' => 'Roboto Condensed',
  'variant' => 'regular',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'initial',
  'size' => '14',
  'line_height' => '21',
  'letter-spacing' => '',
  'color' => '#1a1a1a',
);
$fields['typo_post_summary_single'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => 'regular',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'initial',
  'size' => '16',
  'line_height' => '22',
  'letter-spacing' => '',
);
$fields['typ_header_logo'][ $std_id ] = array (
  'enable' => '0',
  'family' => 'Helvetica',
  'variant' => '700',
  'subset' => 'unknown',
  'align' => 'inherit',
  'transform' => 'uppercase',
  'size' => '30',
  'letter-spacing' => '',
);
$fields['typ_header_menu'][ $std_id ] = array (
  'family' => 'Roboto Condensed',
  'variant' => '700',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'uppercase',
  'size' => '13',
  'letter-spacing' => '',
);
$fields['typ_header_sub_menu'][ $std_id ] = array (
  'family' => 'Roboto Condensed',
  'variant' => '700',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'uppercase',
  'size' => '13',
  'letter-spacing' => '',
);
$fields['typo_topbar_menu'][ $std_id ] = array (
  'family' => 'Roboto Condensed',
  'variant' => 'regular',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '13',
  'letter-spacing' => '',
);
$fields['typo_topbar_sub_menu'][ $std_id ] = array (
  'family' => 'Roboto Condensed',
  'variant' => 'regular',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'none',
  'size' => '13',
  'letter-spacing' => '',
);
$fields['typo_topbar_date'][ $std_id ] = array (
  'family' => 'Roboto Condensed',
  'variant' => '700',
  'subset' => 'latin',
  'transform' => 'uppercase',
  'size' => '12',
  'letter-spacing' => '',
);
$fields['typo_blocks_subtitle'][ $std_id ] = array (
  'family' => 'Roboto',
  'variant' => 'regular',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'inherit',
  'line_height' => '18',
  'letter-spacing' => '',
  'color' => '#565656',
);
$fields['typo_listing_classic_1_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '27',
  'line_height' => '32',
  'letter-spacing' => '',
  'color' => '#000000',
);
$fields['typo_listing_classic_2_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '26',
  'line_height' => '32',
  'letter-spacing' => '',
  'color' => '#000000',
);
$fields['typo_listing_classic_3_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '26',
  'line_height' => '25',
  'letter-spacing' => '',
  'color' => '#000000',
);
$fields['typo_mg_1_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '700',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '26',
  'letter-spacing' => '',
  'color' => '#ffffff',
);
$fields['typo_mg_2_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '700',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '26',
  'letter-spacing' => '',
  'color' => '#ffffff',
);
$fields['typo_mg_3_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '700',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '18',
  'letter-spacing' => '',
  'color' => '#ffffff',
);
$fields['typo_mg_4_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '18',
  'letter-spacing' => '',
);
$fields['typo_mg_5_title_big'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'center',
  'transform' => 'capitalize',
  'size' => '20',
  'letter-spacing' => '',
);
$fields['typo_mg_5_title_small'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'center',
  'transform' => 'capitalize',
  'size' => '15',
  'letter-spacing' => '',
);
$fields['typo_mg_6_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '22',
  'letter-spacing' => '',
  'color' => '#ffffff',
);
$fields['typo_mg_7_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '22',
  'letter-spacing' => '',
  'color' => '#ffffff',
);
$fields['typo_mg_8_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '22',
  'letter-spacing' => '',
  'color' => '#ffffff',
);
$fields['typo_mg_9_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '22',
  'letter-spacing' => '',
  'color' => '#ffffff',
);
$fields['typo_mg_10_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '700',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '22',
  'letter-spacing' => '',
  'color' => '#ffffff',
);
$fields['typo_listing_grid_1_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '20',
  'line_height' => '27',
  'letter-spacing' => '',
  'color' => '#000000',
);
$fields['typo_listing_grid_2_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '20',
  'line_height' => '27',
  'letter-spacing' => '',
  'color' => '#000000',
);
$fields['typo_listing_tall_1_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '16',
  'line_height' => '22',
  'letter-spacing' => '',
  'color' => '#000000',
);
$fields['typo_listing_tall_2_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'center',
  'transform' => 'capitalize',
  'size' => '16',
  'line_height' => '22',
  'letter-spacing' => '',
  'color' => '#000000',
);
$fields['typo_listing_slider_1_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '25',
  'line_height' => '32',
  'letter-spacing' => '',
);
$fields['typo_listing_slider_2_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '25',
  'line_height' => '32',
  'letter-spacing' => '',
  'color' => '#000000',
);
$fields['typo_listing_slider_3_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '25',
  'line_height' => '32',
  'letter-spacing' => '',
  'color' => '#000000',
);
$fields['typo_listing_box_1_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'uppercase',
  'size' => '18',
  'line_height' => '28',
  'letter-spacing' => '',
);
$fields['typo_listing_box_2_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'uppercase',
  'size' => '17',
  'line_height' => '16',
  'letter-spacing' => '',
);
$fields['typo_listing_box_3_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '17',
  'line_height' => '28',
  'letter-spacing' => '',
);
$fields['typo_listing_box_4_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '18',
  'line_height' => '28',
  'letter-spacing' => '',
);
$fields['typo_listing_blog_1_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'none',
  'size' => '19',
  'line_height' => '25',
  'letter-spacing' => '',
  'color' => '#000000',
);
$fields['typo_listing_blog_5_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'capitalize',
  'size' => '22',
  'line_height' => '27',
  'letter-spacing' => '',
  'color' => '#000000',
);
$fields['typo_listing_thumbnail_1_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'none',
  'size' => '16',
  'line_height' => '22',
  'letter-spacing' => '',
  'color' => '#000000',
);
$fields['typo_listing_thumbnail_2_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'none',
  'size' => '16',
  'line_height' => '22',
  'letter-spacing' => '',
  'color' => '#000000',
);
$fields['typo_text_listing_1_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'center',
  'transform' => 'capitalize',
  'size' => '16',
  'line_height' => '22',
  'letter-spacing' => '',
  'color' => '#000000',
);
$fields['typo_text_listing_2_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'inherit',
  'size' => '16',
  'line_height' => '22',
  'letter-spacing' => '',
  'color' => '#000000',
);
$fields['typo_text_listing_3_title'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '500',
  'subset' => 'latin',
  'align' => 'inherit',
  'transform' => 'inherit',
  'size' => '16',
  'line_height' => '20',
  'letter-spacing' => '',
  'color' => '#000000',
);
$fields['typo_section_heading'][ $std_id ] = array (
  'family' => 'Heebo',
  'variant' => '700',
  'subset' => 'latin',
  'transform' => 'capitalize',
  'size' => '26',
  'line_height' => '21',
  'letter-spacing' => '',
);
$fields['typo_footer_menu'][ $std_id ] = array (
  'family' => 'Roboto Condensed',
  'variant' => '700',
  'subset' => 'latin',
  'transform' => 'uppercase',
  'size' => '12',
  'line_height' => '28',
  'letter-spacing' => '.6px',
  'color' => '#ffffff',
);
$fields['typo_footer_copy'][ $std_id ] = array (
  'family' => 'Roboto Condensed',
  'variant' => 'regular',
  'subset' => 'latin',
  'size' => '14',
  'line_height' => '18',
  'letter-spacing' => '',
);
$fields['listing-mix-4-5'][ $std_id ] = array (
  'big-title-limit' => '0',
  'big-excerpt-limit' => '350',
  'big-subtitle' => '0',
  'big-subtitle-limit' => '0',
  'big-subtitle-location' => 'before-meta',
  'big-format-icon' => '1',
  'big-term-badge' => '1',
  'big-term-badge-count' => '1',
  'big-term-badge-tax' => 'category',
  'big-meta' => 
  array (
    'show' => '1',
    'author' => '1',
    'date' => '1',
    'date-format' => 'standard',
    'view' => '0',
    'share' => '0',
    'comment' => '1',
    'review' => '1',
  ),
  'big-read-more' => '1',
  'small-title-limit' => '60',
  'small-excerpt-limit' => '160',
  'small-subtitle' => '0',
  'small-subtitle-limit' => '0',
  'small-subtitle-location' => 'before-meta',
  'small-format-icon' => '1',
  'small-term-badge' => '1',
  'small-term-badge-count' => '1',
  'small-term-badge-tax' => 'category',
  'small-meta' => 
  array (
    'show' => '1',
    'author' => '1',
    'date' => '1',
    'date-format' => 'standard',
    'view' => '0',
    'share' => '0',
    'comment' => '1',
    'review' => '1',
  ),
  'small-read-more' => '1',
);
$fields['listing-grid-1'][ $std_id ] = array (
  'title-limit' => '65',
  'excerpt-limit' => '110',
  'subtitle' => '0',
  'subtitle-limit' => '0',
  'subtitle-location' => 'before-meta',
  'format-icon' => '1',
  'term-badge' => '0',
  'term-badge-count' => '1',
  'term-badge-tax' => 'category',
  'meta' => 
  array (
    'show' => '1',
    'author' => '0',
    'date' => '1',
    'date-format' => 'standard',
    'view' => '0',
    'share' => '0',
    'comment' => '0',
    'review' => '1',
  ),
);
$fields['listing-blog-1'][ $std_id ] = array (
  'title-limit' => '65',
  'excerpt-limit' => '80',
  'subtitle' => '0',
  'subtitle-limit' => '0',
  'subtitle-location' => 'before-meta',
  'format-icon' => '1',
  'term-badge' => '0',
  'term-badge-count' => '1',
  'term-badge-tax' => 'category',
  'meta' => 
  array (
    'show' => '0',
    'author' => '1',
    'date' => '1',
    'date-format' => 'standard',
    'view' => '0',
    'share' => '0',
    'comment' => '1',
    'review' => '1',
  ),
);
$fields['listing-text-1'][ $std_id ] = array (
  'title-limit' => '56',
  'excerpt' => '0',
  'excerpt-limit' => '200',
  'subtitle' => '0',
  'subtitle-limit' => '0',
  'subtitle-location' => 'before-meta',
  'term-badge' => '1',
  'term-badge-count' => '1',
  'term-badge-tax' => 'category',
  'show-ranking' => '',
  'meta' => 
  array (
    'show' => '1',
    'author' => '1',
    'date' => '1',
    'date-format' => 'readable',
    'view' => '0',
    'share' => '0',
    'comment' => '1',
    'review' => '1',
  ),
);
