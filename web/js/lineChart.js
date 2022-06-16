var line = document.getElementById("lineChart").getContext("2d");

var lineChart = new Chart(line, {
  type: "line",
  data: {
    labels: [
      "Jan",
      "Feb",
      "March",
      "April",
      "May",
      "June",
      "July",
      "Aug",
      "Sept",
      "Oct",
      "Nov",
      "Dec",
    ],
    datasets: [
      {
        labels: "#",
        data: [],
        backgroundColor: [
          "rgba(255, 99, 132, 0.2)",
          "rgba(54, 162, 235, 0.2)",
          "rgba(255, 206, 86, 0.2)",
          "rgba(75, 192, 192, 0.2)",
          "rgba(153, 102, 255, 0.2)",
          "rgba(255, 159, 64, 0.2)",
          "rgba(54, 162, 235, 0.2)",
          "rgba(75, 192, 192, 0.2)",
          "rgba(255, 99, 132, 0.2)",
          "rgba(255, 159, 64, 0.2)",
          "rgba(153, 102, 255, 0.2)",
          "rgba(255, 206, 86, 0.2)",
        ],
        borderColor: [
          "rgba(255, 99, 132, 1)",
          "rgba(54, 162, 235, 1)",
          "rgba(255, 206, 86, 1)",
          "rgba(75, 192, 192, 1)",
          "rgba(153, 102, 255, 1)",
          "rgba(255, 159, 64, 1)",
          "rgba(54, 162, 235, 1)",
          "rgba(75, 192, 192, 1)",
          "rgba(255, 99, 132, 1)",
          "rgba(255, 159, 64, 1)",
          "rgba(153, 102, 255, 1)",
          "rgba(255, 206, 86, 1)",
        ],
        borderWidth: 1,
      },
    ],
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        display: false,
      },
      title: {
        display: true,
        text: "Goals Accomplished in Months",
        font: {
          size: 20,
        },
        padding: {
          top: 10,
          bottom: 30,
        },
      },
    },
    scales: {
      x: {
        title: {
          display: true,
          text: "Month",
        },
      },
      y: {
        beginAtZero: true,
        min: 0,
        max: 5,
        title: {
          display: true,
          text: "Number of goals accomplished in a month",
        },
        ticks: {
          stepSize: 1,
        },
      },
    },
  },
});

$(document).ready(() => {
  $.ajax({
    url: "src/getGoals.php?accomplished_only=true",
    type: "GET",
    dataType: "json",
  })
    .done((json) => {
      const monthlyCount = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
      json.forEach((data) => {
        let dateObj = new Date(data.goal_start_date);
        monthlyCount[dateObj.getMonth()] += 1;
      });
      console.log(monthlyCount);
      lineChart.data.datasets[0].data = monthlyCount;
      lineChart.update();
    })
    .fail((xhr, status, errorThrown) => {
      alert("Sorry, there was a problem!");
      console.log("Error: " + errorThrown);
      console.log("Status: " + status);
      console.dir(xhr);
    })
    .always(function (xhr, status) {
      console.log("The request is complete!");
    });
});
