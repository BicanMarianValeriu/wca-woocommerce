export default `<svg
	role="img"
	width="1024"
	height="150"
	aria-labelledby="loading-aria"
	viewBox="0 0 1024 150"
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
			<circle cx="25" cy="40" r="25"></circle>
			<rect x="0" y="100" rx="3" ry="3" width="150" height="8"></rect>
			<rect x="0" y="115" rx="3" ry="3" width="75" height="6"></rect>
			<rect x="265" y="15" rx="3" ry="3" width="400" height="10"></rect>
			<rect x="265" y="35" rx="3" ry="3" width="75" height="8"></rect>
			<rect x="355" y="35" rx="3" ry="3" width="130" height="8"></rect>
			<rect x="265" y="65" rx="3" ry="3" width="750" height="6"></rect>
			<rect x="265" y="80" rx="3" ry="3" width="680" height="6"></rect>
			<rect x="265" y="95" rx="3" ry="3" width="630" height="6"></rect>
			<rect x="265" y="110" rx="3" ry="3" width="130" height="6"></rect>
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