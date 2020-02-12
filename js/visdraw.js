function draw() {
	// create a network
	var container = document.getElementById("mynetwork");
	var data ={
		nodes: nodes,
		edges: edges
	};
	var options = {
		nodes: {
			shape: "dot",
			size: 16
		},
		layout: {
			improvedLayout: false
		},
		physics: {
			forceAtlas2Based: {
				gravitationalConstant: -26,
				centralGravity: 0.005,
				springLength: 230,
				springConstant: 0.18
			},
			maxVelocity: 146,
			solver: "forceAtlas2Based",
			timestep: 0.35,
			stabilization: {iterations: 150}
		}
	};
	var network = new vis.Network(container, data, options);
}