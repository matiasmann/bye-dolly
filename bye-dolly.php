<?php
/**
 * Plugin Name:       Bye Dolly
 * Plugin URI:        https://github.com/matiasmann/bye-dolly
 * Description: This is not just a plugin, it symbolizes the NOT hope and NOT enthusiasm of an entire generation summed up in one word: <strong>Global Pandemic</strong>. When activated you will randomly see a quote from <cite>Rick and Morty</cite> in the upper right of your admin screen on every page. Think for yourself. The world needs you more than ever.
 * Version:           1.0.1
 * Requires at least: 4.6
 * Author:            Matias Mann
 * Author URI:        https://github.com/matiasmann
 * License:           Unlicensed
 * Text Domain:       bye-dolly
 * Based on Hello Dolly by Matt Mullenweg
*/

function bye_dolly_get_lyric() {
	/** These are quotes */
	$lyrics = "I’m sorry, but your opinion means very little to me.
    I don’t like it here Morty. I can’t abide bureaucracy. 
    I don’t like being told where to go and what to do. I consider it a violation.
    Excuse me. Coming through. What are you here for? Just kidding, I don’t care.
    Nobody exists on purpose. Nobody belongs anywhere. 
    We’re all going to die. 
    Come watch TV.
    Stay scientific, Jerry.
    My life has been a lie… God is dead. 
    The government’s lame! Thanksgiving is about killing Indians!
    You know, we did something great today. 
    There’s nothing more noble and free than the heart of a horse.
    Life is effort and I’ll stop when I die.
    I’ll tell you how I feel about school, Jerry: it’s a waste of time, 
    Bunch of people runnin’ around bumpin’ into each other, got a guy up front says, ‘2 + 2,’ and the people in the back say, ‘4.’ Then the bell rings and they give you a carton of milk and a piece of paper that says you can go take a dump or somethin’. I mean, it’s not a place for smart people, Jerry. 
    I know that’s not a popular opinion, but that’s my two cents on the issue.
    Is evil real, and if so, can it be measured? 
    Rhetorical question. The answer’s yes, you just have to be a genius.
    Existence is pain and we will do anything to alleviate that pain.
    Dad, am I evil? Worse. You’re smart.
    Listen, Morty, I hate to break it to you but what people call ‘love’ is just a chemical reaction that compels animals to breed. It hits hard, Morty, then it slowly fades, leaving you stranded in a failing marriage. I did it. Your parents are gonna do it. 
    Break the cycle, Morty. Rise above. Focus on science. 
    What about the reality where Hitler cured cancer, Morty? 
    The answer is: Don’t think about it.lish overkill, Summer!
    Think for yourselves. Don’t be sheep.";

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function bye_dolly() {
	$chosen = bye_dolly_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="dolly"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( 'Quotes from Rick and Morty, by the one:', 'bye-dolly' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'bye_dolly' );

// We need some CSS to position the paragraph.
function bye_dolly_css() {
	echo "
	<style type='text/css'>
	#dolly {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #dolly {
		float: left;
	}
	.block-editor-page #dolly {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#dolly,
		.rtl #dolly {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'bye_dolly_css' );