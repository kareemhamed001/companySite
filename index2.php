
<?php 
require("./INCLUDES/ar.php");
require("./INCLUDES/connect.php");

require("./INCLUDES/ar.php");
require("./INCLUDES/connect.php");


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Agency - Start Bootstrap Theme</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        
        <link href="CSS/all.min.css" rel="stylesheet" />
        <link href="CSS/bootstrap.css" rel="stylesheet" />
        <link href="CSS/styles.css" rel="stylesheet" />
        <link href="CSS/main.css" rel="stylesheet" />
    </head>
    <body id="page-top">


        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top">Algharieb</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
                        <li class="nav-item"><a class="nav-link" href="#latest-news">Latest</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead cover position-relative">
            <div class="overlay position-absolute top-0"></div>
            <div class="container"style="z-index:2;">
                <div class="masthead-subheading">Welcome To Our Studio!</div>
                <div class="masthead-heading text-uppercase">It's Nice To Meet You</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#services">Tell Me More</a>
            </div>
        </header>
        <!-- Services-->
        <section class="page-section position-relative"  id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">خدماتنا</h2>
                    <h3 class="section-subheading text-muted">الخدمات التي تقدمها شركه الغريب للمقاولات</h3>
                </div>
                <a class="btn btn-primary position-absolute top-25 end-0 me-5"   href="seeMore.php?services=1">المزيد</a>
                <div class="row text-center d-flex justify-content-center">



                <?php 
                try{
                    $prepare=$con->prepare("select * from services LIMIT 0,5");
                    if($prepare->execute( )){
                        $result=$prepare->fetchAll(PDO::FETCH_ASSOC);
                        foreach($result as $value){
                            echo('


                            <div class="card col-lg-2 border-0 col-sm-6 mb-4 p-1"data-id='.$value['id'].' style="height:25em;" onclick="openCard()">
                                                
                                                    <img class=" card-img-top img-thumbnail rounded-circle  mh-70" src="./servicesImages/'.$value['image'].'" alt="" data-id='.$value['id'].'>
                                                    <div class="card-body" data-id='.$value['id'].'>
                                                        <div class="h6" data-id='.$value['id'].'>'.$value['title'].'</div>
                                                        <div class="portfolio-caption-subheading text-muted" data-id='.$value['id'].'>'.$value['shortDescription'].'</div>
                                                    </div>
                                                
                                        </div>


                            ');
                        }
                    }

                }catch(PDOException $e){

                }
                
                ?>

                    
                    
                </div>
            </div>
        </section>
        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">مشاريعنا</h2>
                    <h3 class="section-subheading text-muted">اخر مشاريع الشركه</h3>
                </div>

                <a class="btn btn-primary position-absolute top-25 end-0 me-5"   href="seeMore.php?projects=1">المزيد</a>

                <div class="row d-flex justify-content-center">
                    

                        <?php  
                            try{
                                $selectProjects=$con->prepare('SELECT * FROM projects ');
                                if($selectProjects->execute()){
                                    $result=$selectProjects->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($result as $value){
                                        
                                        echo('
                                        <div class="col-lg-3 col-sm-6 mb-4 shadow-sm" data-id='.$value['id'].'onclick="openCard()><!-- Portfolio item 1-->
                                                <div class="portfolio-item">
                                                    <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal">
                                                        <div class="portfolio-hover" data-id="'.$value['id'].'" data-image="'.$value['image'].'" data-title="'.$value['title'].'" data-shortBio="'.$value['shortDescription'].'" data-longBio="'.$value['longDescription'].'"  onclick="show_project(event)" >
                                    
                                                        </div>
                                                        <img class="img-fluid rounded" src="projectsImages/'.$value['image'].'" alt="..." />
                                                    </a>
                                                    <div class="portfolio-caption">
                                                        <div class="portfolio-caption-heading">'.$value['title'].'</div>
                                                        <div class="portfolio-caption-subheading text-muted">'.$value['shortDescription'].'</div>
                                                    </div>
                                                </div>
                                        </div>
                                        ');
                                    }
                                    
                                }
                            }catch(PDOException $e){
                            
                            }
                        ?>

                </div>
            </div>
        </section>
        <!-- About-->
        <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">عن الشركه</h2>
                    <h3 class="section-subheading text-muted">تاريخ تاسيس الشركه</h3>
                </div>
                <ul class="timeline">
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/1.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2000-2001</h4>
                                <h4 class="subheading">بدايه تأسيس الشركه</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">تم تأسيس الشركه علي يد أ.م:احمد غريب حسين</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/2.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>March 2011</h4>
                                <h4 class="subheading">An Agency is Born</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/3.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>December 2015</h4>
                                <h4 class="subheading">Transition to Full Service</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/4.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>July 2020</h4>
                                <h4 class="subheading">Phase Two Expansion</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>
                                Be Part
                                <br />
                                Of Our
                                <br />
                                Story!
                            </h4>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <!-- Team-->
        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">افراد العائله</h2>
                    <h3 class="section-subheading text-muted">عائله الغريب</h3>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/mahmoud.jpg" alt="..." />
                            <h4 class="text-uppercase">mahmoud gharieb</h4>
                            <p class="text-muted"> الاخ الاول</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/ahmed.jpg" alt="..." />
                            <h4 class="text-uppercase">ahmed gharieb</h4>
                            <p class="text-muted">الاخ الثاني </p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Diana Petersen Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Diana Petersen Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Diana Petersen LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/sayed.jpg" alt="..." />
                            <h4 class="text-uppercase">sayed gharieb</h4>
                            <p class="text-muted">الاخ الثالث</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/ibrahim.jpg" alt="..." />
                            <h4 class="text-uppercase">ibrahim gharieb</h4>
                            <p class="text-muted">الاخ الرابع</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center"><p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p></div>
                </div>
            </div>
        </section>

        <!-- latest -->

        <section class=" container bg-white " style="height: 100vh;width:100vw;" id="latest-news">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">اخر الاخبار</h2>
                <p class="section-subheading text-muted">اخر الاخبار عن شركه الغريب </p>
            </div>

            <div class="container w-100  h-75 p-0  rounded d-flex justify-content-center position-relative align-items-center">
                <button class="position-absolute start-0 top-50 previous p-1  bg-dark text-white rounded" style="cursor: pointer;margin:0 ;z-index:2;transform:translate(50%,-50%)"><i class="fa-solid fa-angle-left " style="font-size:2em;"></i></button>
                <!-- <img src="./covers/6.jpg" alt=""> -->
                
                <p class="position-absolute top-90 latest-text m-5 text-white  h6 lh-1 w-100 h-100 overflow-auto bg-black bg-opacity-25 rounded p-3 "style="z-index:2;word-break: break-all;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi distinctio quisquam neque natus molestiae fugit cupiditate omnis labore, saepe, accusantium nihil ullam odio numquam inventore sit, ipsum tempora assumenda laboriosam!</p>
                
                <div class="overlay h-100 w-100 rounded"></div>
                <img src="" alt="" class="news-images rounded-2 mw-100 h-100   ">

                <button class="position-absolute end-0 top-50 next p-1 bg-dark text-white rounded" style="cursor: pointer;margin:0 ; z-index:2;transform:translate(-50%,-50%)"><i class="fa-solid fa-angle-right" style="font-size:2em;"></i></button>
            </div>

        </section>

        <!-- Clients-->
        <div class="py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/microsoft.svg" alt="..." aria-label="Microsoft Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/google.svg" alt="..." aria-label="Google Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/facebook.svg" alt="..." aria-label="Facebook Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/ibm.svg" alt="..." aria-label="IBM Logo" /></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Contact Us</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <!-- * * * * * * * * * * * * * * *-->
                <!-- * * SB Forms Contact Form * *-->
                <!-- * * * * * * * * * * * * * * *-->
                <!-- This form is pre-integrated with SB Forms.-->
                <!-- To make this form functional, sign up at-->
                <!-- https://startbootstrap.com/solution/contact-forms-->
                <!-- to get an API token!-->
                <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <!-- Name input-->
                                <input class="form-control" id="name" type="text" placeholder="Your Name *" data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <div class="form-group">
                                <!-- Email address input-->
                                <input class="form-control" id="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" />
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <div class="form-group mb-md-0">
                                <!-- Phone number input-->
                                <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <!-- Message input-->
                                <textarea class="form-control" id="message" placeholder="Your Message *" data-sb-validations="required"></textarea>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                        </div>
                    </div>
                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center text-white mb-3">
                            <div class="fw-bolder">Form submission successful!</div>
                            To activate this form, sign up at
                            <br />
                            <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                        </div>
                    </div>
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                    <!-- Submit Button-->
                    <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase disabled" id="submitButton" type="submit">Send Message</button></div>
                </form>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy; Your Website 2022</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                        <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Portfolio Modals-->
        <!-- Portfolio item 1 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 id="project-title-modal" class="text-uppercase"></h2>
                                    <p id="project-shortbio-modal" class="item-intro text-muted"></p>
                                    <img id="project-image-modal" class="img-fluid d-block mx-auto" src="" alt="..." />
                                    <p id="project-longbio-modal"></p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong></strong>
                                            
                                        </li>
                                        <li>
                                            <strong></strong>
                                            
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        اغلاق
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="JS/jquery-3.6.0.min.js"></script>
        <script src="JS/bootstrap.js"></script>
        <script src="JS/all.min.js"></script>
        <script src="JS/scripts.js"></script>
        <script src="JS/main.js"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script> -->

        <script>
            function show_project(event){
                
                let id=event.target.dataset['id'];
                let image=event.target.dataset['image'];
                let title=event.target.dataset['title'];
                let shortBio=event.target.dataset['shortbio'];
                let longBio=event.target.dataset['longbio'];


                $("#project-image-modal").attr("src","projectsImages/"+image);
                $("#project-title-modal").html(title);
                $("#project-shortbio-modal").html(shortBio);
                $("#project-longbio-modal").html(longBio);

            }

            // $.ajax({

            //         method: "POST",
            //         url: "INCLUDES/latest.php",
            //         data:{getNews:""},
            //         success:function(responce,status){
            //             responce=responce.Json.parese(responce);
            //             console.log(responce);
            //         },

            //     })

            function openCard() { 
                console.log(event.target.dataset['id']);
                window.open("./seeMore.php?serviceId="+event.target.dataset['id']);
            }
        </script>
        
        
    

        
    </body>
</html>
