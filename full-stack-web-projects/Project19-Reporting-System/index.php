<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
		}
		.graficos{
			width: 50%;
			margin: 0 auto;
		}
		header{
			background-color: gray;
		}
		.center{
			max-width: 1280px;
			margin: 0 auto;
			padding: 0 2%;
		}
	</style>
</head>
<body>
	<header>
		<div class="center">
			<a href="">Atualizar Gráfico</a>
		</div>
	</header>
	<div class="graficos">
		<canvas id="myChart" width="400" height="400"></canvas>
	</div>
	

	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
	<script>
	var ctx = document.getElementById('myChart').getContext('2d');
	
	$('a').click(function(e){
		e.preventDefault();
		atualizarGrafico();
	})

	function atualizarGrafico(){
		$.ajax({
			url: 'info.php',
			dataType: 'json',
			success: function(dataInfo){
				var myChart = new Chart(ctx, {
				    type: 'bar',
				    data: {
				        labels: ['Janeiro', 'Fevereiro', 'Março'],
				        datasets: [{
				            label: '# Receita do Mês',
				            data: [dataInfo[0].valor, dataInfo[1].valor, dataInfo[2].valor],
				            backgroundColor: [
				                'rgba(255, 99, 132, 0.2)',
				                'rgba(54, 162, 235, 0.2)',
				                'rgba(255, 206, 86, 0.2)'
				            ],
				            borderColor: [
				                'rgba(255, 99, 132, 1)',
				                'rgba(54, 162, 235, 1)',
				                'rgba(255, 206, 86, 1)'
				            ],
				            borderWidth: 1
				        }]
				    },
				    options: {
				        scales: {
				            yAxes: [{
				                ticks: {
				                    beginAtZero: true
				                }
				            }]
				        }
				    }
				});
			}
		})
	}
</script>
</body>
</html>