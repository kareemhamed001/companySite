<?php
require('../INCLUDES/connect.php');
include('../INCLUDES/ar.php');

if (isset($_POST['add_service'])) {

  try {

    

    $prep=$con->prepare('select * from services where title=?');
    if($prep->execute([$_POST['title']])){
      $result=$prep->rowCount();
      if($result>0){
        echo  '<script>window.alert("هذه الخدمه موجوده بالفعل")</script>';
      }else{

    $targetDir = "../servicesImages/"; 
    $allowTypes = array('jpg','png','jpeg','gif'); 

    $statusMsg = $errorMsg  = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['file']['name']); 

    //add service cover
    if (!(empty($_FILES['cover']['name']))) {
      $image = $_FILES['cover']['name'];
      $tmp_dir = $_FILES['cover']['tmp_name'];
      $imageSize = $_FILES['cover']['size'];

      $upload_dir = '../servicesImages/';
      $imgExt = strtolower(pathinfo($image, PATHINFO_EXTENSION));
      $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
      $picfile = $image;

      if (move_uploaded_file($tmp_dir, $upload_dir . $picfile)) {
          try{
            
              $prepare = $con->prepare('insert into services (title,shortDescription,longDescription,image,date)values(?,?,?,?,now())');
              if($prepare->execute([$_POST['title'],$_POST['shortDescription'],$_POST['longDescription'],$picfile])){
                  $id=$con->lastInsertId();
                  header('location:services.php');
              }
          }catch(PDOException $e){

          }
      } else {
          $errors['image'] = 'Failed to upload';
      }
  } else {
      $errors['image'] = 'Required';
  }

  //add service images
    if(!empty($fileNames)){ 
            $numbberOfSelectedImages=count($_FILES['file']['name'] );
      
            if($id){
            foreach($_FILES['file']['name'] as $key=>$val){ 
            
              $fileName = basename($_FILES['file']['name'][$key]); 
              $targetFilePath = $targetDir . $fileName; 
  
              
              $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
              if(in_array($fileType, $allowTypes)){ 
                  
                  if(move_uploaded_file($_FILES["file"]["tmp_name"][$key], $targetFilePath)){ 
                      
                    
                        $insert = $con->prepare("INSERT INTO servicesImages (image,serviceId) VALUES (?,?)"); 
                        if($insert->execute([$fileName,$id])){ 
                            $statusMsg = "Files are uploaded successfully.".$errorMsg; 

                            echo('
                            <script>window.alert("Sorry, there was an error uploading your file.)</script>
                            ');
                        }else{ 
                            $statusMsg = "Sorry, there was an error uploading your file."; 
                        } 
                
                  }else{ 
                      $errorUpload .= $_FILES['file']['name'][$key].' | '; 
                  } 
              }else{ 
                  $errorUploadType .= $_FILES['file']['name'][$key].' | '; 
              } 
          } 
          }else{
            $error="error insert images";
          }
        
    }else{ 
        $statusMsg = 'Please select a file to upload.'; 
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

  <section class="page-section bg-dark container position-relative p-5  mt-5"  id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">خدماتنا</h2>
                    <h3 class="section-subheading text-muted">الخدمات التي تقدمها شركه الغريب للمقاولات</h3>
                </div>
                <div class="row text-center d-flex justify-content-center">

                <?php 
                try{
                    $prepare=$con->prepare("select *  from  services");
                    if($prepare->execute( )){
                        $result=$prepare->fetchAll(PDO::FETCH_ASSOC);
                        
                        foreach($result as $value){
                          
                          
                            echo('
                            


                            <div class="col-lg-3 col-sm-6 mb-4 ">
                                                <div class="portfolio-item card" style="height:23em;overflow:auto">
                                                    <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal">
                                                  
                                                        <img class=" card-img-top img-thumbnail  h-100" src="../servicesImages/'.$value['image'].'" alt="">
                                                    </a>
                                                    <div class="portfolio-caption">
                                                        <div class="h6">'.$value['title'].'</div>
                                                        <div class="portfolio-caption-subheading text-muted">'.$value['shortDescription'].'</div>
                                                    </div>

                                                    <div class="d-flex justify-content-center align-items-center p-1">
                                                    <button type="submit" name="edit" class="btn btn-success m-1">تعديل</button>
                                                    <button type="button"  class="btn btn-danger delete-btn-modal"  data-id="'.$value['id'].'"  data-name="'.$value['image'].'"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="delete_modal(event)">حذف</button>
                                              
                                                    </div>
                                                    
                                                </div>
                                        </div>
                            ');
                        }
                    }

                }catch(PDOException $e){
                    echo $e;
                }
                
                ?>

                    
                    
                </div>
            </div>
        </section>


  <section class="container add-service section p-5 ">

    <h2 class="row w-100 justify-content-end ">اضافه خدمه</h2>

    <div class="row w-100 justify-content-center ">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="card bg-dark p-lg-5 p-sm-2 m-3 d-flex flex-column align-items-center justify-content-center " style="width:400px" enctype="multipart/form-data">

                <img src="" alt="" class="card-img-top">

                <div class="card-body d-flex flex-column align-items-center w-100 p-0" >

                  <div class="mt-3 mb-3 w-100 d-flex justify-content-center align-items-center">
                    <label for="service-cover" class="btn btn-primary " id="add-image"><i class="fa fa-plus"></i></label>
                    <span class="text-white">اضف غلاف الخدمه</span>
                    <input class="form-control"type="file" name="cover" style="display: none;" id="service-cover" onchange="preview()" >
                  </div>

                  <div class="mt-3 mb-3 w-100 d-flex justify-content-center align-items-center">
                    <label for="service-image" class="btn btn-primary " id="add-image"><i class="fa fa-plus"></i></label>
                    <span class="text-white">اضف صوره الخدمه <?php echo $numbberOfSelectedImages?></span>
                    <input class="form-control"type="file" name="file[]" style="display: none;" id="service-image"  multiple>
                  </div>

                    <label class="form-label d-block text-end " for="service-title ">عنوان الخدمه</label>
                    <input class="form-control mb-3" type="text" id="service-title" name="title">
                  
                    <label class="form-label d-block text-end" for="service-short-description">وصف موجز</label>
                    <input  class="form-control mb-3" type="text" id="service-short-description" name="shortDescription">
                  
                    <label class="form-label d-block text-end" for="service-long-description">وصف كامل للخدمه</label>
                    <input class="form-control mb-3" type="text" id="service-long-description" name="longDescription">
                  
                  <button type="text" class="btn btn-primary  " name="add_service" >اضافه الخدمه</button>

                </div>

        </form>
    </div>

    <?php include("../INCLUDES/modal.php")?>
    
  </section>

  <script type="text/javascript" src="../JS/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="../JS/main.js"></script>
  <script type="text/javascript" src="../JS/bootstrap.js"></script>
  <script type="text/javascript">

    

    function preview() {
      var image = URL.createObjectURL(event.target.files[0]);
      var img = document.querySelector('.add-service img');
      img.src = image;
    }
  </script>
  
</body>

</html>

<?php 

if(isset($_GET['delete'])){
  $id=$_GET['id'];
  $coverImageName=$_GET['name'];
  
  try{
      $prepareDelete=$con->prepare("DELETE FROM services WHERE id=?");
      $prepareSelectImage=$con->prepare("select * FROM servicesImages WHERE serviceId=?");
      $prepareDeleteImage=$con->prepare("DELETE FROM servicesImages WHERE serviceId=?");
      $prepareSelectImage->execute([$id]);
      $result=$prepareSelectImage->fetchAll(PDO::FETCH_ASSOC);
      if($prepareDelete->execute([$id])&&$prepareDeleteImage->execute([$id])){
        unlink('../servicesImages/'.$coverImageName.'');
        foreach($result as $value){
          print_r($result);
          unlink('../servicesImages/'.$value['image'].'');
        }
          header('location:services.php');
      }

  }catch(PDOException $e){
    echo $e;
  }
}
?>