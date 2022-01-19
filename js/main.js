function ChartData(xb, xd, label) {
	var data = {
		labels: xb,
		datasets: [
			{
				label: label,
				data: xd,
				backgroundColor: [
					"rgba(255, 99, 132, 0.2)",
					"rgba(54, 162, 235, 0.2)",
					"rgba(255, 206, 86, 0.2)",
					"rgba(75, 192, 192, 0.2)",
					"rgba(153, 102, 255, 0.2)",
				],
				borderColor: [
					"rgba(255, 99, 132, 1)",
					"rgba(54, 162, 235, 1)",
					"rgba(255, 206, 86, 1)",
					"rgba(75, 192, 192, 1)",
					"rgba(153, 102, 255, 1)",
				],
				borderWidth: 1,
				barPercentage: 1,
				categoryPercentage: 0.5,
			},
		],
	};
	return data;
}

function ChartPlugin(Title) {
	var plugin = {
		title: {
			display: true,
			text: Title,
			font: {
				size: 18,
				family: "Sarabun",
			},
			padding: {
				bottom: 50,
			},
		},
		legend: {
			display: false,
		},
		tooltip: {
			enabled: true,
		},
	};
	return plugin;
}

function ChartScales() {
	var scales = {
		x: {
			display: false,
		},
	};
	return scales;
}
$(document).ready(function () {
	var myCarousel = $(".carousel");
	var carousel = new bootstrap.Carousel(myCarousel, {
		interval: 2000,
		wrap: true,
	});

	const ctx = $("#award");
	ctx.height(300);
	const myChart = new Chart(ctx, {
		type: "bar",
		data: ChartData(aLabels, aData, "จำนวนรางวัล"),
		options: {
			plugins: ChartPlugin("Top 5 รายงานรางวัลของโรงเรียน"),
			scales: ChartScales(),
			responsive: true,
			maintainAspectRatio: false,
		},
	});

	const ctx2 = $("#project");
	ctx2.height(300);
	const myChart2 = new Chart(ctx2, {
		type: "bar",
		data: ChartData(pLabels, pData, "จำนวนโครงการ"),
		options: {
			plugins: ChartPlugin("Top 5 รายงานโครงการ"),
			scales: ChartScales(),
			responsive: true,
			maintainAspectRatio: false,
		},
	});

	const ctx3 = $("#PerChart");
	const myChart3 = new Chart(ctx3, {
		type: "bar",
		data: {
			labels: sName,
			datasets: [
				{
					label: "ร้อยละคนกรอกข้อมูล",
					data: sPer,
					backgroundColor: "rgba(8, 51, 88, 0.2)",
					borderColor: "rgba(8, 51, 88, 1)",
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
