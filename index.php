<?php include_once(__DIR__ . '/app/start.php'); ?>
<h2>References</h2>
<p>Input page for every entity / relationship and the respective reference</p>
<table>
	<thead>
		<tr>
			<th>Entity Input</th>
			<th>Reference</th>
			<th>Type</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$items = scandir(__DIR__ . '/input');
			foreach ($items as $item) {
				if ($item[0] == '.') {
					continue;
				}

				// pathinfo will remove the extension, ucfirst will
				// capitalize the first letter
				$entity = ucfirst(pathinfo($item, PATHINFO_FILENAME));
				$input = ROOT . "input/$item";
				$reference = ROOT . "reference/$item";

				$type = strpos($item, 'rel') !== false ? 'Relationship' : 'Entity';

				echo "
					<tr>
						<td><a href='$input'>Add $entity</a></td>
						<td><a href='$reference'>$entity reference</a></td>
						<td>$type</td>
					</tr>
				";
			}
		?>
	</tbody>
</table>
<?php include_once(__DIR__ . '/app/end.php'); ?>
