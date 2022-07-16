<?php
require("./INCLUDES/ar.php");
require("./INCLUDES/connect.php");

try{
    $selectTitlePrepare=$con->prepare('SELECT * FROM cover_title  WHERE id=1 ');
    if($selectTitlePrepare->execute()){
        $result=$selectTitlePrepare->fetch(PDO::FETCH_ASSOC);
        $title=$result['title'];
        $description=$result['description'];
        
    }
}catch(PDOException $e){

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="CSS/bootstrap.css">
    <title>Document</title>
</head>

<body>

    <header class="contact"id="contact">
        
        <nav class="social">

        <a href="https://www.facebook.com/%D9%85%D8%A4%D8%B3%D8%B3%D8%A9-%D8%A7%D9%84%D8%BA%D8%B1%D9%8A%D8%A8-%D9%84%D9%84%D9%85%D9%82%D8%A7%D9%88%D9%84%D8%A7%D8%AA-%D8%A7%D9%84%D8%B9%D9%85%D9%88%D9%85%D9%8A%D9%87-%D8%A7%D8%AD%D9%85%D8%AF-%D8%BA%D8%B1%D9%8A%D8%A8-%D8%AD%D8%B3%D9%8A%D9%86-1071498879564610/"  target="_blank"><i class="fa-brands fa-facebook"></i></a>
        <a href="mailto:info@alghariebconstruction.com" target="_blank"><i class="fa-solid fa-envelope"></i></a>
        <a href="https://api.whatsapp.com/send?phone=01100636497"  target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
        </nav>
        <div class="location"><span>السويس / الاربعين / اول السور</span><a href=""><i class="fa-solid fa-location-pin"></i></a><a href="login.php"><i class="fa-solid fa-user"></i></a></div>
    </header>

    <header class="header">
        <div class="logo"><a href="#contact"><img src="IMAGES/logo3.png" alt=""></a></div>
        <nav class="navbar">
            <a href=""><?php echo $contactUs; ?></a>
            <a href=""><?php echo $latest; ?></a>
            <a href="#aboutUs"><?php echo $us; ?></a>
            <a href="#latest"><?php echo $ourProjects; ?></a>
            <a href="#services"><?php echo $services; ?></a>
            <a href="#contact"><?php echo $main; ?></a>
        </nav>
    </header>

    <div class="cover" id="cover">
        <div class="overlay"></div>
        <h1 class="title"><?php if(isset($title)){echo $title;}?></h1>
        <h2 class="title"><?php if(isset($description)){echo $description;}?></h2>
    </div>

    <section id="services" class="services section">
        <h2>خدمات الشركه</h2>
        <div class="box-container" style="display: none;">
            <div class="box">
                <div class="image"><img src="./covers/5.jpg" alt=""></div>
                <div class="content">
                    <h3>التشييد</h3>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corrupti, fugit porro. Inventore expedita voluptatem iusto suscipit vitae aperiam alias, hic eos ullam soluta voluptates. </p>
                </div>
            </div>
            <div class="box">
                <div class="image"><img src="./covers/5.jpg" alt=""></div>
                <div class="content">
                    <h3>الصيانه والتعديل</h3>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corrupti, fugit porro. Inventore expedita voluptatem iusto suscipit vitae aperiam alias, hic eos ullam soluta voluptates. </p>
                </div>
            </div>
            <div class="box">
                <div class="image"><img src="./covers/5.jpg" alt=""></div>
                <div class="content">
                    <h3>اداره المشروعات</h3>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corrupti, fugit porro. Inventore expedita voluptatem iusto suscipit vitae aperiam alias, hic eos ullam soluta voluptates. </p>
                </div>
            </div>

    </section>

    <section id="latest" class="latest section">
        <h2>اخر المشاريع</h2>
        <div class="box-container">
            <div class="box">
                <div class="image"><img src="./IMAGES/سكن لكل المصريين.jpg" alt=""></div>
                <div class="content">
                    <h3>سكن لكل المصريين</h3>
                    <p>تنفيذ عدد ( ١٧٨ ) عمارة بالمرحلة الخامسة " سكن كل المصريين " بمساحة ٩٠ متر مربع للوحدة. ومتابعة المشاريع الجارى تنفيذها بالحى العشرين. ( بعدد ٩٨ ) بمساحة ٩٠ متر مربع للوحدة. </p>
                    <h4>الاحد|26يونيو|2022 </h4>
                </div>
            </div>
            <div class="box">
                <div class="image"><img src="./covers/5.jpg" alt=""></div>
                <div class="content">
                    <h3>اسكان اجتماعي بالعاشر من رمضان</h3>
                    <p>مشروع تنفيذ عدد ٧٩ عمارة سكنية اسكان اجتماعي بالعاشر من رمضان الحي ٣٣
                        من المشاريع المنفذة من قبل مؤسسة الغريب
                        تم التنفيذ والتسليم </p>
                    <h4>الثلاثاء|8يونيو|2022 </h4>
                </div>
            </div>
            <div class="box">
                <div class="image"><img src="./covers/5.jpg" alt=""></div>
                <div class="content">
                    <h3>العاشر من رمضان الحي ٣١ </h3>
                    <p>من المشاريع المنفذة من قبل مؤسسة الغريب 
تم تسليمها للجهة والساكن بالعاشر من رمضان الحي ٣١ </p>
<h4>السبت|8يونيو|2022 </h4>
                </div>
            </div>

    </section>
    <section id="aboutUs" class="aboutUs section">
        <h2>عن الشركه</h2>
        <h2>
            لصاحبها أ/ أحمد غريب حسين .. مقاولات عموميه فئة اولي
            تأسست عام 2001 ولدينا خبره ٢٢ عام
        </h2>

    </section>

    <script src="JS/jquery-3.6.0.min.js"></script>
    <script src="JS/bootstrap.js"></script>
    <script src="JS/main.js"></script>
</body>

</html>