var ctx = document.getElementById("polarChart").getContext("2d");
let goalName, goalPercentage;
var myChart = new Chart(ctx, {
  type: "polarArea",
  data: {
    labels: goalName,
    datasets: [
      {
        data: goalPercentage,
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
    responsive: true,
    plugins: {
      labels: {
        render: (args) => {
          return args.value + "%";
        },
      },
      title: {
        display: true,
        text: "Goals Percentage",
        font: {
          size: 20,
        },
        padding: {
          top: 10,
          bottom: 30,
        },
      },
      legend: {
        position: "bottom",
      },
    },
  },
});

$(document).ready(() => {
  $.ajax({
    url: "./src/userGoal.php",
    type: "GET",
    dataType: "json",
  })
    .done((datapoints) => {
      // const datapoints = JSON.parse(this.responseText);
      goalName = datapoints.map(function (index) {
        return index.goal_title;
      });
      goalPercentage = datapoints.map(function (index) {
        return index.goal_progress;
      });
      console.log(goalName);
      console.log(goalPercentage);
      myChart.data.labels = goalName;
      myChart.data.datasets[0].data = goalPercentage;
      myChart.update();
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
