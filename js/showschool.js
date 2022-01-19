$(function () {
	const ctx = $("#tChart");
	const myChart = new Chart(ctx, {
		type: "bar",
		data: {
			labels: cLabel,
			datasets: [
				{
					label: "ร้อยละคนกรอกข้อมูล",
					data: cValue,
					backgroundColor: [
						"rgba(101, 193, 232, 0.2)",
						"rgba(216, 91, 99, 0.2)",
						"rgba(214, 128, 173, 0.2)",
						"rgba(92, 92, 92, 0.2)",
						"rgba(192, 186, 128, 0.2)",
						"rgba(253, 196, 125, 0.2)",
						"rgba(234, 59, 70, 0.2)",
					],
					borderColor: [
						"rgba(101, 193, 232, 1)",
						"rgba(216, 91, 99, 1)",
						"rgba(214, 128, 173, 1)",
						"rgba(92, 92, 92, 1)",
						"rgba(192, 186, 128, 1)",
						"rgba(253, 196, 125, 1)",
						"rgba(234, 59, 70, 1)",
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
		},
	});

	const ctx2 = $("#sChart");
	const myChart2 = new Chart(ctx2, {
		type: "bar",
		data: {
			labels: sLabel,
			datasets: [
				{
					label: "จำนวนข้อมูล",
					data: sValue,
					backgroundColor: [
						"rgba(255, 99, 132, 0.2)",
						"rgba(54, 162, 235, 0.2)",
						"rgba(255, 206, 86, 0.2)",
						"rgba(75, 192, 192, 0.2)",
						"rgba(153, 102, 255, 0.2)",
						"rgba(255, 159, 64, 0.2)",
					],
					borderColor: [
						"rgba(255, 99, 132, 1)",
						"rgba(54, 162, 235, 1)",
						"rgba(255, 206, 86, 1)",
						"rgba(75, 192, 192, 1)",
						"rgba(153, 102, 255, 1)",
						"rgba(255, 159, 64, 1)",
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
		},
	});
});
