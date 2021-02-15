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

	$style_id       = 'mini-mag';
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
						'name'     => 'ARCHITECTURE',
						'taxonomy' => 'category',
						'the_id'   => 'taxonomy.primary.2',
					),
					array(
						'name'     => 'ART',
						'taxonomy' => 'category',
						'the_id'   => 'taxonomy.primary.3',
					),
					array(
						'name'     => 'Charleston',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.13',
					),
					array(
						'name'     => 'INTERIORS',
						'taxonomy' => 'category',
						'the_id'   => 'taxonomy.primary.4',
					),
					array(
						'name'     => 'Partnership',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.15',
					),
					array(
						'name'     => 'Video',
						'taxonomy' => 'post_format',
						'the_id'   => 'taxonomy.primary.17',
					),
					array(
						'name'     => 'Product Design',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.12',
					),
					array(
						'name'     => 'Snowball Effect',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.14',
					),
					array(
						'name'     => 'Style',
						'taxonomy' => 'category',
						'the_id'   => 'taxonomy.primary.11',
					),
					array(
						'name'     => 'TECH',
						'taxonomy' => 'category',
						'the_id'   => 'taxonomy.primary.6',
					),
					array(
						'name'     => 'VIDEOS',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.8',
					),
					array(
						'name'     => 'Wondering',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.16',
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
						'post_title'        => 'The Physics of Catching a Gnarly 80-Foot-Tall Wave',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.171',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'The Serious Security Problem Looming Over Robotics',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.167',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'Next-Gen Nuclear Is Coming—If Society Wants It',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.195',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'Why Big Stuff Cools Off Slower Than Small Stuff',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.194',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'How to Watch Friday’s Super-Long Lunar Eclipse',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.193',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Why Big Stuff Cools Off Slower Than Small Stuff',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.192',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Robots Are Renting Airbnbs to Get a Better Grip',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.190',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'What Termites Teach Us About Robot Cooperation',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.188',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'This Solar Probe Is Built to Survive a Brush With the Sun',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.175',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'Watch a Harlem Globetrotter Sink a Shot from a Plane',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.174',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Before Using Birth Control Apps, Consider Your Privacy',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.172',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'What Tech Has—and Hasn’t—Done for Puerto Rico',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.170',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'Trump\'s New Power Plan Comes With a Deadly Price',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.169',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'Germany Has Proven the Modern Automobile Must Die',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.168',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'The Spiky Simulator That Will Help Find Oceans in Space',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.164',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'What\'s a Blazar? A Galactic Bakery for Cosmic Rays',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.199',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'What if Ketamine Actually Works Like an Opioid?',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.162',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => '23andMe Cuts Off the DNA App Ecosystem It Created',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.147',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Fall Is Here! Time to Learn the Physics of... Falling',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.146',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'You Can Drink Champagne in Space—Yes, Really',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.144',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'A New Robotic Fly Dips and Dives Like the Real Thing',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.145',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'Trump\'s Auto Emissions Plan Is Full of Faulty Logic',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.121',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Cats Bad at Nabbing Rats But Feast on Other Beasts',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.120',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'A Brain-Eating Amoeba Just Claimed Another Victim',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.119',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'Swarms of Supersize Mosquitoes Besiege North Carolina',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.118',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'It’s Time to Talk About Robot Gender Stereotypes',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.117',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Physicists Condemn Sexism Through ‘Particles for Justice’',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.115',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'Watch Boston Dynamics\' Humanoid Robot Do Parkour',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.113',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'How to Get Better at \'Back of the Envelope\' Calculations',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.111',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Marc Benioff Bets on Cleanup Tech for Ocean Trash',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.137',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'Some Scientists Work With China, but NASA Won\'t',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.197',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Where Can Climate Activists Find Common Ground?',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.198',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'At the Edge of the World, Facing the End of the World',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.143',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Boston Dynamics Is Prepping Its Robot Dog to Get a Job',
						'post_format'       => 'video',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category'    => '%%taxonomy.primary.6%%',
							'post_format' => '%%taxonomy.primary.17%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => 'post_template',
								'meta_value' => 'style-10',
							),
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'Publisher Theme',
							),
							array(
								'meta_key'   => '_bs_source_url',
								'meta_value' => 'https://betterstudio.com/publisher-wp-theme/',
							),
						),
						'the_id'            => 'posts.primary.109',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Bill Gates on How Blood Will Soon Tell Us Everything',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.141',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'Want a Robot to Really Get a Grip? Make It Like Baymax',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.122',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Enlisting Our Own Germs to Help Us Battle Infections',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.139',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'How NASA Will Watch the 2018 Perseid Meteor Shower',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.173',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Why Animal Extinction Is Crippling Computer Science',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.134',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Bars and Restaurants: 50 Examples in Plan and Section',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.221',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'How NASA Built a Shark Tank for Space Inventions',
						'post_format'       => 'video',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category'    => '%%taxonomy.primary.4%%',
							'post_format' => '%%taxonomy.primary.17%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => 'post_template',
								'meta_value' => 'style-10',
							),
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'Publisher Theme',
							),
							array(
								'meta_key'   => '_bs_source_url',
								'meta_value' => 'https://betterstudio.com/publisher-wp-theme/',
							),
						),
						'the_id'            => 'posts.primary.166',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'Why Do You Feel Lighter at the Top of a Ferris Wheel?',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.196',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'How Are Planets Made? With Very Little Stuff, It Seems',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.116',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Why Hurricane Michael\'s Storm Surge Is So High',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.6%%',
						),
						'the_id'            => 'posts.primary.114',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'The Physics of Launching Fireworks From a Drone',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.3%%',
						),
						'the_id'            => 'posts.primary.201',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'How to Easily Locate the Accelerometer in an iPhone',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.142',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'We Have No Idea How Bad the US Tick Problem Is',
						'post_format'       => 'video',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category'    => '%%taxonomy.primary.3%%',
							'post_format' => '%%taxonomy.primary.17%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => 'post_template',
								'meta_value' => 'style-10',
							),
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'Publisher Theme',
							),
							array(
								'meta_key'   => '_bs_source_url',
								'meta_value' => 'https://betterstudio.com/publisher-wp-theme/',
							),
						),
						'the_id'            => 'posts.primary.200',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Hair Salons and Barbershops: Examples in Plan and Section',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.222',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Building Better Schools: 6 Ways to Help Our Children Learn',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.213',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Architecture: the Unsung Hero of Your Favorite Film',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.216',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => '35 Fireplaces that Spark Architectural Interest',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.218',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'This Week in Architecture: Visions from the Future',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.220',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => '25 Design Tips to Make Your Airbnb Listing Stand Out',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.225',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'The Beauty of Pre-Oxidized Copper Through 8 Facades',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.219',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => '111 "Magical Towns" That You Must Visit in Mexico',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.223',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Building Information Modeling is More than Software',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.226',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Cultural Centers: 50 Examples in Plan and Section',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.227',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'This Week in Architecture: Complexity and Contradiction',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.224',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'Geology Is Like Augmented Reality for the Planet',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.148',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Here\'s How Fast That Jumping Tesla Was Traveling',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.149',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_type'         => 'page',
						'post_title'        => 'About Us',
						'post_content_file' => $demo_path . 'post-content-1.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'post_meta'         => array(
							array(
								'meta_key'   => 'page_layout',
								'meta_value' => '1-col',
							),
						),
						'the_id'            => 'posts.primary.76',
					),
					array(
						'post_type'         => 'page',
						'post_title'        => 'Front Page',
						'post_content_file' => $demo_path . 'post-content-2.txt',
						'post_excerpt'      => 'A 1960\'s yellow brick bungalow in Sydney is transformed to include a dramatic ...',
						'prepare_vc_css'    => true,
						'post_meta'         => array(
							array(
								'meta_key'   => 'page_layout',
								'meta_value' => '1-col',
							),
						),
						'the_id'            => 'posts.primary.47',
					),
					array(
						'post_type'  => 'better-banner',
						'post_title' => 'banner Single Post',
						'post_meta'  => array(
							array(
								'meta_key'   => 'type',
								'meta_value' => 'image',
							),
							array(
								'meta_key'   => 'img',
								'meta_value' => '%%bf_product_demo_media_url:{media.primary.banner-paragraph}:\'full\'%%',
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
						'the_id'     => 'posts.primary.372',
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
						'the_id'     => 'posts.primary.369',
					),
					array(
						'post_type'  => 'bsnp-newsletter',
						'post_title' => 'Newsltter',
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
								'meta_value' => 'style-9',
							),
						),
						'the_id'     => 'posts.primary.375',
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
						'option_value' => '%%posts.primary.47%%',
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
							'ad_post_inline' => array(
								array(
									'type'      => 'banner',
									'campaign'  => 'none',
									'banner'    => '372',
									'count'     => '3',
									'columns'   => '3',
									'orderby'   => 'rand',
									'order'     => 'ASC',
									'align'     => 'left',
									'paragraph' => '7',
								),
							),
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
								'banner'               => '%%posts.primary.369%%',
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
								'title'                 => 'Popular Post',
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
								'bf-widget-title-color' => '#000000',
								'bf-widget-title-icon'  => array(
									'icon'      => '',
									'type'      => '',
									'height'    => '',
									'width'     => '',
									'font_code' => '',
								),
								'bf-widget-title-style' => 't5-s1',
								'paginate'              => 'none',
							),
						),
						array(
							'widget_id'       => 'newsletter-pack',
							'widget_settings' => array(
								'newsletter'           => '%%posts.primary.375%%',
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
								'logo_img'             => '%%bf_product_demo_media_url:{media.primary.footer-logo}:\'full\'%%',
								'link_facebook'        => '#',
								'link_twitter'         => '#',
								'link_google'          => '#',
								'link_instagram'       => '#',
								'link_email'           => '#',
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
					'file'   => $demo_image_url . $prefix . 'Footer-Logo.png',
					'the_id' => 'media.primary.footer-logo',
				),
				array(
					'file'   => $demo_image_url . $prefix . '300x250-post-single.jpg',
					'the_id' => 'media.primary.banner-paragraph',
				),
				array(
					'file'   => $demo_image_url . $prefix . 'sidebar-single.jpg',
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
						'items'         => array(
							array(
								'item_type' => 'page',
								'title'     => 'Home',
								'page_id'   => '%%posts.primary.47%%',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.2%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.3%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.4%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.6%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'page',
								'title'     => 'About Us',
								'page_id'   => '%%posts.primary.76%%',
							),
						),
					),
					array(
						'menu-location' => 'footer-menu',
						'menu-name'     => 'Footer Navigation',
						'items'         => array(
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.2%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.3%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.4%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.6%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'page',
								'title'     => 'About Us',
								'page_id'   => '%%posts.primary.76%%',
							),
						),
					),
				),
			),
	);
}
