let votes = []

let graphType= "bar"
Chart.defaults.color = "#effbff";
Chart.defaults.font.family = "'Raleway', sans-serif;"

$(function() {
    $("#barChartButton").click(function() {
      graphType = "bar";
      $(this).prop("disabled", true)
      $("#pieChartButton").prop("disabled", false)
      Chart.getChart("graph").destroy()
      createGraph();
    })
    $("#pieChartButton").click(function() {
      graphType = "pie";
      $(this).prop("disabled", true)
      $("#barChartButton").prop("disabled", false)
      Chart.getChart("graph").destroy()
      createGraph();
    })
    $("#saveChanges").click(function() {
      let questionVisibility = $("#questionVisibility").find(":selected").val()
      let answerVisibility = $("#answerVisibility").find(":selected").val()

      $("#hiddenForm").html(`
        <input type="hidden" name="QuestionVisibility" value="${questionVisibility}">
        <input type="hidden" name="AnswerVisibility" value="${answerVisibility}"> 
      `).submit()
    })
})

function getVotes(votesFromPost) {
  votes = votesFromPost
  createGraph()
}

function createGraph() {
  new Chart(
    document.getElementById('graph'),
    {
        type: graphType,
        data: {
            labels: votes.map(row => row.answer),
            datasets: [
                {
                    label: 'Votos',
                    data: votes.map(row => row.count),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false 
        }
    }
  );
}


