<html>
	<head>
		<title>Hello World PHP!</title>
	</head>
	
	<body>
		<?php
			echo "Test!";
		
		
			$db_host = 'localhost';
			$db_user = 'root';
			$db_pwd = 'labadmin';

			$database = 'prototype';
			$table = 'soybean';
			
			$connection = mysqli_connect($db_host, $db_user, $db_pwd);

			if (!$connection)
				die("Can't connect to database");

			if (!mysqli_select_db($connection, $database))
				die("Can't select database");

			// sending query
			$result = mysqli_query($connection, "SELECT * FROM {$table}");
			if (!$result) {
				die("Query to show fields from table failed");
			}

			$fields_num = mysqli_num_fields($result);

			echo "<h1>Table: {$table}</h1>";
			echo "<table border='1'><tr>";
			// printing table headers
			for($i=0; $i<$fields_num; $i++)
			{
				$field = mysqli_fetch_field($result);
				echo "<td>{$field->name}</td>";
			}
			echo "</tr>\n";
			// printing table rows
			while($row = mysqli_fetch_row($result))
			{
				echo "<tr>";

				// $row is array... foreach( .. ) puts every element
				// of $row to $cell variable
				foreach($row as $cell)
					echo "<td>$cell</td>";

				echo "</tr>\n";
			}
			mysqli_free_result($result);
		?>
	</body>
</html>