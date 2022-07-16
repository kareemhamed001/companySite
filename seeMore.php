<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pagination</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        
        <link href="CSS/all.min.css" rel="stylesheet" />
        <link href="CSS/bootstrap.css" rel="stylesheet" />
        <link href="CSS/styles.css" rel="stylesheet" />
        <link href="CSS/main.css" rel="stylesheet" />
</head>
<body>
<nav class="container-fluid p-3 navbar-dark fixed-top bg-dark  ">
    <ul class="nav  justify-content-start">
    <li class="nav-item  ">
        <a class="nav-link text-white  " href="index2.php"><i class="fa  fa-arrow-left"></i> </a>
    </li>
    
    </ul>
</nav>

<?php

require('./INCLUDES/connect.php');

$results_per_page = 5;

try{
    if (isset($_GET['projects'])) {

        $prepare=$con->prepare('SELECT * FROM projects');
        
        if($prepare->execute()){
            $number_of_results = $prepare->rowCount();
        }

        $number_of_pages = ceil($number_of_results/$results_per_page);

        $page = $_GET['projects'];
        $this_page_first_result = ($page-1)*$results_per_page;
        $sql='SELECT * FROM projects LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
        $prepare=$con->prepare($sql);
        if($prepare->execute()){
            $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        }

        $pageHeader="مشاريعنا";
        $pageBio="المشاريع التي تم تنفيذها بواسطه شركه الغريب";
        $pageName="projects";

    
    } else if (isset($_GET['services'])){

        $prepare=$con->prepare('SELECT * FROM services');
        if($prepare->execute()){
            $number_of_results = $prepare->rowCount();
        }
        
        $number_of_pages = ceil($number_of_results/$results_per_page);

        $page = $_GET['services'];
        $this_page_first_result = ($page-1)*$results_per_page;
        $sql='SELECT * FROM services LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
        $prepare=$con->prepare($sql);
        if($prepare->execute()){
            $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        }

        $pageHeader="خدماتنا";
        $pageBio="الخدمات التي تقدمها شركه الغريب للمقاولات";

        $pageName="services";

    }
}catch(Exception $E){
    echo $E->getMessage();
}

?>

        <section class="page-section   d-flex flex-column justify-content-center align-items-center">

            

            <div class="row text-center  d-flex justify-content-center">
            <?php

            if(isset($_GET['services'])||isset($_GET['projects'])){

                echo('
                <div class="container ">
                <div class="text-center">
                <h2 class="section-heading text-uppercase">'. $pageHeader.'</h2>
                <h3 class="section-subheading text-muted">'.$pageBio.'</h3>
            </div>
            </div>
                ');

            foreach($result as $row) {
                echo('
                    <div class="card col-md-4 col-lg-3 col-xl-3 p-2 border-0 rounded-3 m-1 bg-light shadow"style="height:20em;overflow:auto;">
                        <div class="container card-img-top h-60 p-0 d-flex align-items-baseline w-100">
                            <img class="img-thumbnail mh-100 w-100  border-1 border-primary  " src="./servicesImages/'.$row['image'].'" alt="">
                        </div>
                        
                        <div class="card-body mh-50">
                            <h5 class="card-title">'.$row['title'].'</h5>
                            <p class="card-text text-muted">'.$row['shortDescription'].'</p>
                        </div>
        
                    </div>
                                        ');
            }

            echo('<div class="container d-flex justify-content-center mt-5">
                <ul class="pagination">');
                        // display the links to the pages
                        for ($page=1;$page<=$number_of_pages;$page++) {
                            
                            echo('
                            <li class="page-item"><a class="page-link bg-dark"href="seeMore.php?'.$pageName.'=' . $page . '">' . $page . '</a></li>
                            ');
                        }
            echo('  </ul>
            </div>');
        }
            ?>
            </div>

            <?php


        if(isset($_GET['projectId'])){
            $id=$_GET['projectId'];
            
            try{
                $prepare=$con->prepare('select * from projects where id=?');
                $prepareImages=$con->prepare('select * from projectsImages where projectId=?');
                if($prepare->execute([$id])&&$prepareImages->execute([$id])){
                    $result=$prepare->fetch();
                    $images=$prepareImages->fetchAll(PDO::FETCH_ASSOC);
                }
            }catch(Exception $e){
                    echo $e->getMessage();
            }
        }

        if(isset($_GET['serviceId'])){
            $id=$_GET['serviceId'];
            try{
                $prepare=$con->prepare('select * from services where id=?');
                $prepareImages=$con->prepare('select * from servicesImages where serviceId=?');
                if($prepare->execute([$id])&&$prepareImages->execute([$id])){
                    $result=$prepare->fetch();
                    $images=$prepareImages->fetchAll(PDO::FETCH_ASSOC);
                }
            }catch(Exception $e){

            }
        }

        
        try{
            

                    echo('
                    <div class="container ">
                        <div class="text-center">
                            <h2 class="section-heading text-uppercase">'.$result['title'].'</h2>
                            <h3 class="section-subheading text-muted">'.$result['shortDescription'].'</h3>
                        </div>
                    </div>
                    
                    ');
                    
                    if(count($images)>0){
                        echo('
                        <div id="carouselExampleIndicators" class="carousel slide w-65 rounded-3 " data-bs-ride="carousel">
                            <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        ');
                        for($i=1;$i<=count($images);$i++){
                            echo('
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'.$i .'" class="" aria-current="true" aria-label="Slide ' . $i+1 .'"></button>
                            ');
                        }
                        
                        echo('
                        </div>
                        <div class="carousel-inner">
                        <div class="carousel-item active">
                                    <img src="./servicesImages/'.$result['image'].'" class="d-block w-100 rounded-3" alt="...">
                                </div>
                        ');
                        foreach($images as $value){
                            echo('
                                <div class="carousel-item ">
                                    <img src="./servicesImages/'.$value['image'].'" class="d-block w-100 rounded-3" alt="...">
                                </div>
                            ');
                        }
                        echo('
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon text-bg-dark" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon text-bg-dark " aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                        ');
                    }

                    if($result){
                        echo('
                        <div class="container ">
                            <div class="text-center">
                                <h3 class=" h5 mt-3">'.$result['longDescription'].'</h3>
                            </div>
                        </div>
                        
                        ');
                    }
                

            }catch(Exception $e){

            }
        
        
        
        ?>

        </section>


        <script src="JS/jquery-3.6.0.min.js"></script>
        <script src="JS/bootstrap.js"></script>
        <script src="JS/all.min.js"></script>
        <script src="JS/scripts.js"></script>
        <script src="JS/main.js"></script>
        
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
    </body>
</html>