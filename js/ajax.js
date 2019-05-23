if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
} else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (document.getElementById("ajoutput").innerHTML = "") {
        document.getElementById("ajoutput").innerHTML = "<p><img src='images/loading.gif'></p>";
      }
        document.getElementById("ajoutput").innerHTML = this.responseText;
        google.charts.load('current', {'packages':['line']});
        google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(drawChart1);
        function drawChart() {
        google.charts.load('current', {packages: ['corechart', 'line']});
        google.charts.setOnLoadCallback(drawBasic);
        function drawBasic() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'čas');
            data.addColumn('number', 'Teplota');
            data.addColumn('number', 'Vlhkost');
            data.addColumn('number', 'Rychlost větru');

            data.addRows([
                [0,1,3,2],[1,2,4,8]
            ]);

            var options = {
              'title': 'Posledních 24 hodin',
              hAxis: {
                title: 'Čas'
              },
              vAxis: {
                title: 'Hodnota'
              }
            };
            var chart = new google.visualization.LineChart(document.getElementById('chart_aktualne'));
            chart.draw(data, options);
          }
        }
        function drawChart1() {
        google.charts.load('current', {packages: ['corechart', 'line']});
        google.charts.setOnLoadCallback(drawBasic1);

        function drawBasic1() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'čas');
            data.addColumn('number', 'teplota');

            data.addRows([
              [0,1],[1,2]
            ]);

            var options = {
              'title':'Poslední 3 dny',
              hAxis: {
                title: 'Čas'
              },
              vAxis: {
                title: 'Hodnota'
              }
            };
            var chart = new google.visualization.LineChart(document.getElementById('chart_aktualne1'));
            chart.draw(data, options);
          }
        }
    }
};
xmlhttp.open("GET","views/home/aktualne.phtml",true);
xmlhttp.send();

function clickAjHandler(str) {
      if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();
      } else {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            if (document.getElementById("ajoutput").innerHTML = "") {
              document.getElementById("ajoutput").innerHTML = "<p><img src='images/loading.gif'></p>";
            }
              document.getElementById("ajoutput").innerHTML = this.responseText;
              if (str == "aktualne") {
                google.charts.load('current', {'packages':['line']});
                google.charts.setOnLoadCallback(drawChart);
                google.charts.setOnLoadCallback(drawChart1);
                function drawChart() {
                google.charts.load('current', {packages: ['corechart', 'line']});
                google.charts.setOnLoadCallback(drawBasic);

                function drawBasic() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('number', 'čas');
                    data.addColumn('number', 'teplota');

                    data.addRows([
                      [0,1],[1,2]
                    ]);

                    var options = {
                      'title':'How Much Pizza I Ate Last Night',
                      hAxis: {
                        title: 'Čas'
                      },
                      vAxis: {
                        title: 'Hodnota'
                      }
                    };
                    var chart = new google.visualization.LineChart(document.getElementById('chart_aktualne'));
                    chart.draw(data, options);
                  }
                }
                function drawChart1() {
                google.charts.load('current', {packages: ['corechart', 'line']});
                google.charts.setOnLoadCallback(drawBasic1);

                function drawBasic1() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('number', 'čas');
                    data.addColumn('number', 'teplota');

                    data.addRows([
                      [0,1],[1,2]
                    ]);

                    var options = {
                      'title':'How Much Pizza I Ate Last Night',
                      hAxis: {
                        title: 'Čas'
                      },
                      vAxis: {
                        title: 'Hodnota'
                      }
                    };
                    var chart = new google.visualization.LineChart(document.getElementById('chart_aktualne1'));
                    chart.draw(data, options);
                  }
                }
              } else if (str == "dennisouhrn") {
                google.charts.load('current', {'packages':['line']});
                google.charts.setOnLoadCallback(drawChart3);
                function drawChart3() {
                google.charts.load('current', {packages: ['corechart', 'line']});
                google.charts.setOnLoadCallback(drawBasic3);

                function drawBasic3() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('number', 'čas');
                    data.addColumn('number', 'teplota');

                    data.addRows([
                      [0,1],[1,2]
                    ]);

                    var options = {
                      'title':'How Much Pizza I Ate Last Night',
                      hAxis: {
                        title: 'Čas'
                      },
                      vAxis: {
                        title: 'Hodnota'
                      }
                    };
                    var chart = new google.visualization.LineChart(document.getElementById('chart_denni'));
                    chart.draw(data, options);
                  }
                }

              } else if (str == "mesicnisouhrn") {
                google.charts.load('current', {'packages':['line']});
                google.charts.setOnLoadCallback(drawChart3);
                function drawChart3() {
                google.charts.load('current', {packages: ['corechart', 'line']});
                google.charts.setOnLoadCallback(drawBasic3);

                function drawBasic3() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('number', 'čas');
                    data.addColumn('number', 'teplota');

                    data.addRows([
                      [0,1],[1,2]
                    ]);

                    var options = {
                      'title':'How Much Pizza I Ate Last Night',
                      hAxis: {
                        title: 'Čas'
                      },
                      vAxis: {
                        title: 'Hodnota'
                      }
                    };
                    var chart = new google.visualization.LineChart(document.getElementById('chart_mesicni'));
                    chart.draw(data, options);
                  }
                }

              }

          }
      };
      xmlhttp.open("GET","views/home/" + str + ".phtml",true);
      xmlhttp.send();
  }
