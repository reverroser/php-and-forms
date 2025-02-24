<?php
if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

for ($i=0; $i < sizeof($file); $i++) {

    $fileName = $_FILES['file']['name'][$i];
    $fileTmpName = $_FILES['file']['tmp_name'][$i];
    $fileSize = $_FILES['file']['size'][$i];
    $fileError = $_FILES['file']['error'][$i];
    $fileType = $_FILES['file']['type'][$i];
   
    // CHECK THE FORMAT OF THE FILES:
    // To take appart a string that has the name.type, so we can check the type
    $fileExt = explode('.', $fileName);
    // After exploding the string, we get an array. To get the last item of the array
    // (type) we want to put it in lower case:
    $fileActualExt = strtolower(end($fileExt));
    // Files extentions we want to allow to be uploaded
    $allowed = array('jpg', 'png', 'txt', 'pdf');
    // Check if any of the extentions allowed are inside the $fileActualExt:
     if (in_array($fileActualExt, $allowed)) {
            //check if there hasn't been any error
            if ($fileError === 0) {
                //CHECK IF THE SIZE IS CORRECT:
                if ($fileSize < 4*1024*1024) {
                    // Create a new directory with the date of today
                    $dateFile = date("d-m-Y"."/");
                    $directoryStorage = "uploads/".$dateFile;
                    // Check if it doesn't exists, then create one or it already exists, then save files there.
                    if (!file_exists($directoryStorage)) {
                        mkdir('uploads/'.date("d-m-Y"),0777);
                        move_uploaded_file($fileTmpName, $directoryStorage.$fileName);
                    } else{
                        // Init duplicated files count.
                        $duplicatedFilesCount = 0;
                        // This is needed to compare the file name and the value without extension.
                        $baseFileName = basename($fileName, ".".$fileActualExt);
                        // Second paramether "array" in method "array_diff" removes the first dots in the array.
                        $scanned_directory = array_diff(scandir($directoryStorage), array('..', '.'));
                        foreach ($scanned_directory as $key => $value) {
                            // This is needed to compare the file name and the value without extension.
                            $baseValue = basename($value, ".".$fileActualExt);
                            // If the file name exist within the value increment the duplicated files count.
                            if (strpos($baseValue, $baseFileName) !== false) {
                                $duplicatedFilesCount++;
                            }
                        }
                        // If there are duplicated files, use the count to set the preffix "_n" to the file name.
                        if ($duplicatedFilesCount > 0) {
                            $fileName = $baseFileName."_".$duplicatedFilesCount.".".$fileActualExt;
                        }
                        move_uploaded_file($fileTmpName, $directoryStorage.$fileName);
                    }
                    // On success, redirect to index.php
                    header('Location: index.php?uploadSuccess');
                } else {
                    echo "Your file was too heavy";
                }
            } else {
                echo "There was an error uploading your file.";
            }
        } else {
            echo "You cannot upload files of this type";
        }
    }
};
?>