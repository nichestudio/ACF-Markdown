# ACF Markdown Field

Markdown-enhanced ACF textarea.

Works with repeaters and even frontend forms using [Advanced Forms](https://github.com/advancedforms/advanced-forms).

## Uses
- [Inscryb/inscryb-markdown-editor](https://github.com/Inscryb/inscryb-markdown-editor) for the editor
- [cebe/markdown](https://github.com/cebe/markdown) to render the output

## Requires:
- PHP >=5.4
- Composer
- ACF v5

## Installation

	composer require nichestudio/ACF-Markdown

## Customise Editor

Override the [Inscryb editor options](https://github.com/Inscryb/inscryb-markdown-editor#configuration):

```javascript
acf.add_filter( 'niche_markdown/inscrybmde_args', function ( args, field ) {

	if ( field.o.id === 'field_xxxx' ) {
		args[ 'placeholder' ] = 'Enter your content using Markdown';
	}

	return args;
} );
```
