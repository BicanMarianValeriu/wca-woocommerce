/**
 * @package: 	WeCodeArt WooCommerce Extension
 * @author: 	Bican Marian Valeriu
 * @license:	https://www.wecodeart.com/
 * @version:	1.0.0
 */

const {
    i18n: {
        __,
        sprintf
    },
    hooks: {
        addFilter
    },
    components: {
        Placeholder,
        DropdownMenu,
        RangeControl,
        ToggleControl,
        Card,
        CardHeader,
        CardBody,
        Dashicon,
        Spinner,
        Button,
    },
    element: {
        useState,
    }
} = wp;

import { MissingTemplates } from './components';

addFilter('wecodeart.admin.tabs.plugins', 'wecodeart/woocommerce/admin/panel', optionsPanel);
function optionsPanel(panels) {
    return [...panels, {
        name: 'wca-woocommerce',
        title: __('WooCommerce', 'wca-woocommerce'),
        render: (props) => <Options {...props} />
    }];
}

const Options = (props) => {
    const { settings, saveSettings, isRequesting, createNotice } = props;

    if (isRequesting || !settings) {
        return <Placeholder {...{
            icon: <Spinner />,
            label: __('Loading', 'wca-woocommerce'),
            instructions: __('Please wait, loading settings...', 'wca-woocommerce')
        }} />;
    }

    const [loading, setLoading] = useState(null);
    const apiOptions = (({ woocommerce }) => (woocommerce))(settings);
    const [formData, setFormData] = useState(apiOptions);

    const handleNotice = (message = '') => {
        setLoading(false);

        if (!message) {
            message = __('Settings saved.', 'wca-woocommerce')
        }

        return createNotice('success', message);
    };

    return (
        <>
            <MissingTemplates {...{ loading, setLoading, handleNotice }} />
            <Card className="border shadow-none">
                <CardHeader>
                    <h5 className="text-uppercase fw-medium m-0">{__('Optimization', 'wca-woocommerce')}</h5>
                </CardHeader>
                <CardBody>
                    <ToggleControl
                        label={<>
                            <span style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between' }}>
                                <span>{__('Remove legacy CSS?', 'wca-woocommerce')}</span>
                                <DropdownMenu
                                    label={__('More Information', 'wca-woocommerce')}
                                    icon={<Dashicon icon="info" style={{ color: 'var(--wca--header--color)' }} />}
                                    toggleProps={{
                                        style: {
                                            height: 'initial',
                                            minWidth: 'initial',
                                            padding: 0
                                        }
                                    }}
                                    popoverProps={{
                                        focusOnMount: 'container',
                                        position: 'bottom',
                                        noArrow: false,
                                    }}
                                >
                                    {() => (
                                        <p style={{ minWidth: 250, margin: 0 }}>
                                            {__('These styles primarily cater to legacy themes, whereas WooCommerce blocks now have their own styles.', 'wca-woocommerce')}
                                        </p>
                                    )}
                                </DropdownMenu>
                            </span>
                        </>}
                        help={sprintf(__('Default WooCommerce style will be %s.', 'wca-woocommerce'), !formData?.remove_style ? __('loaded', 'wca-woocommerce') : __('removed', 'wca-woocommerce'))}
                        checked={formData?.remove_style}
                        onChange={value => setFormData({ ...formData, remove_style: value })}
                    />
                    <ToggleControl
                        label={__('Replace Select2 CSS?', 'wca-woocommerce')}
                        help={__('Replace Select2 stylesheet with an optimized version for our theme.', 'wca-woocommerce')}
                        checked={formData?.replace_select2_style}
                        onChange={value => setFormData({ ...formData, replace_select2_style: value })}
                    />
                </CardBody>
            </Card>
            <Card className="border border-top-0 shadow-none">
                <CardHeader>
                    <h5 className="text-uppercase fw-medium m-0">{__('Functionality', 'wca-woocommerce')}</h5>
                </CardHeader>
                <CardBody>
                    <ToggleControl
                        label={<>
                            <span style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between' }}>
                                <span>{__('Enable product price extras?', 'wca-woocommerce')}</span>
                                <DropdownMenu
                                    label={__('More Information', 'wca-woocommerce')}
                                    icon={<Dashicon icon="info" style={{ color: 'var(--wca--header--color)' }} />}
                                    toggleProps={{
                                        style: {
                                            height: 'initial',
                                            minWidth: 'initial',
                                            padding: 0
                                        }
                                    }}
                                    popoverProps={{
                                        focusOnMount: 'container',
                                        position: 'bottom',
                                        noArrow: false,
                                    }}
                                >
                                    {() => (
                                        <p style={{ minWidth: 250, margin: 0 }}>
                                            {__('A new field has been introduced in the product administration page for both normal and variation products.', 'wca-woocommerce')}
                                        </p>
                                    )}
                                </DropdownMenu>
                            </span>
                        </>}
                        help={__('Enhance the Product Price block by integrating a tooltip that showcases the recommended price set by the producer.', 'wca-woocommerce')}
                        checked={formData?.product_price_extra}
                        onChange={value => setFormData({ ...formData, product_price_extra: value })}
                    />
                    <ToggleControl
                        label={__('Enable product rating extras?', 'wca-woocommerce')}
                        help={__('Enhance the Product Rating block(s) by incorporating enhanced and visually captivating rating information.', 'wca-woocommerce')}
                        checked={formData?.product_rating_extra}
                        onChange={value => setFormData({ ...formData, product_rating_extra: value })}
                    />
                    <ToggleControl
                        label={__('Enable customer account extras?', 'wca-woocommerce')}
                        help={__('Enhance the Customer Account block by adding a dropdown with WooCommerce\'s account page endpoints.', 'wca-woocommerce')}
                        checked={formData?.customer_account_extra}
                        onChange={value => setFormData({ ...formData, customer_account_extra: value })}
                    />
                    <RangeControl
                        label={__('Product gallery columns', 'wca-woocommerce')}
                        value={formData?.product_gallery_cols}
                        onChange={value => setFormData({ ...formData, product_gallery_cols: value })}
                        min={3}
                        max={8}
                    />
                </CardBody>
            </Card>
            <hr style={{ margin: '20px 0' }} />
            <Button
                className="button"
                isPrimary
                isLarge
                icon={loading && <Spinner />}
                onClick={() => {
                    setLoading(true);
                    saveSettings({ woocommerce: formData }, () => handleNotice());
                }}
                {...{ disabled: loading }}
            >
                {loading ? '' : __('Save', 'wecodeart')}
            </Button>
        </>
    );
};