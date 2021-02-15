<?php
/**
 * Returns content for default demo
 *
 * ->Taxonomies
 * ->Posts
 * ->Options
 * ->Widgets
 * ->Media
 * ->Menus
 *
 *
 * @return array
 */
function publisher_demo_raw_content() {

	$style_id       = 'detroit-mag';
	$prefix         = $style_id . '-'; // prevent caching when user installs multiple demos continuously
	$demo_path      = PUBLISHER_THEME_PATH . 'includes/demos/' . $style_id . '/';
	$demo_image_url = publisher_get_demo_images_url( $style_id );

	return array(

		//
		// ->Taxonomies
		//
		'taxonomy' =>
			array(
				'multi_steps' => false,
				array(
					array(
						'name'     => 'Butzel',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.11',
					),
					array(
						'name'      => 'fashion',
						'taxonomy'  => 'category',
						'term_meta' => array(
							array(
								'meta_key'   => 'slider_type',
								'meta_value' => 'custom-blocks',
							),
							array(
								'meta_key'   => 'better_slider_style',
								'meta_value' => 'style-1',
							),
						),
						'the_id'    => 'taxonomy.primary.2',
					),
					array(
						'name'      => 'food',
						'taxonomy'  => 'category',
						'term_meta' => array(
							array(
								'meta_key'   => 'better_slider_style',
								'meta_value' => 'style-7',
							),
						),
						'the_id'    => 'taxonomy.primary.3',
					),
					array(
						'name'     => 'Hype',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.13',
					),
					array(
						'name'     => 'iDecide',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.12',
					),
					array(
						'name'      => 'lifestyle',
						'taxonomy'  => 'category',
						'term_meta' => array(
							array(
								'meta_key'   => 'slider_type',
								'meta_value' => 'custom-blocks',
							),
							array(
								'meta_key'   => 'better_slider_style',
								'meta_value' => 'style-5',
							),
						),
						'the_id'    => 'taxonomy.primary.4',
					),
					array(
						'name'     => 'Minorities',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.15',
					),
					array(
						'name'      => 'photography',
						'taxonomy'  => 'category',
						'term_meta' => array(
							array(
								'meta_key'   => 'slider_type',
								'meta_value' => 'custom-blocks',
							),
							array(
								'meta_key'   => 'better_slider_style',
								'meta_value' => 'style-17',
							),
						),
						'the_id'    => 'taxonomy.primary.5',
					),
					array(
						'name'     => 'Video',
						'taxonomy' => 'post_format',
						'the_id'   => 'taxonomy.primary.16',
					),
					array(
						'name'     => 'Providers',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.14',
					),
					array(
						'name'     => 'travel',
						'taxonomy' => 'category',
						'the_id'   => 'taxonomy.primary.6',
					),
					array(
						'name'     => 'video',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.7',
					),
				),
			),
		//
		// ->Posts
		//
		'posts'    =>
			array(
				'multi_steps' => false,
				array(
					array(
						'post_title'        => 'The Absolute Worst Running Mistake I’ve Ever Made',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.109',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'Too early for a new year’s resolution? Not at Aldi!',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.136',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'Dunkirk, France: in the footsteps of its military history',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.219',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'St. Moritz: an adventure in fine dining and gastronomy',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.188',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Caffeine cultures and how to order a coffee abroad',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.187',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'Q&A: Can I carry Christmas dinner in my hand luggage?',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.183',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Dr. Oz: 5 Tips For Lasting Love, Health, And Happiness',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.171',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => '7 Things That Might Happen If You Stop Wearing Makeup',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.168',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'Asking For A Friend: Can I Skip The Post-Workout Shower?',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.165',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => '10 High-Tech Beauty Products Worth Every Penny',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.158',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Beginner’s Guide To Starting Your Own Fitness Studio',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.154',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Top National Trust gardens where to see snowdrops',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.141',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'The best new addition to the Dublin bakery scene',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.139',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'New fine-dining chapter for life in a Dublin nursing home',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.138',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'Introducing the Dublin venue that’s all about comfort food',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.135',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Celebrity interview: 1 minute travel with Helen Lederer',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.193',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'Indulge in an extra special Sunday with this wine event',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.134',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => '11 reasons you’ll want to devour Easy Food September',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.132',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'How to find a taste of old Ireland in modern-day Dublin',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.133',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Jack(fruit) of all trades – what you need to know',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.131',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'This new Dalkey gastropub has everything you want',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.127',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Steal These Strength Moves From Star Trainer Emily Skye',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.114',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => '5 Masturbation Tips For A Mind-Blowing Solo Session',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.110',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'How To Be Friendly (Not Flirty!) With Male Friends',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.106',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'Do These Yoga Poses When You’re Super Pissed Off',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.107',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Why Sleep Is More Important Than We Ever Thought',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.108',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Save Your Dry Winter Hair With These DIY Masks',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.105',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'Why You Should Never Eat Lunch At Your Desk Again',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.104',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'How To Apply Foundation For Flawless, Even Skin',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.100',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'Top 10 things to see and do in Nothern Ethiopia',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.191',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Review: Adventure Yogi – Yoga Retreat in East Sussex, UK',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.190',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'The Olivier da Costa restaurant experience in Lisbon',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.194',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => '13 Apps That Can Help Ease Depression And Anxiety',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.112',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Gastein and Grossarl – two ski valleys in Austria',
						'post_format'       => 'video',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category'    => '%%taxonomy.primary.5%%',
							'post_format' => '%%taxonomy.primary.16%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'blacdetroit.com',
							),
							array(
								'meta_key'   => '_bs_source_url',
								'meta_value' => 'http://blacdetroit.com',
							),
						),
						'the_id'            => 'posts.primary.189',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'Travel Guide: 24 hours in Freetown, Sierra Leone',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.185',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'BREAKING: Serena Williams Is 20 Weeks Pregnant!',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.163',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'The 50 Hottest Players At The 2018 World Cup',
						'post_format'       => 'video',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category'    => '%%taxonomy.primary.2%%',
							'post_format' => '%%taxonomy.primary.16%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'blacdetroit.com',
							),
							array(
								'meta_key'   => '_bs_source_url',
								'meta_value' => 'http://blacdetroit.com',
							),
						),
						'the_id'            => 'posts.primary.102',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'The Best Foods To Eat When You’re On Your Period',
						'post_format'       => 'video',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category'    => '%%taxonomy.primary.4%%',
							'post_format' => '%%taxonomy.primary.16%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'blacdetroit.com',
							),
							array(
								'meta_key'   => '_bs_source_url',
								'meta_value' => 'http://blacdetroit.com',
							),
						),
						'the_id'            => 'posts.primary.169',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => '50 Must-Know Fitness Facts To Shape Your Dream Body',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.111',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Rasa Gurukul: a new eco spiritual retreat in Kerala, India',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.224',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'All about fibre: the tips and tricks you need to know',
						'post_format'       => 'video',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category'    => '%%taxonomy.primary.3%%',
							'post_format' => '%%taxonomy.primary.16%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'blacdetroit.com',
							),
							array(
								'meta_key'   => '_bs_source_url',
								'meta_value' => 'http://blacdetroit.com',
							),
						),
						'the_id'            => 'posts.primary.129',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'Forget Diet And Exercise–Do You Have The Fit Gene?',
						'post_format'       => 'video',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category'    => '%%taxonomy.primary.4%%',
							'post_format' => '%%taxonomy.primary.16%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'blacdetroit.com',
							),
							array(
								'meta_key'   => '_bs_source_url',
								'meta_value' => 'http://blacdetroit.com',
							),
						),
						'the_id'            => 'posts.primary.166',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Top 10 remote destinations to see in your lifetime',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.195',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'Is That Normal? 9 Surprising Changes With Age',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.198',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => '10 of the best places to see Britain’s Autumn colours',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.225',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'How to live well? Less hassle and more healthy foods!',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.137',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => '3 Butt And Thigh Moves Celebrity Trainers Swear By',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.162',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'Airport delays in Europe – your questions answered',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.220',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'Melissa McCarthy Shows Off 45-Pound Weight Loss',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.192',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'How to celebrate the Chinese New Year in Hong Kong',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.213',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'Thailand: Alternative Bangkok and spiritual Chiang Mai',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.215',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'The Food Eva Mendes Won’t Start Her Day Without',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.167',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Top 10 things to do and see in San Diego, California',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.217',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'South Africa: Knysna forests and mythical elephants',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.218',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Surfing in the Philippines: riding the Cloud 9 in Siargao',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.221',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Why I took my date to Club Chinois in Mayfair, London',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.222',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'Where to experience the Dutch Golden Age in Amsterdam',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.223',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'Discovering Uzbekistan: At the centre of the Silk Road',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.226',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Everything You Need To Know About Leaky Gut Syndrome',
						'post_format'       => 'video',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category'    => '%%taxonomy.primary.4%%',
							'post_format' => '%%taxonomy.primary.16%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'blacdetroit.com',
							),
							array(
								'meta_key'   => '_bs_source_url',
								'meta_value' => 'http://blacdetroit.com',
							),
						),
						'the_id'            => 'posts.primary.170',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => '9 Ways To Fight Depression–Besides Taking Pills',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.164',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_type'         => 'page',
						'post_title'        => 'About Us',
						'post_content_file' => $demo_path . 'post-content-1.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_meta'         => array(
							array(
								'meta_key'   => 'page_layout',
								'meta_value' => '1-col',
							),
						),
						'the_id'            => 'posts.primary.82',
					),
					array(
						'post_type'         => 'page',
						'post_title'        => 'Front Page',
						'post_content_file' => $demo_path . 'post-content-2.txt',
						'post_excerpt_file' => $demo_path . 'post-excerpt.txt',
						'post_meta'         => array(
							array(
								'meta_key'   => 'page_layout',
								'meta_value' => '1-col',
							),
						),
						'the_id'            => 'posts.primary.81',
					),
					array(
						'post_type'  => 'better-banner',
						'post_title' => 'inline Banner',
						'post_meta'  => array(
							array(
								'meta_key'   => 'type',
								'meta_value' => 'image',
							),
							array(
								'meta_key'   => 'img',
								'meta_value' => '%%bf_product_demo_media_url:{media.primary.banner-inline}:\'full\'%%',
							),
							array(
								'meta_key'   => 'url',
								'meta_value' => 'https://betterstudio.com/publisher-wp-theme/pricing/',
							),
							array(
								'meta_key'   => 'caption',
								'meta_value' => '- Advertisement -',
							),
							array(
								'meta_key'   => 'campaign',
								'meta_value' => 'none',
							),
						),
						'the_id'     => 'posts.primary.79',
					),
					array(
						'post_type'  => 'better-banner',
						'post_title' => 'Sidebar Banner',
						'post_meta'  => array(
							array(
								'meta_key'   => 'type',
								'meta_value' => 'image',
							),
							array(
								'meta_key'   => 'img',
								'meta_value' => '%%bf_product_demo_media_url:{media.primary.banner-sidebar}:\'full\'%%',
							),
							array(
								'meta_key'   => 'url',
								'meta_value' => 'https://betterstudio.com/publisher-wp-theme/pricing/',
							),
							array(
								'meta_key'   => 'caption',
								'meta_value' => '- Advertisement -',
							),
							array(
								'meta_key'   => 'campaign',
								'meta_value' => 'none',
							),
						),
						'the_id'     => 'posts.primary.70',
					),
					array(
						'post_type'  => 'better-banner',
						'post_title' => 'Header Banner',
						'post_meta'  => array(
							array(
								'meta_key'   => 'type',
								'meta_value' => 'image',
							),
							array(
								'meta_key'   => 'img',
								'meta_value' => '%%bf_product_demo_media_url:{media.primary.banner-header}:\'full\'%%',
							),
							array(
								'meta_key'   => 'url',
								'meta_value' => 'https://betterstudio.com/publisher-wp-theme/pricing/',
							),
							array(
								'meta_key'   => 'caption',
								'meta_value' => '- Advertisement -',
							),
							array(
								'meta_key'   => 'campaign',
								'meta_value' => 'none',
							),
						),
						'the_id'     => 'posts.primary.24',
					),
					array(
						'post_type'  => 'bsnp-newsletter',
						'post_title' => 'Newsletter',
						'post_meta'  => array(
							array(
								'meta_key'   => 'type',
								'meta_value' => 'feedburner',
							),
							array(
								'meta_key'   => 'feedburner_id',
								'meta_value' => '#',
							),
							array(
								'meta_key'   => 'style',
								'meta_value' => 'style-3',
							),
						),
						'the_id'     => 'posts.primary.76',
					),
				),
			),
		//
		// ->Options
		//
		'options'  =>
			array(
				'multi_steps' => false,
				array(
					array(
						'type'              => 'option',
						'option_name'       => publisher_get_theme_panel_id(),
						'option_value_file' => $demo_path . 'options.json',
					),
					array(
						'type'          => 'option',
						'option_name'   => publisher_get_theme_panel_id(),
						'option_value'  => array(
							'logo_image'        => '%%bf_product_demo_media_url:{media.primary.logo-main}:\'full\'%%',
							'logo_image_retina' => '%%bf_product_demo_media_url:{media.primary.logo-main-retina}:\'full\'%%',
							'off_canvas_logo'   => '%%bf_product_demo_media_url:{media.primary.logo-off-canvas}:\'full\'%%',
						),
						'merge_options' => true,
					),
					array(
						'type'         => 'option',
						'option_name'  => publisher_get_theme_panel_id() . '_current_style',
						'option_value' => $style_id,
					),
					array(
						'type'         => 'option',
						'option_name'  => publisher_get_theme_panel_id() . '_current_demo',
						'option_value' => $style_id,
					),
					array(
						'type'         => 'option',
						'option_name'  => 'page_on_front',
						'option_value' => '%%posts.primary.81%%',
					),
					array(
						'type'         => 'option',
						'option_name'  => 'show_on_front',
						'option_value' => 'page',
					),
					array(
						'type'          => 'option',
						'option_name'   => 'better_ads_manager',
						'option_value'  => array(
							'ad_post_inline'           => array(
								array(
									'type'      => 'banner',
									'campaign'  => 'none',
									'banner'    => '254',
									'count'     => '3',
									'columns'   => '3',
									'orderby'   => 'rand',
									'order'     => 'ASC',
									'align'     => 'left',
									'paragraph' => '2',
								),
							),
							'header_aside_logo_type'   => 'banner',
							'header_aside_logo_banner' => '%%posts.primary.24%%',
						),
						'merge_options' => true,
					),
				),
			),
		//
		// ->Widgets
		//
		'widgets'  =>
			array(
				'multi_steps' => false,
				array(
					'primary-sidebar' => array(
						'remove_all_widgets' => true,
						array(
							'widget_id'       => 'better-ads',
							'widget_settings' => array(
								'type'                 => 'banner',
								'banner'               => '%%posts.primary.70%%',
								'bf-widget-title-icon' => array(
									'icon'      => '',
									'type'      => '',
									'height'    => '',
									'width'     => '',
									'font_code' => '',
								),
								'columns'              => '1',
							),
						),
						array(
							'widget_id'       => 'bs-thumbnail-listing-1',
							'widget_settings' => array(
								'title'                 => 'Popular Posts',
								'count'                 => '5',
								'order_by'              => 'popular',
								'columns'               => 1,
								'pagination-show-label' => '1',
								'listing-settings'      => array(
									'thumbnail-type'    => 'featured-image',
									'title-limit'       => '60',
									'subtitle'          => '0',
									'subtitle-limit'    => '0',
									'subtitle-location' => 'before-meta',
									'show-ranking'      => '1',
									'meta'              => array(
										'show'        => '1',
										'author'      => '0',
										'date'        => '1',
										'date-format' => 'standard',
										'view'        => '0',
										'share'       => '0',
										'comment'     => '0',
										'review'      => '1',
									),
								),
								'disable_duplicate'     => '0',
								'bf-widget-title-icon'  => array(
									'icon'      => '',
									'type'      => '',
									'height'    => '',
									'width'     => '',
									'font_code' => '',
								),
								'paginate'              => 'none',
							),
						),
						array(
							'widget_id'       => 'newsletter-pack',
							'widget_settings' => array(
								'newsletter'           => '%%posts.primary.76%%',
								'bf-widget-title-icon' => array(
									'icon'      => '',
									'type'      => '',
									'height'    => '',
									'width'     => '',
									'font_code' => '',
								),
							),
						),
					),
					'footer-1'        => array(
						'remove_all_widgets' => true,
						array(
							'widget_id'       => 'bs-about',
							'widget_settings' => array(
								'content'              => 'Publisher is the useful and powerful WordPress Newspaper Magazine and Blog theme with great attention to details, incredible features, an intuitive user interface and everything else you need to create outstanding websites.
         
         • Email: info@yoursite.com
         • Phone: 844-698-6394',
								'logo_img'             => '%%bf_product_demo_media_url:{media.primary.footer-logo}:\'full\'%%',
								'link_facebook'        => '#',
								'link_twitter'         => '#',
								'link_google'          => '#',
								'link_instagram'       => '#',
								'title'                => '',
								'bf-widget-title-icon' => array(
									'icon'      => '',
									'type'      => '',
									'height'    => '',
									'width'     => '',
									'font_code' => '',
								),
							),
						),
					),
					'footer-2'        => array(
						'remove_all_widgets' => true,
						array(
							'widget_id'       => 'bs-thumbnail-listing-1',
							'widget_settings' => array(
								'title'                 => 'TRENDING POSTS',
								'count'                 => '3',
								'columns'               => 1,
								'pagination-show-label' => '1',
								'listing-settings'      => array(
									'thumbnail-type'    => 'featured-image',
									'title-limit'       => '60',
									'subtitle'          => '0',
									'subtitle-limit'    => '0',
									'subtitle-location' => 'before-meta',
									'show-ranking'      => '0',
									'meta'              => array(
										'show'        => '1',
										'author'      => '0',
										'date'        => '1',
										'date-format' => 'standard',
										'view'        => '0',
										'share'       => '0',
										'comment'     => '0',
										'review'      => '1',
									),
								),
								'disable_duplicate'     => '0',
								'bf-widget-title-color' => '#ffffff',
								'bf-widget-title-icon'  => array(
									'icon'      => '',
									'type'      => '',
									'height'    => '',
									'width'     => '',
									'font_code' => '',
								),
								'paginate'              => 'none',
							),
						),
					),
					'footer-3'        => array(
						'remove_all_widgets' => true,
						array(
							'widget_id'       => 'nav_menu',
							'widget_settings' => array(
								'title'                 => 'Links',
								'nav_menu'              => '%%menus.primary.1%%',
								'bf-widget-title-color' => '#ffffff',
								'bf-widget-title-icon'  => array(
									'icon'      => '',
									'type'      => '',
									'height'    => '',
									'width'     => '',
									'font_code' => '',
								),
							),
						),
					),
				),
			),
		//
		// ->Media
		//
		'media'    =>
			array(
				'multi_steps' => true,
				array(
					'file'   => $demo_image_url . $prefix . 'Header-Logo.png',
					'the_id' => 'media.primary.logo-main',
				),
				array(
					'file'   => $demo_image_url . $prefix . 'Header-Logo-Retina.png',
					'the_id' => 'media.primary.logo-main-retina',
				),
				array(
					'file'   => $demo_image_url . $prefix . 'Off-Canvas-Logo.png',
					'the_id' => 'media.primary.logo-off-canvas',
				),
				array(
					'file'   => $demo_image_url . $prefix . 'Footer-Logo.png',
					'the_id' => 'media.primary.footer-logo',
				),
				array(
					'file'   => $demo_image_url . $prefix . '300x250-post-single.png',
					'the_id' => 'media.primary.banner-inline',
				),
				array(
					'file'   => $demo_image_url . $prefix . 'banner-header.png',
					'the_id' => 'media.primary.banner-header',
				),
				array(
					'file'   => $demo_image_url . $prefix . '336x280-sidebar-index.png',
					'the_id' => 'media.primary.banner-sidebar',
				),
				array(
					'file'   => $demo_image_url . $prefix . 'thumb-1.jpg',
					'resize' => true,
					'the_id' => 'media.primary.thumb-1',
				),
				array(
					'file'   => $demo_image_url . $prefix . 'thumb-2.jpg',
					'resize' => true,
					'the_id' => 'media.primary.thumb-2',
				),
				array(
					'file'   => $demo_image_url . $prefix . 'thumb-3.jpg',
					'resize' => true,
					'the_id' => 'media.primary.thumb-3',
				),
				array(
					'file'   => $demo_image_url . $prefix . 'thumb-4.jpg',
					'resize' => true,
					'the_id' => 'media.primary.thumb-4',
				),
				array(
					'file'   => $demo_image_url . $prefix . 'thumb-5.jpg',
					'resize' => true,
					'the_id' => 'media.primary.thumb-5',
				),
				array(
					'file'   => $demo_image_url . $prefix . 'thumb-6.jpg',
					'resize' => true,
					'the_id' => 'media.primary.thumb-6',
				),
				array(
					'file'   => $demo_image_url . $prefix . 'thumb-7.jpg',
					'resize' => true,
					'the_id' => 'media.primary.thumb-7',
				),
			),

		//
		// ->Menus
		//
		'menus'    =>
			array(
				'multi_steps' => false,
				array(
					array(
						'menu-location' => 'main-menu',
						'menu-name'     => 'Main Navigation',
						'recently-edit' => true,
						'the_id'        => 'menus.primary.1',
						'items'         => array(
							array(
								'item_type' => 'page',
								'title'     => 'Home',
								'page_id'   => '%%posts.primary.81%%',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.4%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.2%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.6%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.5%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.3%%',
								'taxonomy'  => 'category',
							),
						),
					),
					array(
						'menu-location' => 'top-menu',
						'menu-name'     => 'Top Navigation',
						'the_id'        => 'menus.top.1',
						'items'         => array(
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.5%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'page',
								'title'     => 'About Us',
								'page_id'   => '%%posts.primary.82%%',
							),
						),
					),
				),
			),
	);
}
