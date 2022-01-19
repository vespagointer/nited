$(function () {
	const ctx = $("#PerChart");
	const myChart = new Chart(ctx, {
		type: "bar",
		data: {
			labels: sName,
			datasets: [
				{
					label: "ร้อยละคนกรอกข้อมูล",
					data: sPer,
					backgroundColor: "rgba(234, 59, 70, 0.2)",
					borderColor: "rgba(234, 59, 70, 1)",
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
