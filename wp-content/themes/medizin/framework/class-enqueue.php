<?php
defined( 'ABSPATH' ) || exit;

/**
 * Enqueue scripts and styles.
 */
if ( ! class_exists( 'Medizin_Enqueue' ) ) {
	class Medizin_Enqueue {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {
			// Set priority 4 to make it run before elementor register scripts.
			add_action( 'wp_enqueue_scripts', array( $this, 'register_swiper' ), 4 );

			add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );

			// Disable woocommerce all styles.
			add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

			// Disable all contact form 7 scripts.
			add_filter( 'wpcf7_load_js', '__return_false' );
			add_filter( 'wpcf7_load_css', '__return_false' );
		}

		/**
		 * Register swiper lib.
		 * Use on wp_enqueue_scripts action.
		 */
		public function register_swiper() {
			wp_register_style( 'swiper', MEDIZIN_THEME_URI . '/assets/libs/swiper/css/swiper.min.css', null, '5.2.1' );
			wp_register_script( 'swiper', MEDIZIN_THEME_URI . '/assets/libs/swiper/js/swiper.min.js', array(
				'jquery',
				'imagesloaded',
			), '5.2.1', true );

			wp_register_script( 'medizin-swiper-wrapper', MEDIZIN_THEME_URI . '/assets/js/swiper-wrapper.js', array( 'swiper' ), MEDIZIN_THEME_VERSION, true );

			$medizin_swiper_js = array(
				'prevText' => esc_html__( 'Prev', 'medizin' ),
				'nextText' => esc_html__( 'Next', 'medizin' ),
			);
			wp_localize_script( 'medizin-swiper-wrapper', '$medizinSwiper', $medizin_swiper_js );
		}

		/**
		 * Enqueue scripts & styles for frond-end.
		 *
		 * @access public
		 */
		public function frontend_scripts() {
			$post_type = get_post_type();

			// Remove prettyPhoto, default light box of woocommerce.
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

			// Remove font awesome from Yith Wishlist plugin.
			wp_dequeue_style( 'yith-wcwl-font-awesome' );

			// Remove hint from Woo Smart Compare plugin.
			wp_dequeue_style( 'hint' );

			// Remove feather font from Woo Smart Wishlist plugin.
			wp_dequeue_style( 'woosw-feather' );

			/*
			 * Begin register scripts & styles to be enqueued later.
			 */
			wp_register_style( 'medizin-style-rtl', MEDIZIN_THEME_URI . '/style-rtl.css', null, MEDIZIN_THEME_VERSION );
			wp_register_style( 'medizin-woocommerce', MEDIZIN_THEME_URI . '/woocommerce.css', null, MEDIZIN_THEME_VERSION );

			wp_register_style( 'font-awesome-pro', MEDIZIN_THEME_URI . '/assets/fonts/awesome/css/fontawesome-all.min.css', null, '5.10.0' );
			wp_register_style( 'font-medizin', MEDIZIN_THEME_URI . '/assets/fonts/medizin/font-medizin.min.css', null, null );

			wp_register_style( 'justifiedGallery', MEDIZIN_THEME_URI . '/assets/libs/justifiedGallery/css/justifiedGallery.min.css', null, '3.7.0' );
			wp_register_script( 'justifiedGallery', MEDIZIN_THEME_URI . '/assets/libs/justifiedGallery/js/jquery.justifiedGallery.min.js', array( 'jquery' ), '3.7.0', true );

			wp_register_style( 'lightgallery', MEDIZIN_THEME_URI . '/assets/libs/lightGallery/css/lightgallery.min.css', null, '1.6.12' );
			wp_register_script( 'lightgallery', MEDIZIN_THEME_URI . '/assets/libs/lightGallery/js/lightgallery-all.min.js', array(
				'jquery',
			), '1.6.12', true );

			wp_register_style( 'magnific-popup', MEDIZIN_THEME_URI . '/assets/libs/magnific-popup/magnific-popup.css' );
			wp_register_script( 'magnific-popup', MEDIZIN_THEME_URI . '/assets/libs/magnific-popup/jquery.magnific-popup.js', array( 'jquery' ), MEDIZIN_THEME_VERSION, true );

			wp_register_style( 'growl', MEDIZIN_THEME_URI . '/assets/libs/growl/css/jquery.growl.min.css', null, '1.3.3' );
			wp_register_script( 'growl', MEDIZIN_THEME_URI . '/assets/libs/growl/js/jquery.growl.min.js', array( 'jquery' ), '1.3.3', true );

			wp_register_script( 'matchheight', MEDIZIN_THEME_URI . '/assets/libs/matchHeight/jquery.matchHeight-min.js', array( 'jquery' ), MEDIZIN_THEME_VERSION, true );

			/**
			 * Fix Elementor load out-date version 1.0.1
			 */
			wp_deregister_script( 'smartmenus' );
			wp_register_script( 'smartmenus', MEDIZIN_THEME_URI . '/assets/libs/smartmenus/jquery.smartmenus.min.js', array( 'jquery' ), '1.1.1', true );

			wp_register_script( 'smooth-scroll', MEDIZIN_THEME_URI . '/assets/libs/smooth-scroll-for-web/SmoothScroll.min.js', array(
				'jquery',
			), '1.4.9', true );

			// Fix Wordpress old version not registered this script.
			if ( ! wp_script_is( 'imagesloaded', 'registered' ) ) {
				wp_register_script( 'imagesloaded', MEDIZIN_THEME_URI . '/assets/libs/imagesloaded/imagesloaded.min.js', array( 'jquery' ), null, true );
			}

			$this->register_swiper();

			wp_register_script( 'sticky-kit', MEDIZIN_THEME_URI . '/assets/js/jquery.sticky-kit.min.js', array(
				'jquery',
			), MEDIZIN_THEME_VERSION, true );

			wp_register_script( 'picturefill', MEDIZIN_THEME_URI . '/assets/libs/picturefill/picturefill.min.js', array( 'jquery' ), null, true );

			wp_register_script( 'mousewheel', MEDIZIN_THEME_URI . '/assets/libs/mousewheel/jquery.mousewheel.min.js', array( 'jquery' ), MEDIZIN_THEME_VERSION, true );

			$google_api_key = Medizin::setting( 'google_api_key' );
			wp_register_script( 'medizin-gmap3', MEDIZIN_THEME_URI . '/assets/libs/gmap3/gmap3.min.js', array( 'jquery' ), MEDIZIN_THEME_VERSION, true );
			wp_register_script( 'medizin-maps', MEDIZIN_PROTOCOL . '://maps.google.com/maps/api/js?key=' . $google_api_key . '&amp;language=en' );

			wp_register_script( 'isotope-masonry', MEDIZIN_THEME_URI . '/assets/libs/isotope/js/isotope.pkgd.js', array( 'jquery' ), MEDIZIN_THEME_VERSION, true );
			wp_register_script( 'isotope-packery', MEDIZIN_THEME_URI . '/assets/libs/packery-mode/packery-mode.pkgd.js', array( 'jquery' ), MEDIZIN_THEME_VERSION, true );

			wp_register_script( 'medizin-grid-layout', MEDIZIN_THEME_ASSETS_URI . '/js/grid-layout.js', array(
				'jquery',
				'imagesloaded',
				'matchheight',
				'isotope-masonry',
				'isotope-packery',
			), null, true );

			wp_register_script( 'medizin-quantity-button', MEDIZIN_THEME_URI . '/assets/js/woo/quantity-button.js', [ 'jquery' ], MEDIZIN_THEME_VERSION, true );
			wp_register_script( 'medizin-woo-general', MEDIZIN_THEME_URI . '/assets/js/woo/general.js', [ 'jquery' ], MEDIZIN_THEME_VERSION, true );
			wp_register_script( 'medizin-woo-checkout', MEDIZIN_THEME_URI . '/assets/js/woo/checkout.js', [ 'jquery' ], MEDIZIN_THEME_VERSION, true );
			wp_register_script( 'medizin-woo-single', MEDIZIN_THEME_URI . '/assets/js/woo/single.js', [ 'jquery' ], MEDIZIN_THEME_VERSION, true );

			wp_register_script( 'medizin-tab-panel', MEDIZIN_THEME_URI . '/assets/js/tab-panel.js', [ 'jquery' ], MEDIZIN_THEME_VERSION, true );

			/*
			 * End register scripts
			 */

			wp_enqueue_style( 'font-awesome-pro' );
			wp_enqueue_style( 'font-medizin' );
			wp_enqueue_style( 'swiper' );
			wp_enqueue_style( 'lightgallery' );

			/*
			 * Enqueue the theme's style.css.
			 * This is recommended because we can add inline styles there
			 * and some plugins use it to do exactly that.
			 */
			wp_enqueue_style( 'medizin-style', get_template_directory_uri() . '/style.css' );

			if ( is_rtl() ) {
				wp_enqueue_style( 'medizin-style-rtl' );
			}

			if ( Medizin_Woo::instance()->is_activated() ) {
				wp_enqueue_style( 'medizin-woocommerce' );
			}

			if ( Medizin::setting( 'header_sticky_enable' ) ) {
				wp_enqueue_script( 'headroom', MEDIZIN_THEME_URI . '/assets/js/headroom.min.js', array( 'jquery' ), MEDIZIN_THEME_VERSION, true );
			}

			if ( Medizin::setting( 'smooth_scroll_enable' ) ) {
				wp_enqueue_script( 'smooth-scroll' );
			}

			wp_enqueue_script( 'lightgallery' );

			// Use waypoints lib edited by Elementor to avoid duplicate the script.
			if ( ! wp_script_is( 'elementor-waypoints', 'registered' ) ) {
				wp_register_script( 'elementor-waypoints', MEDIZIN_THEME_URI . '/assets/libs/elementor-waypoints/jquery.waypoints.min.js', array( 'jquery' ), null, true );
			}

			wp_enqueue_script( 'elementor-waypoints' );

			wp_enqueue_script( 'jquery-smooth-scroll', MEDIZIN_THEME_URI . '/assets/libs/smooth-scroll/jquery.smooth-scroll.min.js', array( 'jquery' ), MEDIZIN_THEME_VERSION, true );

			wp_enqueue_script( 'medizin-swiper-wrapper' );

			wp_enqueue_script( 'medizin-grid-layout' );
			wp_enqueue_script( 'smartmenus' );

			wp_enqueue_style( 'perfect-scrollbar', MEDIZIN_THEME_URI . '/assets/libs/perfect-scrollbar/css/perfect-scrollbar.min.css' );
			wp_enqueue_style( 'perfect-scrollbar-woosw', MEDIZIN_THEME_URI . '/assets/libs/perfect-scrollbar/css/custom-theme.min.css' );
			wp_enqueue_script( 'perfect-scrollbar', MEDIZIN_THEME_URI . '/assets/libs/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js', array( 'jquery' ), MEDIZIN_THEME_VERSION, true );

			if ( Medizin::setting( 'notice_cookie_enable' ) === '1' && ! isset( $_COOKIE['notice_cookie_confirm'] ) ) {
				wp_enqueue_script( 'growl' );
				wp_enqueue_style( 'growl' );
			}

			wp_register_script( 'laziestloader', MEDIZIN_THEME_URI . '/assets/libs/laziestloader/jquery.laziestloader.min.js', array( 'jquery' ), '0.7.2', true );

			if ( Medizin::setting( 'retina_display_enable' ) ) {
				wp_enqueue_script( 'laziestloader' );
			}

			if ( Medizin_Woo::instance()->is_activated() && Medizin::setting( 'shop_archive_quick_view' ) === '1' ) {
				wp_enqueue_style( 'magnific-popup' );
				wp_enqueue_script( 'magnific-popup' );
			}

			$is_product = false;

			//  Enqueue styles & scripts for single pages.
			if ( is_singular() ) {

				switch ( $post_type ) {
					case 'portfolio':
						$_sticky = Medizin::setting( 'single_portfolio_sticky_detail_enable' );


						if ( $_sticky == '1' ) {
							wp_enqueue_script( 'sticky-kit' );
						}

						wp_enqueue_style( 'lightgallery' );
						wp_enqueue_script( 'lightgallery' );

						break;

					case 'product':
						$is_product = true;

						$single_product_sticky = Medizin::setting( 'single_product_sticky_enable' );
						if ( $single_product_sticky == '1' ) {
							wp_enqueue_script( 'sticky-kit' );
						}

						wp_enqueue_style( 'lightgallery' );
						wp_enqueue_script( 'lightgallery' );

						break;
				}
			}

			/*
			 * The comment-reply script.
			 */
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				switch ( $post_type ) {
					case 'post':
						if ( Medizin::setting( 'single_post_comment_enable' ) === '1' ) {
							wp_enqueue_script( 'comment-reply' );
						}
						break;
					case 'portfolio':
						if ( Medizin::setting( 'single_portfolio_comment_enable' ) === '1' ) {
							wp_enqueue_script( 'comment-reply' );
						}
						break;
					default:
						wp_enqueue_script( 'comment-reply' );
						break;
				}
			}

			wp_enqueue_script( 'medizin-nice-select', MEDIZIN_THEME_URI . '/assets/js/nice-select.js', array(
				'jquery',
			), MEDIZIN_THEME_VERSION, true );

			/*
			 * Enqueue main JS
			 */
			wp_enqueue_script( 'medizin-script', MEDIZIN_THEME_URI . '/assets/js/main.js', array(
				'jquery',
			), MEDIZIN_THEME_VERSION, true );

			if ( Medizin_Woo::instance()->is_activated() ) {
				wp_enqueue_script( 'medizin-woo-general' );

				if ( is_cart() || is_product() ) {
					wp_enqueue_script( 'medizin-quantity-button' );
				}

				if ( is_checkout() ) {
					wp_enqueue_script( 'medizin-woo-checkout' );
				}

				if ( is_product() ) {
					wp_enqueue_script( 'medizin-woo-single' );
				}
			}

			/*
			 * Enqueue custom variable JS
			 */

			$js_variables = array(
				'ajaxurl'                   => admin_url( 'admin-ajax.php' ),
				'header_sticky_enable'      => Medizin::setting( 'header_sticky_enable' ),
				'header_sticky_height'      => Medizin::setting( 'header_sticky_height' ),
				'scroll_top_enable'         => Medizin::setting( 'scroll_top_enable' ),
				'light_gallery_auto_play'   => Medizin::setting( 'light_gallery_auto_play' ),
				'light_gallery_download'    => Medizin::setting( 'light_gallery_download' ),
				'light_gallery_full_screen' => Medizin::setting( 'light_gallery_full_screen' ),
				'light_gallery_zoom'        => Medizin::setting( 'light_gallery_zoom' ),
				'light_gallery_thumbnail'   => Medizin::setting( 'light_gallery_thumbnail' ),
				'light_gallery_share'       => Medizin::setting( 'light_gallery_share' ),
				'mobile_menu_breakpoint'    => Medizin::setting( 'mobile_menu_breakpoint' ),
				'isProduct'                 => $is_product,
				'productFeatureStyle'       => Medizin_Woo::instance()->get_single_product_style(),
				'noticeCookieEnable'        => Medizin::setting( 'notice_cookie_enable' ),
				'noticeCookieConfirm'       => isset( $_COOKIE['notice_cookie_confirm'] ) ? 'yes' : 'no',
				'noticeCookieMessages'      => Medizin_Notices::instance()->get_notice_cookie_messages(),
			);
			wp_localize_script( 'medizin-script', '$medizin', $js_variables );

			/**
			 * Custom JS
			 */
			if ( Medizin::setting( 'custom_js_enable' ) == 1 ) {
				wp_add_inline_script( 'medizin-script', html_entity_decode( Medizin::setting( 'custom_js' ) ) );
			}
		}
	}

	Medizin_Enqueue::instance()->initialize();
}
