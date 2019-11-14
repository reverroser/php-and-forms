<?php
if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

$fileName = $_FILES['file']['name'];
$fileTmpName = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$fileError = $_FILES['file']['error'];
$fileType = $_FILES['file']['type'];

for ($i=0; $i < sizeof($_FILES); $i++) {
    // CHECK THE FORMAT OF THE FILES:
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
                //CHECK IF THE SIZE IS CORRECT:
                if ($fileSize < 4*1024*1024) {
                    // Create a new directory with the date of today
                    $dateFile = date("d-m-Y"."/");
                    $directoryStorage = "uploads/".$dateFile;
                    $finalDirectory = $directoryStorage.$fileName;
                    // Check if it doesn't exists, then create one or it already exists, then save files there.
                    if(!file_exists($finalDirectory)) {
                        mkdir('uploads/'.date("d-m-Y"),0777);
                    }else{
                     move_uploaded_file($fileTmpName,$finalDirectory);
                    }
                    //create a function that moves the file from the temporay location ($fileTmpName)to the location we want to 

                    //be located to ($fileDestination)
                    header("Location: index.php?uploadsucess");
                }else {
                    echo "Your file was too heavy";
                }

            }else {
            echo "There was an error uploading your file.";
            }
        }else {
                    echo "You cannot upload files of this type";
            }
        }
};
?>