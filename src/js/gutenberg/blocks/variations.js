/**
 * WordPress dependencies
 */
const {
    i18n: { __ },
} = wp;

const VARIATION_NAME = 'woocommerce/product-query/viewed-products';

const viewedProductsVariation = {
    block: 'core/query',
    attributes: {
        name: VARIATION_NAME,
        title: __('Recently viewed products', 'wca-woocommerce'),
        icon: 'products',
        description: __('Displays a list of recently viewed products for logged in users.', 'wca-woocommerce'),
        isActive: ['namespace'],
        attributes: {
            namespace: VARIATION_NAME,
            query: {
                postType: 'product',
                perPage: 4,
            },
            displayLayout: {
                type: 'flex',
                columns: 4
            }
        },
        allowedControls: [],
        innerBlocks: [
            ['core/heading', {
                level: 2,
                className: 'fw-500',
                content: __('Recently viewed products', 'wca-woocommerce')
            }],
            [
                'core/post-template',
                {
                    className: 'wp-block-query__products',
                    __woocommerceNamespace: 'woocommerce/product-query/product-template',
                    lock: {
                        move: true,
                        remove: true
                    }
                },
                [
                    ['core/pattern', {
                        slug: 'wecodeart/el-product-loop'
                    }],
                ],
            ]
        ]
    }
};

export { viewedProductsVariation };