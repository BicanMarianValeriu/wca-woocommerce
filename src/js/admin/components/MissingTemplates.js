/**
 * @package: 	WeCodeArt WooCommerce Extension
 * @author: 	Bican Marian Valeriu
 * @license:	https://www.wecodeart.com/
 * @version:	1.0.0
 */

const {
    i18n: {
        __,
    },
    components: {
        Spinner,
        Button,
    },
    element: {
        useState,
    }
} = wp;

const { missing: _missingTemplates = [] } = wecodeartWooCommerce;

const MissingTemplates = ({ loading, setLoading, handleNotice }) => {
    const [missingTemplates, setMissingTemplates] = useState(_missingTemplates);

    if(missingTemplates.length === 0) {
        return null;
    }

    return (
        <>
            <div className="components-notice is-warning flex-column align-items-start m-0 mb-3">
                <h3 className="my-3">{__('Your current theme is missing the following WooCommerce templates:', 'wca-woocommerce')}</h3>
                <ul className="my-0">{missingTemplates.map(({ title, description }) => (<li><strong>{title}</strong>: {description}</li>))}</ul>
                <p>
                    <Button className="button" isPrimary icon={loading && <Spinner />} onClick={() => {
                        setLoading(true);

                        const formData = new FormData();
                        formData.append('action', 'wca_manage_woo_data');
                        formData.append('type', 'copy');
                        formData.append('slugs', JSON.stringify(missingTemplates.map(({ slug }) => (slug))));

                        return fetch(ajaxurl, {
                            method: 'POST',
                            body: formData
                        }).then(r => r.json()).then(({ data: { message = '', success = [] } = {} }) => {
                            if (success.length) {
                                setMissingTemplates([...missingTemplates.filter(({ slug }) => !success.includes(slug))]);
                            }
                            handleNotice(message);
                        });
                    }} {...{ disabled: loading }} >{loading ? '' : __('Install Templates', 'wca-woocommerce')}</Button>
                </p>
            </div>
        </>
    );
};

export default MissingTemplates;