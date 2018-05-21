( function ( $ ) {

	acf.fields.niche_markdown = acf.field.extend( {

		type: 'niche_markdown',
		$textarea: null,
		inscrybmde: {},

		actions: {
			'load': 'initialize',
			'append': 'initialize',
		},

		focus: function () {

			this.$textarea = this.$field.find( '.acf-input textarea' );

			this.o = acf.get_data( this.$textarea, {
				id: this.$textarea.attr( 'id' ),
			} );

		},

		initialize: function () {

			var args = {
				element: this.$textarea.get( 0 ),
				forceSync: true,
				insertTexts: {
					image: [ '![](#url#', ')' ],
				},
				spellChecker: this.o.spellcheck === 1,
				toolbar: [
					'bold',
					'italic',
					'heading',
					'|',
					'quote',
					'unordered-list',
					'ordered-list',
					'|',
					'link',
					'image',
					'|',
					{
						name: 'guide',
						action: 'https://guides.github.com/features/mastering-markdown/#syntax',
						className: 'fa fa-question-circle',
						title: 'Markdown Guide',
					},
				],
				status: false,
				autosave: {
					enabled: false,
				},
				parsingConfig: {
					xml: this.o.allow_html === 1,
					allowAtxHeaderWithoutSpace: true,
				},
			};


			if ( this.o.toolbar === 0 ) {
				args.toolbar = false;
			}


			if ( !this.inscrybmde[ this.o.id ] ) {
				this.inscrybmde[ this.o.id ] = new InscrybMDE( acf.apply_filters( 'niche_markdown/inscrybmde_args', args, this ) );
			}

		},

	} );

} )( jQuery );
