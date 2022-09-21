google.charts.load('current', {'packages':['line']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

var data = new google.visualization.DataTable();
data.addColumn('number', 'Day');
data.addColumn('number', 'Guardians of the Galaxy');
data.addColumn('number', 'The Avengers');
data.addColumn('number', 'Transformers: Age of Extinction');

data.addRows([
    ['1',  1000,      400],
    ['6',  1170,      460],
    ['11',  660,       1120],
    ['16',  1030,      540],
    ['21',  1030,      540],
    ['26',  1030,      540],
    ['31',  1030,      540]
]);

var options = {
chart: {
  title: 'Box Office Earnings in First Two Weeks of Opening',
  subtitle: 'in millions of dollars (USD)'
},
width: 900,
height: 500
};

var chart = new google.charts.Line(document.getElementById('linechart_material'));

chart.draw(data, google.charts.Line.convertOptions(options));
}