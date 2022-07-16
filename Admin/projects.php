<?php
require('../INCLUDES/connect.php');
include('../INCLUDES/ar.php');

if (isset($_POST['add_project'])) {

    try {
    $prep=$con->prepare('select * from projects where title=?');
    if($prep->execute([$_POST['title']])){
        $result=$prep->rowCount();
        if($result>0){
        echo  '<script>window.alert("هذا المشروع موجوده بالفعل")</script>';
        }else{

        if (!(empty($_FILES['file']['name']))) {
            $image = $_FILES['file']['name'];
            $tmp_dir = $_FILES['file']['tmp_name'];
            $imageSize = $_FILES['file']['size'];

            $upload_dir = '../projectsImages/';
            $imgExt = strtolower(pathinfo($image, PATHINFO_EXTENSION));
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
            $picfile = $image;

            if (move_uploaded_file($tmp_dir, $upload_dir . $picfile)) {
            $prepare = $con->prepare('insert into projects (title,shortDescription,longDescription,image)values(?,?,?,?)');
            if($prepare->execute([$_POST['title'],$_POST['shortDescription'],$_POST['longDescription'],$picfile])){
                header('location:projects.php');
            }
            } else {
                $errors['image'] = 'Failed to upload';
            }
        } else {
            $errors['image'] = 'Required';
        }
        }

    }


  
  } catch (PDOException $e) {
    echo $e;
  }


}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/main.css">
  <link rel="stylesheet" href="../CSS/bootstrap.css">
  <link rel="stylesheet" href="../CSS/all.min.css">

  <title>Document</title>
</head>

<body>
  <?php
  require('../INCLUDES/header.php');
  ?>


  <section id="services" class="container  section p-5 section mt-5">
    <h2 class="row w-100 justify-content-end ">مشاريع الشركه</h2>
    <div class="row w-100 justify-content-center ">
        <?php
        try{
        $prepare=$con->prepare('select * from projects');
        if($prepare->execute()){
            $result=$prepare->fetchAll(PDO::FETCH_ASSOC);
            if(count($result)>0){
            foreach($result as $value){
                echo('
                <div class="card col-2 bg-dark p-1 m-2" >

                <img class="card-img-top" src="../projectsImages/'.$value['image'].'" alt="">

                <div class="card-body">

                    <div class="content h-75">
                    <h6 class="card-title text-white text-end">'.$value['title'].'</h6>
                    <p class="card-text text-white text-end">'.$value['shortDescription'].'</p>
                    </div>

                    <div class="d-flex justify-content-center align-items-center">
                        <button type="submit" name="edit" class="btn btn-success w-50 m-1 ">تعديل</button>
                        <button type="button"  class="btn btn-danger w-50 delete-btn-modal m-1"  data-id="'.$value['id'].'" data-name="'.$value['imageName'].'" data-bs-toggle="modal" data-bs-target="#myModal" onclick="delete_modal(event)">حذف</button>

                    </div>
                        
                </div>
                

            </div>
                ');
            }
            }
        }

        }catch(PDOException $e){

    }
    ?>
    </div>
</section>

<section class="container add-project section p-5 ">

    <h2 class="row w-100 justify-content-end ">اضافه مشروع</h2>

    <div class="row w-100 justify-content-center ">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="card bg-dark p-lg-5 p-sm-2 m-3 d-flex flex-column align-items-center justify-content-center " style="width:400px" enctype="multipart/form-data">

                <img src="" alt="" class="card-img-top">

                <div class="card-body d-flex flex-column align-items-center w-100 p-0" >

                    <div class="mt-3 mb-3 w-100 d-flex justify-content-center align-items-center">
                        <label for="service-image" class="btn btn-primary " id="add-image"><i class="fa fa-plus"></i></label>
                        <span class="text-white">اضف صوره المشروع</span>
                        <input class="form-control"type="file" name="file" style="display: none;" id="service-image" onchange="preview(event)">
                    </div>

                    <label class="form-label d-block text-end " for="service-title ">عنوان للمشروع</label>
                    <input class="form-control mb-3" type="text" id="service-title" name="title">

                    <label class="form-label d-block text-end" for="service-short-description"> وصف موجز للمشروع</label>
                    <input  class="form-control mb-3" type="text" id="service-short-description" name="shortDescription">

                    <label class="form-label d-block text-end" for="service-long-description">وصف كامل للمشروع</label>
                    <input class="form-control mb-3" type="text" id="service-long-description" name="longDescription">
                
                    <button type="text" class="btn btn-primary  " name="add_project" >اضافه مشرع</button>

                </div>

        </form>
    </div>

    <?php include("../INCLUDES/modal.php")?>
    
    </section>
    <script type="text/javascript">
    function preview(event) {
        var image = URL.createObjectURL(event.target.files[0]);
        var img = document.querySelector('.add-project img');
        img.src = image;
    }
    </script>
    <script type="text/javascript" src="../JS/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../JS/main.js"></script>
    <script type="text/javascript" src="../JS/bootstrap.js"></script>
</body>

</html>

<?php 

if(isset($_GET['delete'])){

try{
    $prepareDelete=$con->prepare("DELETE FROM projects WHERE id=?");
    if($prepareDelete->execute([$_GET['id']])){
        unlink('../projectsImages/'.$_GET['name'].'');
        header('location:projects.php');
    }

}catch(PDOException $e){
    echo $e;
}
}
?>