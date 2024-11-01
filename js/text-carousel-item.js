( function( blocks, element, editor, components, i18n ) {
    var el = element.createElement;

    var __                = i18n.__;
    var createElement     = element.createElement;
    var InspectorControls = editor.InspectorControls;
    var RichText          = editor.RichText;
 
    blocks.registerBlockType( 'tishonator/text-carousel-item-block', {
        title: 'Text Carousel Item',
        icon: 'align-full-width',
        category: 'widgets',

        attributes: {
            content: {
                type: 'string',
            },
        },

        edit: function( props ) {
            return createElement('div', {},
            [
                createElement( wp.blockEditor.RichText, {
                    tagName: 'div',
                    value: props.attributes.content,
                    class: 'tish-text-carousel-item',
                    onChange: function( content ) {
                        props.setAttributes( { content: content } );
                    },
                    placeholder: __( 'Text Carousel Item Content', 'tishonator' ),
                        } ),
            ]);
    },
 
    save: function( props ) {
        return createElement('div', {},
            [
                createElement( wp.blockEditor.RichText.Content, {
                    tagName: 'div',
                    class: 'tish-text-carousel-item',
                    value: props.attributes.content
                } )
            ]);
    }

    } );
}(
    window.wp.blocks,
    window.wp.element,
    window.wp.blockEditor,
    window.wp.components,
    window.wp.i18n
) );

