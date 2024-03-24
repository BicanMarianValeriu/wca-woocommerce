export default `<svg
	role="img"
	width="1024"
	height="460"
	aria-labelledby="loading-aria"
	viewBox="0 0 1024 450"
	preserveAspectRatio="none"
	style="width:100%;height:auto;"
>
	<title id="loading-aria">Loading...</title>
	<rect
		x="0"
		y="0"
		width="100%"
		height="100%"
		clip-path="url(#clip-path)"
		style='fill: url("#fill");'
	></rect>
	<defs>
		<clipPath id="clip-path">
			<circle cx="100" cy="110" r="100"></circle>
			<rect x="265" y="50" rx="3" ry="3" width="380" height="25"></rect>
			<rect x="265" y="100" rx="3" ry="3" width="150" height="20"></rect>
			<rect x="0" y="240" rx="3" ry="3" width="500" height="20"></rect>
			<rect x="0" y="270" rx="3" ry="3" width="220" height="20"></rect>
			<rect x="0" y="320" rx="3" ry="3" width="980" height="20"></rect>
			<rect x="0" y="350" rx="3" ry="3" width="880" height="20"></rect>
			<rect x="0" y="400" rx="3" ry="3" width="400" height="20"></rect>
		</clipPath>
		<linearGradient id="fill">
			<stop
				offset="0.599964"
				stop-color="#f3f3f3"
				stop-opacity="1"
			>
				<animate
					attributeName="offset"
					values="-2; -2; 1"
					keyTimes="0; 0.25; 1"
					dur="2s"
					repeatCount="indefinite"
				></animate>
			</stop>
			<stop
				offset="1.59996"
				stop-color="#ecebeb"
				stop-opacity="1"
			>
				<animate
					attributeName="offset"
					values="-1; -1; 2"
					keyTimes="0; 0.25; 1"
					dur="2s"
					repeatCount="indefinite"
				></animate>
			</stop>
			<stop
				offset="2.59996"
				stop-color="#f3f3f3"
				stop-opacity="1"
			>
				<animate
					attributeName="offset"
					values="0; 0; 3"
					keyTimes="0; 0.25; 1"
					dur="2s"
					repeatCount="indefinite"
				></animate>
			</stop>
		</linearGradient>
	</defs>
</svg>`;