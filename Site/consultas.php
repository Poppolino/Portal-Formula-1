<?php
	include 'conecta.php';

    function escreve_tabela($opcao){

    	$mensagem = array (
    		'1' => "Os nomes dos vencedores de cada corrida e suas construtoras associadas",
			'2' => "O número total de vitórias dos corredores para cada construtora, ordenando pelos seus nomes",
			'3' => "Nome dos corredores que nunca passaram por pit stops (antes de 1982, era só para casos de necessidade)",
			'4' => "Quantos pilotos correram em seus aniversários e eram mais novos que alguém que correu com eles naqueles dias",
			'5' => "Pilotos que representa(ra)m unicamente o seu país",
    	);

    	$consultas = array (
			'1' => "select Corrida.name as Corrida, Corrida.year as Ano, forename as Nome, surname as Sobrenome, Construtora.name as Construtora from Resultado join Piloto on Resultado.driverId=Piloto.driverId join Construtora on Resultado.constructorId=Construtora.constructorId join Corrida on Resultado.raceId=Corrida.raceId where position = 1 order by Ano, Corrida;",

			'2' => "SELECT Piloto.forename as Nome, Piloto.surname as Sobrenome, Construtora.name as Construtora, count(raceId) as Vitórias FROM Piloto JOIN Resultado ON Piloto.driverId = Resultado.driverId JOIN Construtora ON Construtora.constructorId=Resultado.constructorId WHERE position = 1 group by Nome, Sobrenome, Construtora order by Nome, Sobrenome, Construtora;",
			
			'3' => "SELECT distinct forename as Nome, surname as Sobrenome from Piloto left outer join PitStop on Piloto.driverId = PitStop.driverId where stop is null;",
			
			'4' => "SELECT count(distinct code) as Quantidade FROM Piloto JOIN Resultado ON Piloto.driverId = Resultado.driverId JOIN Corrida ON Resultado.raceId=Corrida.raceId WHERE MONTH(dob) = MONTH(date) and DAY(dob) = DAY(date) and dob > some (SELECT dob from Resultado JOIN Piloto ON Piloto.driverId = Resultado.driverId JOIN Corrida AS Corrida1 ON Resultado.raceId = Corrida1.raceId WHERE Corrida1.raceId = Corrida.raceId);",
			
			'5' => "SELECT Piloto.forename as Nome, Piloto.surname as Sobrenome, Piloto.nationality as Nacionalidade from Piloto where nationality <> all (select distinct nationality from Piloto as Piloto1 where Piloto.driverId <> Piloto1.driverId);",
		);

		if (!array_key_exists($opcao, $consultas)){
			echo "<center><h2 style='color:white'> Bem-vindo ao site da Fórmula 1</h2></center>";
			echo "<center><p style='color:white'> Por favor, escolha uma das opções de consulta acima </p></center>";
		} 
		
		echo "<center><h1 style=color:white;>". $mensagem[$opcao] ."</h1></center>";

		$sql = $consultas[$opcao];
    	$stm = getConnection()->prepare($sql);
    	
    	if(!($stm->execute())){
    		return null;
    	}

		$row = $stm->fetch(PDO::FETCH_ASSOC);
		
	
		if(!$row){
			echo "<center><p style='color:white'> Não há ocorrências que casem com a consulta </p></center>";
			return null;
		}		

		echo "<center>";
		echo "<table class=\"styled-table\">";
		echo "<thead>";
		
		echo "<tr>";
		foreach ($row as $chave => $valor) {
		    echo "<th>$chave</th>";
		}
		echo "</tr>";
		echo "</thead>";


		echo "<tbody>";
		while($row){
			
			echo "<tr>";
			foreach ($row as $chave => $valor) {
		    	echo "<td>$valor</td>";
			}
			echo "</tr>";		  	
			
	 		$row = $stm->fetch(PDO::FETCH_ASSOC);
		}
		echo "</tbody>";
		   
	    $stm->closeCursor();
	    echo "</table>";
		echo "</center>";
	}


	if($_SERVER["REQUEST_METHOD"] == "GET"){

		if(empty($_GET['opt'])){
			echo "<center><h2 style='color:white'> Bem-vindo ao site da Fórmula 1</h2></center>";
			echo "<center><p style='color:white'> Por favor, escolha uma das opções de consulta acima </p></center>";
		}
		else{
			escreve_tabela($_GET['opt']);
		}
	}
