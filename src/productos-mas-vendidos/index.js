import { __ } from '@wordpress/i18n';
import { registerBlockType, createBlock } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { useState, useEffect } from '@wordpress/element';
import { PanelBody, RangeControl } from '@wordpress/components';
import './style.sass';
import './editor.sass';

registerBlockType('custom-blocks/productos-mas-vendidos', {
    save: () => null,

    edit: ({ attributes, setAttributes }) => {
        const { cantidad } = attributes;

        const [productos, setProductos] = useState([]);
        const [isLoading, setIsLoading] = useState(true);

        useEffect(() => {
            setIsLoading(true);

            fetch(`/wp-json/wp/v2/product?per_page=${cantidad}&_embed=1`)
                .then((res) => res.json())
                .then((data) => {
                    setProductos(data);
                    console.log(data)
                    setIsLoading(false);
                })
                .catch((err) => {
                    console.error('Error cargando productos:', err);
                    setIsLoading(false);
                });
        }, [cantidad]);

        const blockProps = useBlockProps({
            className: 'woocommerce-mas-vendidos'
        });

        return (
            <div {...blockProps}>
                <InspectorControls>
                    <PanelBody title="Configuración del bloque">
                        <RangeControl
                            label="Cantidad de productos"
                            value={cantidad}
                            onChange={(value) => setAttributes({ cantidad: value })}
                            min={1}
                            max={20}
                        />
                    </PanelBody>
                </InspectorControls>

                <h2>Vista previa en el editor:</h2>

                {isLoading ? (
                    <p>Cargando productos...</p>
                ) : (
                    productos.length > 0 ? (
                        <ul>
                            {productos.map(producto => {
                                const imageUrl = producto._embedded?.['wp:featuredmedia']?.[0]?.source_url;
                                const title = producto.title.rendered;
                                const permalink = producto.link;

                                return (
                                    <li key={producto.id}>
                                        <a href={permalink}>{title}</a><br />
                                        {imageUrl && (
                                            <img
                                                src={imageUrl}
                                                alt={title}
                                                style={{ maxWidth: '100px', marginTop: '8px' }}
                                            />
                                        )}
                                    </li>
                                );
                            })}
                        </ul>
                    ) : (
                        <p>No hay productos disponibles.</p>
                    )
                )}
            </div>
        );
    },

    transforms: {
        from: [
            {
                type: 'block',
                blocks: ['core/latest-posts'],
                transform: () => createBlock('custom-blocks/productos-mas-vendidos')
            }
        ]
    }
});
