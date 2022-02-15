$(function () {
	const ctx1 = $("#PerChart2");
	const myChart1 = new Chart(ctx1, {
		type: "bar",
		data: {
			labels: campusname,
			datasets: [
				{
					label: "ร้อยละคนกรอกข้อมูล",
					data: percent,
					backgroundColor: [
						"rgba(150, 206, 180, 0.2)",
						"rgba(255, 238, 173, 0.2)",
						"rgba(217, 83, 79, 0.2)",
						"rgba(255, 173, 96, 0.2)",
					],
					borderColor: [
						"rgba(150, 206, 180, 1)",
						"rgba(255, 238, 173, 1)",
						"rgba(217, 83, 79, 1)",
						"rgba(255, 173, 96, 1)",
					],
					borderWidth: 1,
				},
			],
		},
		options: {
			plugins: {
				legend: {
					display: false,
				},
			},
			scales: {
				y: {
					beginAtZero: true,
				},
			},
			maintainAspectRatio: false,
		},
	});

	const ctx2 = $("#PerChart");
	const myChart2 = new Chart(ctx2, {
		type: "bar",
		data: {
			labels: campusname,
			datasets: [
				{
					label: "จำนวนครู",
					data: cnt,
					backgroundColor: [
						"rgba(7, 34, 39, 0.2)",
						"rgba(53, 133, 139, 0.2)",
						"rgba(79, 189, 186, 0.2)",
						"rgba(174, 254, 255, 0.2)",
					],
					borderColor: [
						"rgba(7, 34, 39, 1)",
						"rgba(53, 133, 139, 1)",
						"rgba(79, 189, 186, 1)",
						"rgba(174, 254, 255, 1)",
					],
					borderWidth: 1,
				},
			],
		},
		options: {
			plugins: {
				legend: {
					display: false,
				},
			},
			scales: {
				y: {
					beginAtZero: true,
				},
			},
			maintainAspectRatio: false,
		},
	});
});
