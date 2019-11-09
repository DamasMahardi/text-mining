<style>
	.table1 {
		position: relative;
		width : 100%;
		margin : auto;
		font-family: sans-serif;
		color: #444;
		background-color : #ccd0d1;
		border-collapse: collapse;
		width: 80%;
		text-align: center;
	}
	
	.table1 tr th {
		position : relative;
        height: 40px;
        background: #35A9DB;
        color: #fff;
        text-align: center;
        font-weight: normal;
	}
	
	.table1, th, td {
		/* padding: 8px 20px; */
		position:relative; 
		padding-bottom: 20px;
		text-align: center;
	}
	
	.table1 tr:hover {
		background-color: #f5f5f5;
	}
	
	.table1 tr:nth-child(even) {
		background-color: #f2f2f2;
	}
</style>

<table border="1" class="table1">
		<tr>
			<th>NO.</th>
			<th>Term</th>
			<th>Doc_id</th>
			<th>Count</th>
			<th>Bobot</th>
		</tr>
		<?php
		//koneksi ke database
		include 'koneksi.php';
		// mysql_select_db("dbst");
		
		//query menampilkan data
		$sql = mysqli_query($koneksi, "SELECT * FROM tbindex ORDER BY Id ASC");
		$no = 1;
		while($data = mysqli_fetch_assoc($sql)){
			echo '
			<tr>
				<td>'.$no.'</td>
				<td>'.$data['Term'].'</td>
				<td>'.$data['DocId'].'</td>
				<td>'.$data['Count'].'</td>
				<td>'.$data['Bobot'].'</td>
			</tr>
			';
			$no++;
		}
		?>
	</table>
	</body>
</html>