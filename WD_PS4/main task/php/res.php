<?	
	include 'valueForVote.php';

	$filename = 'json/data.json';
	$file = file_get_contents($filename);
	$arr = json_decode($file, true);

	$newArr = [];
	$newArr[0] = ['Programming language', 'Votes'];
	$i = 1;

	foreach ($arr as $key => $value){
		$newArr[$i] = [$valueForVote[$key], $value];
		$i++;
	}
	$newArr = json_encode($newArr);

?>

<script type="text/javascript">
	//console.log('<?php echo $newArr; ?>');
	chart('<?php print_r($newArr); ?>');
</script>