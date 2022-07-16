
if(document.URL.indexOf("cover.php")!=-1){
    
    var folder = "../covers/";
}else{
    
    var folder = "covers/";
}


let imgs = [];
$.ajax({
    url : folder,
    success: function (data) {
        
        $(data).find("a").attr("href", function (i, val) {
            if( val.match(/\.(jpe?g|png|gif)$/) ) { 
                // $("body").append( "<img src='"+ folder + val +"'>" );
                imgs.push(val);
            } 
        });
    }
});
//selcet landing page and array of images

let landingPage = document.querySelector(".cover");

//change backimage after 4s
setInterval(() => {
    let randomNumber = Math.floor(Math.random() * imgs.length);
    if(imgs.length>0){
        landingPage.style.backgroundImage =
        'url("'+folder+'' + imgs[randomNumber] + '")';
    }

    
}, 4000);


    window.onscroll=function(){
        if(window.scrollY>=340 || window.scrollY<=965){
            
            $(".services .box-container").fadeIn(1000);
        }else if(window.scrollY<340 || window.scrollY>965)
            {
                
                $(".services .box-container").fadeOut(1000);
        }
    }

    function delete_modal (event) {
        let id=event.target.dataset['id'];
        let name=event.target.dataset['name'];
        
        $("#cover-id").val(id);
        $("#cover-name").val(name);
        
    }

    var latestFolder="covers/";
    let latestImages = [];
$.ajax({
    url : latestFolder,
    success: function (data) {
        
        $(data).find("a").attr("href", function (i, val) {
            if( val.match(/\.(jpe?g|png|gif)$/) ) { 
                // $("body").append( "<img src='"+ folder + val +"'>" );
                latestImages.push(val);
            } 
        });
    }
});


i=0;

$(".next").on("click",function(){
    
    if(i>=latestImages.length-1){
        i=0;
        
    }else{
        ++i;
        
    }
    
    $(".news-images").attr("src","covers/"+latestImages[i]);
})

$(".previous").on("click",function(){
    
    if(i<=0){
        i=latestImages.length-1;

    }else{
        --i;
        
    }
    $(".news-images").attr("src","covers/"+latestImages[i]);
})

// function getNews(){
//     $.ajax({

//         method: "POST",
//         url: "INCLUDES/latest.php",
//         data:{getNews:""},
//         success:function(responce,status){
//             responce=JSON.parse( responce)
//             console.log(responce);
//         },
    
//     })
// }

// getNews();












