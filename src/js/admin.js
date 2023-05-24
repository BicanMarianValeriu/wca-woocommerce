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
        SelectControl,
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
            <p>Settings</p>
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