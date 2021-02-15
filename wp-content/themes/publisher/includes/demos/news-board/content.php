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

	$style_id       = 'news-board';
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
						'name'     => 'China',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.21',
					),
					array(
						'name'     => 'Culture',
						'taxonomy' => 'category',
						'the_id'   => 'taxonomy.primary.7',
					),
					array(
						'name'     => 'ECONOMY',
						'taxonomy' => 'category',
						'the_id'   => 'taxonomy.primary.2',
					),
					array(
						'name'     => 'Germany',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.20',
					),
					array(
						'name'     => 'Han Bao',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.19',
					),
					array(
						'name'     => 'Munich Security',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.18',
					),
					array(
						'name'     => 'POLITICS',
						'taxonomy' => 'category',
						'the_id'   => 'taxonomy.primary.4',
					),
					array(
						'name'     => 'Sport',
						'taxonomy' => 'category',
						'the_id'   => 'taxonomy.primary.8',
					),
					array(
						'name'     => 'US',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.17',
					),
					array(
						'name'     => 'VIDEO',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.10',
					),
					array(
						'name'     => 'WORLD',
						'taxonomy' => 'category',
						'the_id'   => 'taxonomy.primary.9',
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
						'post_title'        => 'The $1 billion price cut: Luxury real estate gets slashed',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.321',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => '5 Musical Gap Year Opportunities to Inspire Your Next Hit',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.263',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'Cramer Remix: Zillow\'s risky move has not paid off',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.7%%',
						),
						'the_id'            => 'posts.primary.339',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Pending home sales fall for seventh straight month in July',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.323',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Rockets\' Zhou Qi hurts knee in exhibition game vs. Shanghai',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.213',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'US consumer prices increase less than expected in August',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.320',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'China warns it will retaliate if US slaps on new tariffs',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.319',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'US weekly jobless claims drop to a near 49-year low',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.316',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'US consumer spending increased steadily in August',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.315',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Services sector grows at fastest pace ever in September',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.292',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'The five most important numbers from today\'s jobs report',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.290',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Winter Study Abroad: All of the Fun, None of the Sweat',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.274',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Moving Abroad After College: Not as Scary as It Sounds',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.270',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'Back from Working / Interning Abroad? What to Do Next',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.269',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Democrats lining up to consider challenging Collins in 2020',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.212',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'Square falls 9% on concerns of \'overlooked credit risk\'',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.7%%',
						),
						'the_id'            => 'posts.primary.345',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Netflix to bring new US production hub to New Mexico',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.211',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Suu Kyi promises \'transparency\' over Rohingya atrocities',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.208',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'Florida Democrats sue to extend voter registration deadline',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.207',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'The 7 Home Decor Sales We\'re Excited About This Week',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.206',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Pasta loaded with tender bites of sausage, kale and beans',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.202',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Wounded Syrian soldiers learn to live with war disabilities',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.200',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'Justice Brett Kavanaugh makes his Supreme Court debut',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.181',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'UN report on global warming carries life-or-death warning',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.179',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Nobel peace prize winner wants IS jihadists to face trial',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.178',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'How Nikki Haley Left the Trump Administration on Her Own Terms',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.174',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'Georgia Woman Calls Police On Black Man Babysitting White Kids',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.172',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'China says detained former Interpol chief accused of bribery',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.170',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'All together now: Nato and Serbia put bombing behind them',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.168',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'A dramatic twilight SpaceX launch freaked out people in LA',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.7%%',
						),
						'the_id'            => 'posts.primary.341',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Elon Musk accuses BlackRock of helping short sellers',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.7%%',
						),
						'the_id'            => 'posts.primary.344',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'Jeff Bezos shares his advice for dealing with criticism',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.7%%',
						),
						'the_id'            => 'posts.primary.346',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => '10 International Job Interview Questions and How to CRUSH ‘EM',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.275',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Pope meets top US cardinal in shadow of abuse scandal',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.180',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Watch: Jeff Bezos speaks after winning service award',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.7%%',
						),
						'the_id'            => 'posts.primary.351',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'Nikki Haley to Leave as UN Envoy at Year\'s End in Surprise Exit',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.176',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'The Pros & Cons of Getting a Masters Degree in England',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.273',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'Liz Weston: How to fund college if you didn\'t save enough',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.177',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'Two dozen races will determine control of House: Republican memo',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.214',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => '10 Best Study Abroad Programs in Australia in 2018-2019',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.276',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'Canada rejoins NAFTA talks as US autos tariff details emerge',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.324',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'EBay accuses Amazon of \'unlawful\' merchant poaching',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.7%%',
						),
						'the_id'            => 'posts.primary.349',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => '9 Wonderfully Cheap Study Abroad Programs in Paris',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.271',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'The Fed has some big decisions to make starting next week',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.317',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => '6 Cool Summer Internships for High School Students Abroad',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.267',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Apple tells Congress it found no signs of a hacking attack',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.7%%',
						),
						'the_id'            => 'posts.primary.343',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'Tesla beats Wall Street estimates for overall vehicle deliveries',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.7%%',
						),
						'the_id'            => 'posts.primary.352',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'Thank you r/relationships for giving me the drama fix I crave',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.203',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Elon Musk\'s ultimatum to Tesla: Fight the SEC, or I quit',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.7%%',
						),
						'the_id'            => 'posts.primary.348',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'Amazon raises minimum wage to $15 for all US employees',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.7%%',
						),
						'the_id'            => 'posts.primary.350',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Police Find Marijuana Grow Operation at Home Day Care',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.210',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'warns paradigm shift needed to avert global climate chaos',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.175',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'It\'s better to rent than to buy in today\'s housing market',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.322',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'Here’s When to Quit Jobs Teaching English Abroad',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.265',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Blackstone president says US-China trade war will be resolved',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.318',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Wounded Syrian soldiers learn to live with war disabilities',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.173',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'How to Build a \'Fortress Door\' to Keep Out Brazen Thieves',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.4%%',
						),
						'the_id'            => 'posts.primary.209',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'How to Wow Everyone & Intern Abroad in High School',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.272',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Facebook stock is worth the risk, Mark Mahaney says',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.7%%',
						),
						'the_id'            => 'posts.primary.347',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => '10 Tips to Update Your Resume After Interning Abroad',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.268',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_type'         => 'page',
						'post_title'        => 'All Blocks',
						'post_content_file' => $demo_path . 'post-content-1.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'prepare_vc_css'    => true,
						'post_meta'         => array(
							array(
								'meta_key'   => 'page_layout',
								'meta_value' => '1-col',
							),
						),
						'the_id'            => 'posts.primary.163',
					),
					array(
						'post_type'         => 'page',
						'post_title'        => 'Newsletter',
						'post_content_file' => $demo_path . 'post-content-2.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_meta'         => array(
							array(
								'meta_key'   => 'page_layout',
								'meta_value' => '1-col',
							),
						),
						'the_id'            => 'posts.primary.37',
					),
					array(
						'post_type'         => 'page',
						'post_title'        => 'About Us',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'the_id'            => 'posts.primary.38',
					),
					array(
						'post_type'         => 'page',
						'post_title'        => 'Contact Us',
						'post_content_file' => $demo_path . 'post-content-3.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_meta'         => array(
							array(
								'meta_key'   => 'page_layout',
								'meta_value' => '1-col',
							),
						),
						'the_id'            => 'posts.primary.39',
					),
					array(
						'post_type'         => 'page',
						'post_title'        => 'Injection Location: After Header News Ticker',
						'post_content_file' => $demo_path . 'post-content-4.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'prepare_vc_css'    => true,
						'the_id'            => 'posts.primary.518',
					),
					array(
						'post_type'         => 'page',
						'post_title'        => 'Front Page',
						'post_content_file' => $demo_path . 'post-content-5.txt',
						'post_excerpt'      => 'Support for women in leadership is high. A majority of Americans say that there should be more female leaders in politics ...',
						'post_meta'         => array(
							array(
								'meta_key'   => 'page_layout',
								'meta_value' => '3-col-0',
							),
						),
						'the_id'            => 'posts.primary.36',
					),
					array(
						'post_type'  => 'better-banner',
						'post_title' => 'Post index',
						'post_meta'  => array(
							array(
								'meta_key'   => 'type',
								'meta_value' => 'image',
							),
							array(
								'meta_key'   => 'url',
								'meta_value' => 'https://betterstudio.com/publisher-wp-theme/pricing/',
							),
							array(
								'meta_key'   => 'campaign',
								'meta_value' => 'none',
							),
						),
						'the_id'     => 'posts.primary.365',
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
								'meta_key'   => 'url',
								'meta_value' => 'https://betterstudio.com/publisher-wp-theme/pricing/',
							),
							array(
								'meta_key'   => 'campaign',
								'meta_value' => 'none',
							),
							array(
								'meta_key'   => 'img',
								'meta_value' => '%%bf_product_demo_media_url:{media.primary.ad-728x90-header}:\'full\'%%',
							),
						),
						'the_id'     => 'posts.primary.359',
					),
					array(
						'post_type'  => 'better-banner',
						'post_title' => 'Sidebar Index - 300x600',
						'post_meta'  => array(
							array(
								'meta_key'   => 'type',
								'meta_value' => 'image',
							),
							array(
								'meta_key'   => 'url',
								'meta_value' => 'https://betterstudio.com/publisher-wp-theme/pricing/',
							),
							array(
								'meta_key'   => 'campaign',
								'meta_value' => 'none',
							),
						),
						'the_id'     => 'posts.primary.366',
					),
					array(
						'post_type'  => 'better-banner',
						'post_title' => 'Sidebar index',
						'post_meta'  => array(
							array(
								'meta_key'   => 'type',
								'meta_value' => 'image',
							),
							array(
								'meta_key'   => 'url',
								'meta_value' => 'https://betterstudio.com/publisher-wp-theme/pricing/',
							),
							array(
								'meta_key'   => 'campaign',
								'meta_value' => 'none',
							),
						),
						'the_id'     => 'posts.primary.367',
					),
					array(
						'post_type'  => 'better-banner',
						'post_title' => 'Post Content',
						'post_meta'  => array(
							array(
								'meta_key'   => 'type',
								'meta_value' => 'image',
							),
							array(
								'meta_key'   => 'url',
								'meta_value' => 'https://betterstudio.com/publisher-wp-theme/pricing/',
							),
							array(
								'meta_key'   => 'campaign',
								'meta_value' => 'none',
							),
						),
						'the_id'     => 'posts.primary.368',
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
								'meta_key'   => 'style',
								'meta_value' => 'style-3',
							),
						),
						'the_id'     => 'posts.primary.369',
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
							'logo_image'             => '%%bf_product_demo_media_url:{media.primary.logo-main}:\'full\'%%',
							'logo_image_retina'      => '%%bf_product_demo_media_url:{media.primary.logo-main-retina}:\'full\'%%',
							'off_canvas_logo'        => '%%bf_product_demo_media_url:{media.primary.logo-off-canvas}:\'full\'%%',
							'injection_after_header' => '%%posts.primary.518%%',
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
						'option_value' => '%%posts.primary.36%%',
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
									'banner'    => '368',
									'count'     => '3',
									'columns'   => '3',
									'orderby'   => 'rand',
									'order'     => 'ASC',
									'align'     => 'left',
									'paragraph' => '6',
								),
							),
							'header_aside_logo_type'   => 'banner',
							'header_aside_logo_banner' => '%%posts.primary.359%%',
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
							'widget_id'       => 'bs-text-listing-3',
							'widget_settings' => array(
								'title'                 => 'latest news',
								'count'                 => '5',
								'pagination-show-label' => '1',
								'listing-settings'      => array(
									'title-limit'       => '120',
									'excerpt-limit'     => '200',
									'subtitle'          => '0',
									'subtitle-limit'    => '0',
									'subtitle-location' => 'before-meta',
									'show-ranking'      => '',
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
								'columns'               => 1,
							),
						),
						array(
							'widget_id'       => 'better-social-counter',
							'widget_settings' => array(
								'title'                => 'social media',
								'style'                => 'style-11',
								'columns'              => '1',
								'order'                => array(
									'facebook'  => '1',
									'twitter'   => '1',
									'youtube'   => '1',
									'instagram' => '1',
									'rss'       => '1',
								),
								'bf-widget-title-icon' => array(
									'icon'      => '',
									'type'      => '',
									'height'    => '',
									'width'     => '',
									'font_code' => '',
								),
							),
						),
						array(
							'widget_id'       => 'better-ads',
							'widget_settings' => array(
								'type'                 => 'banner',
								'banner'               => '%%posts.primary.367%%',
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
					),
					'footer-1'        => array(
						'remove_all_widgets' => true,
						array(
							'widget_id'       => 'bs-about',
							'widget_settings' => array(
								'content'              => 'Publisher is the useful and powerful WordPress Newspaper Magazine and Blog theme with great attention to details, incredible features, an intuitive user interface and everything else you need to create outstanding websites.
         
         • Email: info@yoursite.com
         • Phone: 844-698-6394',
								'logo_img'             => 'https://demo.betterstudio.com/publisher/news-board/wp-content/uploads/sites/460/2019/01/Footer-Logo.png',
								'link_facebook'        => '#',
								'link_twitter'         => '#',
								'link_google'          => '#',
								'link_instagram'       => '#',
								'link_email'           => '#',
								'link_youtube'         => '#',
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
							'widget_id'       => 'nav_menu',
							'widget_settings' => array(
								'title'                => 'Company',
								'nav_menu'             => '%%menus.primary.1%%',
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
					'footer-3'        => array(
						'remove_all_widgets' => true,
						array(
							'widget_id'       => 'nav_menu',
							'widget_settings' => array(
								'title'                => 'Ads',
								'nav_menu'             => '%%menus.top.1%%',
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
					'footer-4'        => array(
						'remove_all_widgets' => true,
						array(
							'widget_id'       => 'nav_menu',
							'widget_settings' => array(
								'title'                => 'Links',
								'nav_menu'             => '%%menus.footer.1%%',
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
					'file'   => $demo_image_url . $prefix . 'Off-Canvas-Logo.png',
					'the_id' => 'media.primary.logo-off-canvas',
				),
				array(
					'file'   => $demo_image_url . $prefix . 'ad728x90-header.jpg',
					'the_id' => 'media.primary.ad-728x90-header',
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
						'the_id'        => 'menus.primary.1',
						'menu-name'     => 'Main Navigation',
						'recently-edit' => true,
						'items'         => array(
							array(
								'item_type' => 'page',
								'title'     => 'News',
								'page_id'   => '%%posts.primary.36%%',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.9%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.4%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.7%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.8%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.2%%',
								'taxonomy'  => 'category',
							),
						),
					),
					array(
						'menu-location' => 'top-menu',
						'the_id'        => 'menus.top.1',
						'menu-name'     => 'Topbar Navigation',
						'items'         => array(
							array(
								'item_type' => 'page',
								'title'     => 'Newsletter',
								'page_id'   => '%%posts.primary.37%%',
							),
							array(
								'item_type' => 'page',
								'title'     => 'About Us',
								'page_id'   => '%%posts.primary.38%%',
							),
							array(
								'item_type' => 'page',
								'title'     => 'Contact Us',
								'page_id'   => '%%posts.primary.39%%',
							),
						),
					),
					array(
						'menu-location' => 'footer-menu',
						'the_id'        => 'menus.footer.1',
						'menu-name'     => 'Footer Navigation',
						'items'         => array(
							array(
								'item_type' => 'page',
								'title'     => 'News',
								'page_id'   => '%%posts.primary.36%%',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.9%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.4%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.7%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.2%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.8%%',
								'taxonomy'  => 'category',
							),
						),
					),
				),
			),
	);
}
