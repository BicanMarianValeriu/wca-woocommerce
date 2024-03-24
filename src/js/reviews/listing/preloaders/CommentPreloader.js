export default `<svg
	role="img"
	width="1024"
	height="100"
	aria-labelledby="loading-aria"
	viewBox="0 0 1024 100"
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
		<circle cx="35" cy="55" r="30"></circle>
		<rect x="95" y="30" rx="3" ry="3" width="150" height="8"></rect>
		<rect x="260" y="31" rx="3" ry="3" width="75" height="6"></rect>
		<rect x="95" y="50" rx="3" ry="3" width="920" height="6"></rect>
		<rect x="95" y="60" rx="3" ry="3" width="880" height="6"></rect>
		<rect x="95" y="70" rx="3" ry="3" width="700" height="6"></rect>
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