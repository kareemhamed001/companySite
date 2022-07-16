<?php
    require('../INCLUDES/connect.php');
    include('../INCLUDES/ar.php');
    try{

        if(isset($_POST['submit'])){
            
            $updateTitlePrepare=$con->prepare('update cover_title set title=? , description=? where id=1');
            if($updateTitlePrepare->execute([$_POST['title'],$_POST['description']])){
                
            }
        }

        $selectTitlePrepare=$con->prepare('SELECT * FROM cover_title  WHERE id=1 ');
        if($selectTitlePrepare->execute()){
            $result=$selectTitlePrepare->fetch(PDO::FETCH_ASSOC);
            $title=$result['title'];
            $description=$result['description'];
            
        }

        $selectImagesPrepare=$con->prepare('SELECT * FROM cover_images');
        if($selectImagesPrepare->execute()){
            $images=$selectImagesPrepare->fetchAll(PDO::FETCH_ASSOC);
        }

        if(isset($_POST['uploadImage'])){
            
            if (!(empty($_FILES['file']['name']))) {
                $image = $_FILES['file']['name'];
                $tmp_dir = $_FILES['file']['tmp_name'];
                $imageSize = $_FILES['file']['size'];
        
                $upload_dir = '../covers/';
                $imgExt = strtolower(pathinfo($image, PATHINFO_EXTENSION));
                $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
                $picfile = $image;
        
                if (move_uploaded_file($tmp_dir, $upload_dir . $picfile)) {
                    try{
                        $prepare=$con->prepare('insert into cover_images (imageName,date) values(?,now())');

                        if($prepare->execute([$picfile])){
                            header('location:cover.php');
                        }
                    }catch(PDOException $e){

                    }
                } else {
                    $errors['image'] = 'Failed to upload';
                }
            } else {
                $errors['image'] = 'Required';
            }
        }

        if(isset($_GET['delete'])){
            try{
                $prepareDelete=$con->prepare("DELETE FROM cover_images WHERE id=?");
                if($prepareDelete->execute([$_GET['id']])){
                    unlink('../covers/'.$_GET['name'].'');
                    header('location:cover.php');
                }

            }catch(PDOException $e){

            }
        }




    }catch(PDOException $e){
        echo $e;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/bootstrap.css">
    <link rel="stylesheet" href="../CSS/main.css">
    <link rel="stylesheet" href="../CSS/all.min.css">
    <title>Document</title>
</head>
<body>
    
<?php 
require('../INCLUDES/header.php');
?>

    <div class="container cover bg-image" id="cover">
        <div class="overlay"></div>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="card bg-dark p-3">
            <input class="form-control" type="text" name="title" value="<?php if(isset($title)){echo $title;}?>">
            <input class="form-control mt-3 mb-3" type="text" name="description" value="<?php if(isset($description)){echo $description;}?>" >
            <button type="submit" name="submit" class="btn btn-primary">تغيير</button>
        </form>
        <!-- <h1 class="title">شركه الغريب للمقاولات</h1>
        <h2 class="title">نبني من اجل مستقبل افضل</h2> -->
    </div>

    <section class="section cover-images container  p-5">
        <h2 class=" row w-100 justify-content-end ">صور الغلاف </h2>

        <div class="row w-100 justify-content-center ">

        <?php
                foreach($images as $value){
                    
                    echo ('
                    <div class="card bg-dark p-1 m-2 mh-100" style="width:30em;height:25em">
                    <div class="container-fluid h-75 p-0">
                    <img class="card-img-top mh-100" src="../covers/'.$value['imageName'].'" alt="">
                    </div>
                    
                    <div class="card-body ">
                        
                            <button type="button"  class="btn btn-danger delete-btn-modal"  data-id="'.$value['id'].'" data-name="'.$value['imageName'].'" data-bs-toggle="modal" data-bs-target="#myModal" onclick="delete_modal(event)">حذف</button>
                    </div>
                    
                </div>
                    
                    ');
                }

            
        ?>
        </div>

    </section>
    <section class="section add-cover container p-5 d-flex flex-column justify-content-baseline align-items-center" > 
    
    <h2 class=" row w-100 justify-content-end ">اضف صوره غلاف</h2>
    
    <form class="card  p-3 bg-dark" style="width:20em ;" action="<?php $_SERVER['PHP_SELF']?>" method="post"  enctype="multipart/form-data">

        <img src="" alt="" class="card-img-top">

        <div class="card-body d-flex flex-column align-items-center w-100 p-0" >

            <div class="mt-3 mb-3 w-100 d-flex justify-content-center align-items-center">
                <label for="service-image" class="btn btn-primary " id="add-image"><i class="fa fa-plus"></i></label>
                <span class="text-white">اضف صوره غلاف</span>
                <input class="form-control"type="file" name="file" style="display: none;" id="service-image" onchange="preview(event)">
            </div>
        </div>

        <button class="btn btn-primary" type="submit" name="uploadImage" multiple>Upload</button>
    </form>

    <?php include("../INCLUDES/modal.php")?>

    </section>
    <script src="../JS/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        
        function preview(event) {
            var image = URL.createObjectURL(event.target.files[0]);
            var img = document.querySelector('.add-cover img');
            img.src = image;
        }

      
    </script>

    
    <script src="../JS/main.js"></script>
    
    <script type="text/javascript" src="../JS/bootstrap.js"></script>
</body>
</html>

