<?php

	class GoogleTagManager extends Plugin {

		public function action_init_theme_any ( $theme ) {

			$code = $this->snippet();

			if ( $code ) {
				Stack::add('template_footer_javascript', $code, 'googletagmanager');
			}

		}

		private function snippet ( ) {

			$container_id = Options::get( 'googletagmanager__container_id' );

			if ( empty( $container_id ) ) {
				return null;
			}

			$snippet = <<<SNIPPET
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=%s" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','%s');</script>
<!-- End Google Tag Manager -->
SNIPPET;

			$snippet = sprintf( $snippet, $container_id, $container_id );

			return $snippet;

		}

		public function configure ( ) {
			$form = new FormUI( strtolower( get_class( $this ) ) );
			$form->append( 'text', 'container_id', 'googletagmanager__container_id', _t( 'Public Container ID' ) );
			$form->append( 'submit', 'save', 'Save' );
			return $form;
		}

	}

?>