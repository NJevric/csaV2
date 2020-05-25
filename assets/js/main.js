window.onload=function(){
    var url=location.href;

    (function(){
        $("#hamburger").click(function(){
            $(".navigacija").toggle();
        
        $(".ham").toggleClass("hamClick");
        
        });
       
    })();
    
    (function(){
        $("#hamburgerTelefon").click(function(){
            $(".navigacijaTelefon").toggle();
        
        $(".hamTelefon").toggleClass("hamClick");
        });
    })();
    
        $(".loader-wrapper").fadeOut(1600);
        // $(".loader-wrapper .rotate").fadeOut(1500);
        // $("nav").animate({opacity:'1'},2500);
        $(".naslov").animate({opacity:'1'},2000);
        $("#home_text").animate({opacity:'1'},2300);
        

    // DODAJE KLASE ZA PRIKAZ RAZLICITIH BACKGROUND SLIKA U ODNOSU NA STRANICU
    this.console.log("windiw location is " + window.location.href); //provera koja je stranica

    removeClassHome = () => {
        return this.document.getElementById("home_background").classList.remove("home");
    }
     
     if(window.location.href == "http://localhost/csa-beta/index.php"){
        this.console.log("proba");
    }
     if(window.location.href == "http://localhost/csa-beta/index.php?page=services"){
        removeClassHome();
         this.document.getElementById("home_background").classList.add("services");
     }
     if(window.location.href == "http://localhost/csa-beta/index.php?page=clients"){
        removeClassHome();
         this.document.getElementById("home_background").classList.add("clients");
     }
     if(window.location.href == "http://localhost/csa-beta/index.php?page=news"){
        removeClassHome();
         this.document.getElementById("home_background").classList.add("news");
     }
     if(window.location.href == "http://localhost/csa-beta/index.php?page=contact"){
        removeClassHome();
         this.document.getElementById("home_background").classList.add("contact");
     }


    // CLIENTS
    if(url.indexOf("page=clients")!=-1){

        ajaxClients = (callbackSuccess) =>{
          $.ajax({
            url:"models/clients/clientsSelect.php",
            method:"get",
            dataType:"json",
            success:callbackSuccess,
            error:function(xhr){
                console.log(xhr);
            }
          });
        } 

        (function(){
            ajaxClients(
                function(data){
                clientsAll(data);
                }
            );
        })();

        clientsAll = (client) => {
            let ispis='';    
            client.forEach(i => {
                ispis+=singleClient(i);
            });
            document.getElementById("clients").innerHTML=ispis;
        }
        
        singleClient = (i) => {
            return `
            <div class="client col-md-3 col-6 text-center">
            <img class="" src="${i.src}" alt="<?= $i->alt ?>">
            <h4 class="mt-3 mb-4 text-center">${i.name + " " + i.last_name}</h4>
            <a href="index.php?page=player&id=${i.id_client}" class="clientBtn mt-3">INFO</a>
                      
            
            
        </div>`
        }    
     
    }
    
    // NEWS
    if(url.indexOf("page=news")!=-1){

        ajaxNews = (callbackSuccess) => {
            $.ajax({
                url:"models/news/newsSelect.php",
                method:"get",
                dataType:"json",
                success:callbackSuccess,
                error:function(xhr){
                    console.log(xhr);
                }
            });
        }
        
        (function(){
            ajaxNews(
                function(data){
                    newsAll(data);
                }
            );
        })();

        newsAll = (news) => {
            let ispis = "";
            news.forEach(i => {
                ispis+=singleNews();
            });
            document.getElementById("vesti").innerHTML=ispis;
        }

        singleNews = (i) => {
            return `<div class="vest col-lg-5 col-md-5">
            <h4 class="mb-3">Trio of CSA Athletes Sign Rookie Deals in Europe</h4>
            <p class="newsDatum mb-3">SEPTEMBER 13, 2019</p>
            <p class="newsTekst mb-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Alias, asperiores fugit adipisci ad inventore expedita natus laboriosam impedit nemo, nobis exercitationem ipsum?</p>
            <a href="#" class="newsBtn mt-4">READ MORE</a>
        </div>`;
        }
    }

    // CONTACT
    if(url.indexOf("page=contact")!=-1){

    }

    // $(function() {

    //     $("#clients").mousewheel(function(event, delta) {
     
    //        this.scrollLeft -= (delta * 30);
         
    //        event.preventDefault();
     
    //     });
     
    //  });

    //  $('#clients').bind('mousewheel', function(event,delta){
    //     if(e.originalEvent.wheelDelta /120 > 0) {
    //         console.log('scrolling up !');
    //         this.scrollLeft -= (delta * 30);
    //         event.preventDefault();
    //     }
    //     else{
    //         console.log('scrolling down !');
    //     }
    // });
  


// const projectList = document.querySelector('#clients');
// let isDown = false;
// let startX;
// let scrollLeft;

// projectList.addEventListener('wheel', (e)=>{
//     if(e.deltaY<0){
// 	isDown = true;
//     	projectList.classList.add('active');
//     	startX = e.pageX - projectList.offsetLeft;
//     	scrollLeft = projectList.scrollLeft;
//     	projectList.classList.add('active');
// 	}else{
// isDown = false;
//     projectList.classList.remove('active');
// }
// });


// projectList.addEventListener('mouseup', ()=>{
//     isDown = false;
//     projectList.classList.remove('active');
// });

// projectList.addEventListener('mousemove', (e)=>{
//     if ( !isDown ) return; // stop the function from running
//     e.preventDefault();
//     const x = e.pageX - projectList.offsetLeft;
//     const walk = x - startX;
//     projectList.scrollLeft = scrollLeft - walk;
// });










// $(document).ready(function(){
//     $('#clients').hScroll();
// });
// $.fn.hScroll = function( options )
//  {
//    function scroll( obj, e )
//    {
//      var evt = e.originalEvent;
//      var direction = evt.detail ? evt.detail * (-400) : evt.wheelDelta;

//      if( direction > 0)
//      {
//         direction =  $(obj).scrollLeft() - 400;
//      }
//      else
//      {
//         direction = $(obj).scrollLeft() + 400;
//      }

//      $(obj).scrollLeft( direction );

//      e.preventDefault();
//    }

//    $(this).width( $(this).find('div').width("900px") );

//    $(this).bind('DOMMouseScroll mousewheel', function( e )
//    {
//     scroll( this, e );
//    });
// }





// (function() {
//     function scrollHorizontally(e) {
//         e = window.event || e;
//         var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
//         document.getElementById('clients').scrollLeft -= (delta*700); // Multiplied by 40
//         e.preventDefault();
//     }
//     if (document.getElementById('clients').addEventListener) {
//         // IE9, Chrome, Safari, Opera
//         document.getElementById('clients').addEventListener("mousewheel", scrollHorizontally, false);
//         // Firefox
//         document.getElementById('clients').addEventListener("DOMMouseScroll", scrollHorizontally, false);
//     } else {
//         // IE 6/7/8
//         document.getElementById('clients').attachEvent("onmousewheel", scrollHorizontally);
//     }
// })();


// const projectList = document.querySelector('#clients');
// let isDown = false;
// let startX;
// let scrollLeft;

// projectList.addEventListener('mousedown', (e)=>{
//     isDown = true;
//     projectList.classList.add('active');
//     startX = e.pageX - projectList.offsetLeft;
//     scrollLeft = projectList.scrollLeft;
//     projectList.classList.add('active');
// });

// projectList.addEventListener('mouseleave', ()=>{
//     isDown = false;
//     projectList.classList.remove('active');
// });

// projectList.addEventListener('mouseup', ()=>{
//     isDown = false;
//     projectList.classList.remove('active');
// });

// projectList.addEventListener('mousemove', (e)=>{
//     if ( !isDown ) return; // stop the function from running
//     e.preventDefault();
//     const x = e.pageX - projectList.offsetLeft;
//     const walk = x - startX;
//     projectList.scrollLeft = scrollLeft - walk;
// });




// let hamburger = document.querySelector("#hamburger");
// let navLinks = document.querySelector(".nav-links");
// let links = document.querySelectorAll(".nav-links li");

// hamburger.addEventListener("click", () => {
//   navLinks.classList.toggle("open");
//   links.forEach(link => {
//     link.classList.toggle("fade");
//   });
// });



}