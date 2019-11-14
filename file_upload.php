<?php
if (isset($_POST['submit'])) {
    $file = $_FILES['file'];
// print_r($file);

$fileName = $_FILES['file']['name'];
$fileTmpName = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$fileError = $_FILES['file']['error'];
$fileType = $_FILES['file']['type'];
// to take appart a string that has the name.type, so we can check the type
$fileExt = explode('.', $fileName);
// after exploding the string, we get an array. To get the last item of the array
// (that is going to be the type) we want to put it in lower case:
$fileActualExt = strtolower(end($fileExt));

// this are the files extentions we want to allow to be uploaded

$allowed = array('jpg', 'png', 'txt', 'pdf');

//let's check if any of the extentions allowed are inside the $fileActualExt:
    if (in_array($fileActualExt, $allowed)) {
        //check if there hasn't been any error
        if ($fileError === 0) {
            //check if the size is correct:
            if ($fileSize < 4000000) {
                // Prevent the file names to be repeated:
                // this uniqid gives a unic id based on thereal time microseconds that the file has been uploaded
                // and we concatenate the file extention to the file name given
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                //we say where we want to upload the file, the destination. With the new name given.
                $fileDestination = 'uploads/'.$fileNameNew;
                //create a function that moves the file from the temporay location ($fileTmpName)to the location we want to 
                //be located to ($fileDestination)
                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: index.php?uploadsucess");
            }else {
                echo "Your file was too heavy";
            }

        }else {
        echo "There was an error uploading your file";
    }
    }else {
        echo "You cannot upload files of this type";
    }

}
?>