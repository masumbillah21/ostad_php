<?php

// Task 01

$file = '{{file_path}}';

if (file_exists($file)) {
    // Open the file
    $fp = fopen($file, 'r');
    
    // Checking if the file opened or not
    if($fp){
        // Read the content of the file
        $content = fread($fp, filesize($file));

        // Close the file
        fclose($fp);

        // Display the content
        echo $content;
    }else{
        echo "\nSorry could not open the file.";
    }
}else{
    echo "\nFile does not exist.";
}

?>

<?php

// Task 02

$file = '{{file_path}}';

$data = '{{data}}';


if (file_exists($file)) {
    // Open the file in append mode
    $fa = fopen($file, 'a');

    // Checking if the file opened or not
    if ($fa) {
        // Write the data to the file
        fwrite($fa, "\n" . $data);

        // Close the file
        fclose($fa);

        echo "\nNew data appended successfully.";
    }else{
        echo "\nSorry could not open the file.";
    }
}else{
    echo "\nFile does not exist.";
}

?>