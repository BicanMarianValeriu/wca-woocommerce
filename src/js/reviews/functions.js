const formatDate = (date) => {
	const event = new Date(date);
	const options = { year: 'numeric', month: 'long', day: 'numeric' };
	return event.toLocaleDateString(undefined, options);
};

const scrollToElement = (element) => {
	if (element) {
		const headerEl = document.querySelector('.wp-site-header.sticky-top');
		const elementPosition = window.scrollY + element.getBoundingClientRect().top - 10;
		const scrollPosition = elementPosition - (headerEl ? headerEl.clientHeight : 0);
		window.scrollTo({ top: scrollPosition, behavior: 'smooth' });
	}
};

const getInitials = (name) => {
	if (!name) {
		return 'AN';
	}

	const names = name.trim().split(' ');
	const initials = names.map((n) => n[0].toUpperCase());

	return initials.join('');
};

const generateAvatarDataURL = (initials, size = 100, bgColor = '#007bff') => {
	const canvas = document.createElement('canvas');
	canvas.width = size;
	canvas.height = size;
	const ctx = canvas.getContext('2d');

	// Set background color
	ctx.fillStyle = bgColor;
	ctx.fillRect(0, 0, canvas.width, canvas.height);

	// Set text style
	ctx.font = `${size / 2.5}px Arial`;
	ctx.fillStyle = '#ffffff'; // White text color

	// Calculate text metrics to center it on the canvas
	const textMetrics = ctx.measureText(initials);
	const x = (canvas.width - textMetrics.width) / 2;
	const y = (canvas.height + size / 4) / 2.5 + size / 4 - textMetrics.actualBoundingBoxAscent / 2.5;

	// Draw initials on the canvas
	ctx.fillText(initials, x, y);

	// Convert canvas to data URL
	const dataURL = canvas.toDataURL();

	return dataURL;
};

const renderToString = (string = '', variables = {}) => {
	const destruct = (obj, v) => v.split(/\.|\|/).reduce((v, k) => v?.[k], obj); // Multiple
	const rxp = /{{([^}]+)}}/g;
	let match;

	while ((match = rxp.exec(string))) {
		const expression = match[1];
		const value = destruct(variables, expression.trim());

		if (value === undefined) continue;

		string = string.replace(new RegExp(`{{${expression}}}`, 'g'), value);
	}

	return string;
}

export { formatDate, scrollToElement, generateAvatarDataURL, getInitials, renderToString };