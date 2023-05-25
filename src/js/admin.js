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
        ToggleControl,
        Card,
        CardHeader,
        CardBody,
        Dashicon,
        Spinner,
        Tooltip,
        Button,
    },
    element: {
        useState,
        useEffect
    }
} = wp;

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

    const handleNotice = () => {
        setLoading(false);

        return createNotice('success', __('Settings saved.', 'wca-woocommerce'));
    };

    return (
        <>
            <Card>
                <CardHeader>
                    <h5 className="text-uppercase fw-medium m-0">{__('Optimization', 'wca-woocommerce')}</h5>
                </CardHeader>
                <CardBody>
                    <ToggleControl
                        label={<>
                            <span style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between' }}>
                                <span>{__('Remove CSS?', 'wca-woocommerce')}</span>
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
                        help={__('Remove default WooCommerce stylesheets.', 'wca-woocommerce')}
                        checked={formData['remove_style']}
                        onChange={value => setFormData({ ...formData, remove_style: value })}
                    />
                    <ToggleControl
                        label={__('Replace Select2 CSS?', 'wca-woocommerce')}
                        help={__('Replace Select2 stylesheet with an optimized version for our theme.', 'wca-woocommerce')}
                        checked={formData['replace_select2_style']}
                        onChange={value => setFormData({ ...formData, replace_select2_style: value })}
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
                    saveSettings({ woocommerce: formData }, handleNotice);
                }}
                {...{ disabled: loading }}
            >
                {loading ? '' : __('Save', 'wecodeart')}
            </Button>
        </>
    );
};