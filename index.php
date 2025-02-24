<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Alata&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>PHP & FORMS</title>
</head>

<body>
    <!-- This form sends the information that the user introduces and is sent 
through POST method to the server. When the user clicks submit, the user
is sent to the welcome php file and then information is displayed through echoing 
all the variables. -->
    <div class="form-container">
        <h1>Form with POST method</h1>
        <form action="welcome_post.php" method="POST">
            Name: <input type="text" name="name"><br>
            E-mail: <input type="text" name="email"><br>
            <input type="submit">
        </form>
    </div>

    <!-- This form sends the information that the user introduces and is sent 
through GET method to the server. When the user clicks submit, the user
is sent to the welcome php file and then information is displayed through echoing 
all the variables. -->
    <div class="form-container">
        <h1>Form with GET method</h1>
        <form action="welcome_get.php" method="GET">
            Name: <input type="text" name="name"><br>
            E-mail: <input type="text" name="email"><br>
            <input type="submit">
        </form>
    </div>


    <!-- This form allows the user to upload multiple files to a server, and we are 
using the POST method to send data -->
    <div class="form-container">
        <h1>Select and upload multiple files to the server</h1>
        <!--The 'multipart/form-data' value is required for uploading files in forms.-->
    
        <form action="file_upload.php" method="POST" enctype="multipart/form-data">
        <p> Select files to upload </p>    
        <input type="file" name="file[]" multiple>
            <button type="submit" name="submit">UPLOAD</button>
        </form>
    </div>
</body>

</html>