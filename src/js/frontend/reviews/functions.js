const formatDate = (date) => {
	const event = new Date(date);
	const options = { year: 'numeric', month: 'long', day: 'numeric' };
	return event.toLocaleDateString(undefined, options);
};

const getCookie = (cname) => {
	const name = cname + "=";
	const ca = document.cookie.split(';');

	for (let i = 0; i < ca.length; i++) {
		let c = ca[i];
		while (c.charAt(0) == ' ') c = c.substring(1);
		if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
	}

	return "";
};

const scrollToElement = (element) => {
	if (element) {
		const headerEl = document.querySelector('.wp-site-header.sticky-top');
		const elementPosition = window.scrollY + element.getBoundingClientRect().top - 10;
		const scrollPosition = elementPosition - (headerEl ? headerEl.clientHeight : 0);
		window.scrollTo({ top: scrollPosition, behavior: 'smooth' });
	}
};

export { formatDate, getCookie, scrollToElement };