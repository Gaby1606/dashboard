<?php if ( ! defined('URL_BASE')) exit; ?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Dia', 'Saldo positivo', 'Saldo negativo'],
           <?php
            $pdo = new PDO('mysql:host=localhost:3306;dbname=cash_book', 'root', '');
            $query="SELECT type, date, value FROM moviment ORDER BY date";
            $consulta=$pdo->prepare($query);
            $consulta->execute();
            $estáticoOUT=0;
            foreach ($consulta as $mostra) {
            $date=$mostra['date'];
            $valor=$mostra['value'];
            $type=$mostra['type'];
            ?>
            <?php
            if ( $type=="input"){
            ?>
            ['<?php echo $date;?>', <?php echo $estáticoIN=$valor;?>, <?php echo $estáticoOUT;?>],
            <?php 
            }else if($type=="output"){
                ?>
                ['<?php echo $date;?>',<?php echo $estáticoIN;?>, <?php echo $estáticoOUT=$valor;?>],
                <?php
            }
            }
            ?>
        ]);

        var options = {
          title: 'GRÁFICO DIÁRIO',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 1350px; height: 500px"></div>
  </body>
</html>

</head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-4 txt-center">
          <div class="card text-center" style="width: 18rem; background-color: #29DB01;">
            <div class="card-body">
              <strong> <p style="font-size: 16px;">SALDO</p> </strong>
                <h5 class="card-title" id="saldo">R$ </h5>
            </div>
          </div>
        </div>
        <div class="col-4 txt-center">
          <div class="card text-center" style="width: 18rem; background-color: #FF0105;">
            <div class="card-body">
            <strong> <p style="font-size: 16px;">SAÍDA</p> </strong>
              <h5 class="card-title" id="mediaSaida">R$ </h5>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="card text-center" style="width: 18rem; background-color: #1567FF;">
           <div class="card-body">
           <strong> <p style="font-size: 16px;">ENTRADA</p> </strong>
            <h5 class="card-title" id="mediaEntrada">R$ </h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="curve_chart" style="width: 1300px; height: 500px"></div>
  </body>
  <script>

      let saldo=0;
      let quantidadeSaida=0;
      let quantidadeEntrada=0;
      let contEntrada=0;
      let contSaida=0;
      let mediaEntrada=0;
      let mediaSaida=0;

            <?php
            foreach($data['home'] AS $home){
              $valor= $home['value'];
              $type= $home['type'];
                if($type=="input"){?>
                    saldo+=<?php echo $valor?>;
                    quantidadeEntrada+=<?php echo $valor?>;
                    contEntrada++;
                  <?php   
                }else if($type=="output"){?>
                    saldo-=<?php echo $valor?>; 
                    quantidadeSaida+=<?php echo $valor?>; 
                    contSaida++;         
                    <?php
                }
          }
              ?>
                mediaEntrada=quantidadeEntrada/contEntrada;
                mediaEntrada=mediaEntrada.toFixed(2);
                mediaSaida=quantidadeSaida/contSaida;
                mediaSaida=mediaSaida.toFixed(2);
              <?php 
              ?>
            console.log(saldo);
            document.querySelector("#saldo").innerHTML+=saldo;
            document.querySelector("#mediaEntrada").innerHTML+=mediaEntrada;
            document.querySelector("#mediaSaida").innerHTML+=mediaSaida;
    </script>
</html>


