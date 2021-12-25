<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/ckeditor.js"></script>
</head>

<body>
    <textarea name="profile" id="profile" cols="30" rows="10"></textarea>



    <script>
    ClassicEditor
        .create(document.querySelector('#profile'), {
            ckfinder: {
                uploadUrl: 'ckupload.php'
            }
        })
        .catch(error => {
            console.error(error);
        });
    </script>
</body>

</html>