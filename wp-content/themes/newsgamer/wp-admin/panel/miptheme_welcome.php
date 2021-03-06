<div class="miptheme_admin wrap about-wrap">
	<h1>Welcome to <?php echo MIPTHEMEFRAMEWORK_THEMEPANEL; ?> <span style="font-size: 18px; color: #999;">v<?php echo MIPTHEMEFRAMEWORK_THEMEVERSION; ?></span></h1>

    <div class="about-text">Thank you for using our theme. We did our best to release a great theme and we will do our best to support it and fix all the issues that may arise.</div>
	<div class="wp-badge">Version <?php echo MIPTHEMEFRAMEWORK_THEMEVERSION; ?></div>

	<h2 class="nav-tab-wrapper">
		<a href="?page=miptheme_welcome" class="nav-tab nav-tab-active">Welcome</a>
		<?php if ( class_exists( 'ReduxFramework' ) ) { ?>
        <a href="?page=ThemeOptions" class="nav-tab">Theme Options</a>
		<a href="?page=ThemeTypography" class="nav-tab">Theme Typography</a>
		<?php } ?>
	</h2>

	<div class="feature-section two-col">
		<div class="col">
			<img src="<?php echo get_template_directory_uri() . '/screenshot.png'; ?>" alt="" />
		</div>
		<div class="col">
			<h3>Important!</h3>
			<p>You need to install two additional plugins for this theme to work properly:</p>
			<ol>
				<li>
					<strong>Redux Framework</strong><br> Necessary for using Theme Options Panel<br><br>
				</li>
				<li>
					<strong>Newsgamer Custom Add-ons</strong><br> A bunch of usefull stuff for this theme, like Visual Composer custom blocks, shortcodes etc.
				</li>
			</ol>
			<br>
			<a class="button button-primary" href="?page=tgmpa-install-plugins&plugin_status=install">Install plugins</a>
		</div>
	</div>

    <div class="feature-section three-col">
        <div class="col">
            <h3>Support</h3>
            <p>We offer outstanding support through our <a href="https://mip.ticksy.com/">support system</a>. To get support you just need to register (create an account) and open a ticket. We'll get back to you as soon as possible.</p>
            <a class="button button-primary" href="https://mip.ticksy.com/" target="_blank">Go to Support</a>
        </div>
        <div class="col">
            <h3>Documentation</h3>
            <p>We suggest you read our full documentation to discover this theme's true potential and use it properly on your site.</p>
            <a class="button button-primary" href="http://docs.newsthemes.info/newsgamer/" target="_blank">Open Documentation</a>
        </div>
        <div class="col">
            <h3>Video Tutorials</h3>
            <p>We also created a couple of "How to..." video tutorials to help you in process of adjusting to the theme.</p>
            <a class="button button-primary" href="https://www.youtube.com/channel/UC1I2TdrSXLyPiSDFRcyFrQA" target="_blank">View Tutorials</a>
        </div>
    </div>

</div>
