<meta charset="UTF-8">	
<?php
	# random function
	function make_array($students, $themes)
	{
		$split_students = preg_split('/\n/', $students);
		$split_students = clear_array($split_students);

		$split_themes = preg_split('/\n/', $themes);
		$split_themes = clear_array($split_themes);

		$list = [];
		foreach($split_themes as $theme){
			$students_count = count($split_students) - 1;
			$rand = rand(0, $students_count);

			$list[$theme] = $split_students[$rand];
			array_splice ($split_students, $rand, 1);
		}

		return $list;

	}

	# create list for saving into the file
	function make_list($students, $themes)
	{
		$array = make_array($students, $themes);

		$list = "";

		foreach ($array as $theme => $student) {
			$list .= $theme . " - " . $student . "\n";
		}

		return $list;
	}

	# clear from new lines
	function clear_array($array)
	{
		foreach ($array as $item) {
			$item = preg_replace('/\n/', '', $item);
		}

		return $array;
	}

	###### ====== MAIN CODE ======= #######


	# read students file
	$students = file_get_contents('students.txt');

	# read themes file
	$themes = file_get_contents('themes.txt');

	# create random array
	$random = make_list($students, $themes);

	# save result
	echo "<pre>". $random ."</pre>";
	file_put_contents('output.txt', $random);
