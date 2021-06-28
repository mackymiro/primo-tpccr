/**
 * Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

/* exported initSample */

if ( CKEDITOR.env.ie && CKEDITOR.env.version < 9 )
	CKEDITOR.tools.enableHtml5Elements( document );

// The trick to keep the editor in the sample quite small
// unless user specified own height.
CKEDITOR.config.allowedContent=true;
CKEDITOR.config.disableAutoInline = true;
CKEDITOR.config.height = 150;
CKEDITOR.config.width = 'auto';

var initSample = ( function() {
	var wysiwygareaAvailable = isWysiwygareaAvailable(),
		isBBCodeBuiltIn = !!CKEDITOR.plugins.get( 'bbcode' );

	return function() {
		var editorElement = CKEDITOR.document.getById( 'editor' );

		// :(((
		if ( isBBCodeBuiltIn ) {
			editorElement.setHtml(
				'Hello world!\n\n' +
				'I\'m an instance of [url=https://ckeditor.com]CKEditor[/url].'
			);
		}

		// Depending on the wysiwygarea plugin availability initialize classic or inline editor.
		if ( wysiwygareaAvailable ) {
			
 var ckeditor=  CKEDITOR.replace( 'editor1', {
							extraPlugins: 'stylesheetparser',
							height: 450,

							// Custom stylesheet for editor content.
							contentsCss: [ 'bower_components/ckeditor/stylesheetparser.css' ],

							// Do not load the default Styles configuration.
							stylesSet: [],
							on: {
							key: function( event ) {
								// Gather all styles
								var styles = [];
								this.getStylesSet( function( defs ) { styles = defs } );
								
								// CTRL+SHIFT+1

								if ( event.data.keyCode ==CKEDITOR.CTRL+CKEDITOR.SHIFT+"1") {                
									alert ("test");
								}
								
							}
						}
							
						} );

 	 


		} 
		else{
			editorElement.setAttribute( 'contenteditable', 'true' );
			CKEDITOR.inline( 'editor1' );

			// TODO we can consider displaying some info box that
			// without wysiwygarea the classic editor may not work.
		}


	};


	function isWysiwygareaAvailable() {
		// If in development mode, then the wysiwygarea must be available.
		// Split REV into two strings so builder does not replace it :D.
		if ( CKEDITOR.revision == ( '%RE' + 'V%' ) ) {
			return true;
		}

		return !!CKEDITOR.plugins.get( 'wysiwygarea' );
	}
} )();

