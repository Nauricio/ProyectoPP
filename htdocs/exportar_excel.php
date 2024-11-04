<?php
	header("Content-Type: application/xls");    
	header("Content-Disposition: attachment; filename=documento_exportado_" . date('Y:m:d:m:s').".xls");
	header("Pragma: no-cache"); 
	header("Expires: 0");

	include("bdd2.php");
	
	$output = "";
	
	if(ISSET($_POST['export'])){
		$output .="
			<table>
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Ubicacion</th>
						<th>Descripcion</th>
						<th>Historia</th>
						<th>Fecha de Ingreso</th>
						<th>Fecha de Baja</th>
					</tr>
				<tbody>
		";
		
		$query = mysqli_query($conexion, "SELECT * FROM `objeto`") or die(mysqli_errno());
		while($fetch = mysqli_fetch_array($query)){
			
		$output .= "
					<tr>
						<td>".$fetch['id']."</td>
						<td>".$fetch['nombreO']."</td>
						<td>".$fetch['ubicacion']."</td>
						<td>".$fetch['descripcion']."</td>
                        <td>".$fetch['historia']."</td>
						<td>".$fetch['date1']."</td>
                        <td>".$fetch['date2']."</td>
					</tr>
		";
		}
		
		$output .="
				</tbody>
				
			</table>
		";
		
		echo $output;
	}
	
?>