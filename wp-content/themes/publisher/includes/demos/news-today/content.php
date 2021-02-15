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

	$style_id       = 'news-today';
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
						'name'      => 'Business',
						'taxonomy'  => 'category',
						'term_meta' => array(
							array(
								'meta_key'   => 'slider_type',
								'meta_value' => 'disable',
							),
						),
						'the_id'    => 'taxonomy.primary.2',
					),
					array(
						'name'     => 'Clinton',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.17',
					),
					array(
						'name'      => 'Culture',
						'taxonomy'  => 'category',
						'term_meta' => array(
							array(
								'meta_key'   => 'slider_type',
								'meta_value' => 'disable',
							),
						),
						'the_id'    => 'taxonomy.primary.20',
					),
					array(
						'name'     => 'Economy',
						'taxonomy' => 'category',
						'the_id'   => 'taxonomy.primary.10',
					),
					array(
						'name'      => 'Entertainment',
						'taxonomy'  => 'category',
						'term_meta' => array(
							array(
								'meta_key'   => 'slider_type',
								'meta_value' => 'disable',
							),
						),
						'the_id'    => 'taxonomy.primary.21',
					),
					array(
						'name'      => 'Lifestyle',
						'taxonomy'  => 'category',
						'term_meta' => array(
							array(
								'meta_key'   => 'slider_type',
								'meta_value' => 'disable',
							),
						),
						'the_id'    => 'taxonomy.primary.22',
					),
					array(
						'name'      => 'Opinion',
						'taxonomy'  => 'category',
						'term_meta' => array(
							array(
								'meta_key'   => 'better_slider_style',
								'meta_value' => 'style-17',
							),
						),
						'the_id'    => 'taxonomy.primary.5',
					),
					array(
						'name'     => 'Politic',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.18',
					),
					array(
						'name'      => 'Politics',
						'taxonomy'  => 'category',
						'term_meta' => array(
							array(
								'meta_key'   => 'better_slider_style',
								'meta_value' => 'style-15',
							),
						),
						'the_id'    => 'taxonomy.primary.8',
					),
					array(
						'name'     => 'Public',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.19',
					),
					array(
						'name'      => 'Sports',
						'taxonomy'  => 'category',
						'term_meta' => array(
							array(
								'meta_key'   => 'better_slider_style',
								'meta_value' => 'style-1',
							),
						),
						'the_id'    => 'taxonomy.primary.9',
					),
					array(
						'name'      => 'Technology',
						'taxonomy'  => 'category',
						'term_meta' => array(
							array(
								'meta_key'   => 'slider_type',
								'meta_value' => 'disable',
							),
						),
						'the_id'    => 'taxonomy.primary.23',
					),
					array(
						'name'     => 'Trump',
						'taxonomy' => 'post_tag',
						'the_id'   => 'taxonomy.primary.16',
					),
					array(
						'name'      => 'World',
						'taxonomy'  => 'category',
						'term_meta' => array(
							array(
								'meta_key'   => 'better_slider_style',
								'meta_value' => 'style-7',
							),
						),
						'the_id'    => 'taxonomy.primary.11',
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
						'post_title'        => 'Is Trump Driving Women Away From the GOP for Good?',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.175',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Serena Williams Breaks Silence on U.S. Open Controversy',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.230',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Kent Sorenson Was a Tea Party Hero. Then He Lost Everything.',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.185',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'Alabama Loves Sessions, But Not Enough to Stand Up to Trump',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.184',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'How an Unlikely Alliance Saved the Democrats 100 Years Ago',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.183',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Chemical spills put Italy’s underground physics lab in jeopardy',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.10%%',
						),
						'the_id'            => 'posts.primary.203',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'Trump administration to review human fetal tissue research',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.10%%',
						),
						'the_id'            => 'posts.primary.206',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'Neanderthals used their hands like tailors and painters',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.10%%',
						),
						'the_id'            => 'posts.primary.208',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'NASA climate mission Trump tried to kill moves forward',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.10%%',
						),
						'the_id'            => 'posts.primary.209',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'How Ballet Dancer Misty Copeland Shattered Barriers',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.227',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Son Heung-min Wants to Bring World Cup Glory to South Korea',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.233',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Ken Starr: Trump’s Defense Team Should Be ‘Very Concerned’',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.179',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Venus Williams Is Still in the Game—On and Off the Court',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.235',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Trump Is Feuding With Harley-Davidson. Bikers Love Him Anyway.',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.253',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Trump Has No Fear: ‘Makes Nixon Look Like a Cream Puff’',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.255',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'How Soon Will the NYT’s Trump Resistance Writer Be Outed?',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.257',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'American Institutions Are Holding Up—But Are Americans?',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.261',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Why Conservatives Should Beware a Roe v. Wade Repeal',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.259',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'It Would Take Exactly One Senator to Get Trump’s Taxes',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.262',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'Trump on Weisselberg: ‘He Did Whatever Was Necessary’',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.263',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'What Is Trump Getting for Sucking Up to Saudi Arabia?',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.258',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'I Read Every Bob Woodward Book. Here’s How They Stack Up.',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.186',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Trump May Not Be Crazy, But the Rest of Us Are Getting There Fast',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.173',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => '‘He’s Unraveling’: Why Cohen’s Betrayal Terrifies Trump',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.266',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'A referendum on Macedonia’s new name fails to settle anything',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.131',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'The American dream doesn’t exist in many neighbourhoods',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.122',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'Britain’s Supreme Court rules in favour of two Christian bakers',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.124',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Jodie Whittaker makes a charismatic start as the new Doctor Who',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.126',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'A right-wing populist is poised to become Brazil’s next president',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.127',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Are liberals and populists just searching for a new master?',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.2%%',
						),
						'the_id'            => 'posts.primary.128',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'An endangered frog takes centre stage at the Supreme Court',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.20%%',
						),
						'the_id'            => 'posts.primary.135',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Anglophones and Francophones still approach Islam differently',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.20%%',
						),
						'the_id'            => 'posts.primary.134',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'The FBI will investigate accusations against Brett Kavanaugh',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.20%%',
						),
						'the_id'            => 'posts.primary.133',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'An ancient virus may promote addiction in modern people',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.20%%',
						),
						'the_id'            => 'posts.primary.129',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'Kate Atkinson’s WWII Spy Drama Is Fall’s Must Read Novel',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.154',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'The CW’s Charmed Reboot Is So Political, It Forgot to Be Fun',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.147',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Trump’s Health Care Op-Ed Really Made Jimmy Kimmel Mad',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.150',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Review: Tom Hardy Is One Good Reason to See Venom',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.152',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Chrissy Teigen Discusses Inferior Foods Over Spicy Wings',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.160',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Night School Graduates to the Top of the Weekend Box Office',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.159',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Bradley Cooper Was Afraid to Direct. Then He Found Lady Gaga',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.158',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Elijah Wood Casually Rides Atop Scooter Into Meme Status',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.157',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Bill Cosby to Fight ‘Sexually Violent Predator’ Tag at Sentencing',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.156',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'The 10 Most Magical Books to Read If You Love Harry Potter',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.155',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'Is This the Stupidest Book Ever Written About Socialism?',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.265',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Trust Me, Mr. President, White South Africans Are Doing Just Fine',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.264',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'Video 1:33 Priest learns to sign to make sermons inclusive',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.20%%',
						),
						'the_id'            => 'posts.primary.306',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'Japanese spacecraft drops a third rover on asteroid Ryugu',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.10%%',
						),
						'the_id'            => 'posts.primary.211',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'How many comments did YouTube wipe in three months?',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.21%%',
						),
						'the_id'            => 'posts.primary.319',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'The bird voice box is one of a kind in the animal kingdom',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.10%%',
						),
						'the_id'            => 'posts.primary.205',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Conor McGregor Charged With Assault After UFC Bus Attack\\',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.238',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'The Carolina Panthers Aren’t Heroes for Signing Eric Reid',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.224',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Basketball Game Devolves Into a Massive On-Court Brawl',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.237',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'Serena Williams Is One Step Closer to More Sporting Immortality',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.232',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => '‘Humongous fungus’ is almost as big as the Mall of America',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.10%%',
						),
						'the_id'            => 'posts.primary.201',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'Like humans, octopuses want more hugs when high on ecstasy',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.10%%',
						),
						'the_id'            => 'posts.primary.212',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => '‘Revolution based on evolution’ honored with chemistry Nobel',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.10%%',
						),
						'the_id'            => 'posts.primary.210',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'Healing from Hate: How the KKK Took My Health Away',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.23%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'www.cnn.com',
							),
						),
						'the_id'            => 'posts.primary.365',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Russia Fixation Fades with Report Trump Dodged Taxes',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.177',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'The Times Would Have Been Crazy Not to Publish That Op-Ed',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.181',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'Michael Avenatti Is Winning the 2020 Democratic Primary',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.182',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'How the U.S. Senate Became a Campus Kangaroo Court',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.178',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'What You Need to Know About World Cup Player Jimmy Durmaz',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.236',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'These workplace issues significantly up your odds of divorce',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.10%%',
						),
						'the_id'            => 'posts.primary.207',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'Don’t Let NCAA Hypocrisy Ruin This Amazing March Madness',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.239',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'TV Is More Vital Than Ever. Too Bad No One Told the Emmys',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.161',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Trump’s EPA scraps air pollution science review panels',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.10%%',
						),
						'the_id'            => 'posts.primary.199',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'How to Flood the Trump Administration With Investigations',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.11%%',
						),
						'the_id'            => 'posts.primary.260',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'Samin Nosrat Is Taking the Home Cook Around the World',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.5%%',
						),
						'the_id'            => 'posts.primary.153',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'Women fare well in this year’s round of NIH high-risk awards',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.10%%',
						),
						'the_id'            => 'posts.primary.204',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'Black Women are Bearing the Brunt of the Student Debt',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.22%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'www.cnn.com',
							),
						),
						'the_id'            => 'posts.primary.356',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => '\'Intimacy plus\': Is that what makes podcasts so popular?',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.21%%',
						),
						'the_id'            => 'posts.primary.320',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => '“Capernaum” Tells a Universal Story—But it’s Hard to Watch',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.21%%',
						),
						'the_id'            => 'posts.primary.333',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Birth Justice: Where #MeToo and Medical Sexism Intersect',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.21%%',
						),
						'the_id'            => 'posts.primary.334',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'How Girl Power is Fueling an Evolution in Women’s',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.21%%',
						),
						'the_id'            => 'posts.primary.335',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'The Deadly Stress of Being a Black Woman in America',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.21%%',
						),
						'the_id'            => 'posts.primary.336',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'How Long Must Incarcerated Women Wait for Dignity?',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.22%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'www.cnn.com',
							),
						),
						'the_id'            => 'posts.primary.349',
						'thumbnail_id'      => '%%media.primary.thumb-6%%',
					),
					array(
						'post_title'        => 'How Iceland Became the World Cup’s Ultimate Underdog',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.234',
						'thumbnail_id'      => '%%media.primary.thumb-5%%',
					),
					array(
						'post_title'        => 'Ms. Muse: What Happens When You Give a Girl a Pen',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.22%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'www.cnn.com',
							),
						),
						'the_id'            => 'posts.primary.355',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Sisterhood, Herstory and Talking Circles: Inside Gloria’s Life',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.22%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'www.cnn.com',
							),
						),
						'the_id'            => 'posts.primary.351',
						'thumbnail_id'      => '%%media.primary.thumb-3%%',
					),
					array(
						'post_title'        => 'Inside NARAL’s Three-Step Plan to Protect Abortion Access',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.22%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'www.cnn.com',
							),
						),
						'the_id'            => 'posts.primary.357',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'The Nobel chemistry prize goes for work that harnesses evolution',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.20%%',
						),
						'the_id'            => 'posts.primary.130',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'The World America Made—and Trump Wants to Unmake',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.8%%',
						),
						'the_id'            => 'posts.primary.180',
						'thumbnail_id'      => '%%media.primary.thumb-1%%',
					),
					array(
						'post_title'        => 'When Will Lawmakers Stop Surveilling Women’s Bodies?',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.23%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'www.cnn.com',
							),
						),
						'the_id'            => 'posts.primary.363',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Hate Crimes are Increasing—Likely More Than We Realize',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.22%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'www.cnn.com',
							),
						),
						'the_id'            => 'posts.primary.353',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'The ‘Neymar Challenge’ Is Spreading Laughter Across the World',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.9%%',
						),
						'the_id'            => 'posts.primary.231',
						'thumbnail_id'      => '%%media.primary.thumb-2%%',
					),
					array(
						'post_title'        => 'Eleanor Roosevelt’s Election Day Advice for Women',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.23%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'www.cnn.com',
							),
						),
						'the_id'            => 'posts.primary.374',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'The Transnational Feminist Fight to Reform Healthcare',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.23%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'www.cnn.com',
							),
						),
						'the_id'            => 'posts.primary.369',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_title'        => 'Closing the Political Gender Gap Starts in the Classroom',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.23%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'www.cnn.com',
							),
						),
						'the_id'            => 'posts.primary.368',
						'thumbnail_id'      => '%%media.primary.thumb-7%%',
					),
					array(
						'post_title'        => 'The Podcast Telling the Stories of “Cool Dead Women”',
						'post_content_file' => $demo_path . 'post-content.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_terms'        => array(
							'category' => '%%taxonomy.primary.23%%',
						),
						'post_meta'         => array(
							array(
								'meta_key'   => '_bs_source_name',
								'meta_value' => 'www.cnn.com',
							),
						),
						'the_id'            => 'posts.primary.367',
						'thumbnail_id'      => '%%media.primary.thumb-4%%',
					),
					array(
						'post_type'         => 'page',
						'post_title'        => 'Contact',
						'post_content_file' => $demo_path . 'post-content-1.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'post_meta'         => array(
							array(
								'meta_key'   => 'page_layout',
								'meta_value' => '1-col',
							),
						),
						'the_id'            => 'posts.primary.87',
					),
					array(
						'post_type'         => 'page',
						'post_title'        => 'Front Page',
						'post_content_file' => $demo_path . 'post-content-2.txt',
						'post_excerpt'      => 'Other ultra-long-haul international flights connecting in the United States include a Delta one from Atlanta to Johannesburg, South Africa ...',
						'prepare_vc_css'    => true,
						'post_meta'         => array(
							array(
								'meta_key'   => 'page_layout',
								'meta_value' => '1-col',
							),
						),
						'the_id'            => 'posts.primary.86',
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
								'meta_key'   => 'img',
								'meta_value' => '%%bf_product_demo_media_url:{media.primary.banner-inline}:\'full\'%%',
							),
							array(
								'meta_key'   => 'url',
								'meta_value' => 'https://betterstudio.com/publisher-wp-theme/',
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
						'the_id'     => 'posts.primary.289',
					),
					array(
						'post_type'  => 'better-banner',
						'post_title' => 'Index Sidebar Banner',
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
								'meta_value' => 'https://betterstudio.com/publisher-wp-theme/',
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
						'the_id'     => 'posts.primary.66',
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
								'meta_value' => 'https://betterstudio.com/publisher-wp-theme/',
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
						'the_id'     => 'posts.primary.62',
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
								'meta_value' => 'style-5',
							),
							array(
								'meta_key'   => 'color',
								'meta_value' => '#da1414',
							),
						),
						'the_id'     => 'posts.primary.290',
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
						'option_value' => '%%posts.primary.86%%',
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
									'banner'    => '288',
									'count'     => '3',
									'columns'   => '3',
									'orderby'   => 'rand',
									'order'     => 'ASC',
									'align'     => 'right',
									'paragraph' => '6',
								),
							),
							'header_aside_logo_type'   => 'banner',
							'header_aside_logo_banner' => '%%posts.primary.62%%',
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
								'banner'               => '%%posts.primary.66%%',
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
								'title'                 => 'Latest Stories',
								'count'                 => '8',
								'order_by'              => 'popular',
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
								'bf-widget-title-icon'  => array(
									'icon'      => '',
									'type'      => '',
									'height'    => '',
									'width'     => '',
									'font_code' => '',
								),
								'paginate'              => 'more_btn',
							),
						),
						array(
							'widget_id'       => 'better-social-counter',
							'widget_settings' => array(
								'title'                => 'Follow Us',
								'order'                => array(
									'facebook'  => '1',
									'twitter'   => '1',
									'dribbble'  => '1',
									'youtube'   => '1',
									'vimeo'     => '1',
									'pinterest' => '1',
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
								'columns'              => '4',
							),
						),
					),
					'footer-1'        => array(
						'remove_all_widgets' => true,
						array(
							'widget_id'       => 'bs-about',
							'widget_settings' => array(
								'content'               => 'Publisher is the useful and powerful WordPress Newspaper Magazine and Blog theme with great attention to details, incredible features, an intuitive user interface and everything else you need to create outstanding websites.
         
         • Email: info@yoursite.com
         • Phone: 844-698-6394',
								'logo_img'              => '%%bf_product_demo_media_url:{media.primary.footer-logo}:\'full\'%%',
								'link_facebook'         => '#',
								'link_twitter'          => '#',
								'link_google'           => '#',
								'link_instagram'        => '#',
								'link_email'            => '#',
								'link_youtube'          => '#',
								'title'                 => '',
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
					'footer-2'        => array(
						'remove_all_widgets' => true,
						array(
							'widget_id'       => 'bs-thumbnail-listing-1',
							'widget_settings' => array(
								'title'                 => 'Editors\' Picks',
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
										'show'        => '0',
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
							'widget_id'       => 'bs-thumbnail-listing-1',
							'widget_settings' => array(
								'title'                 => 'Popular Posts',
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
										'show'        => '0',
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
					'footer-4'        => array(
						'remove_all_widgets' => true,
						array(
							'widget_id'       => 'nav_menu',
							'widget_settings' => array(
								'title'                 => 'Links',
								'nav_menu'              => '%%menus.footer.1%%',
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
					'file'   => $demo_image_url . $prefix . 'Footer-Logo.png',
					'the_id' => 'media.primary.footer-logo',
				),
				array(
					'file'   => $demo_image_url . $prefix . '300x250-post-single.jpg',
					'the_id' => 'media.primary.banner-paragraph',
				),
				array(
					'file'   => $demo_image_url . $prefix . '336x280-sidebar.jpg',
					'the_id' => 'media.primary.banner-sidebar',
				),
				array(
					'file'   => $demo_image_url . $prefix . '728x90-header.jpg',
					'the_id' => 'media.primary.banner-header',
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
								'page_id'   => '%%posts.primary.86%%',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.8%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.11%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.10%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.2%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.5%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.9%%',
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
								'term_id'   => '%%taxonomy.primary.23%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'page',
								'title'     => 'Contact',
								'page_id'   => '%%posts.primary.87%%',
							),
						),
					),
					array(
						'menu-location' => 'footer-menu',
						'menu-name'     => 'Footer Navigation',
						'the_id'        => 'menus.footer.1',
						'items'         => array(
							array(
								'item_type' => 'page',
								'title'     => 'Home',
								'page_id'   => '%%posts.primary.86%%',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.8%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.11%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.2%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.10%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.5%%',
								'taxonomy'  => 'category',
							),
							array(
								'item_type' => 'term',
								'term_id'   => '%%taxonomy.primary.9%%',
								'taxonomy'  => 'category',
							),
						),
					),
				),
			),
	);
}
