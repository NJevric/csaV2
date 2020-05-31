window.onload=function(){
    var url=location.href;
    console.log(url);
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
     
     if(url.indexOf("page=home")!=-1){
        this.console.log("proba");
    }
     if(url.indexOf("page=services")!=-1){
        removeClassHome();
         this.document.getElementById("home_background").classList.add("services");
     }
     if(url.indexOf("page=clients")!=-1){
        removeClassHome();
         this.document.getElementById("home_background").classList.add("clients");
     }
     if(url.indexOf("page=news")!=-1){
        removeClassHome();
         this.document.getElementById("home_background").classList.add("news");
     }
     if(url.indexOf("page=contact")!=-1){
        removeClassHome();
         this.document.getElementById("home_background").classList.add("contact");
     }
     if(url.indexOf("page=player")!=-1 || url.indexOf("page=vest")!=-1 || url.indexOf("page=contact")!=-1 || url.indexOf("page=news")!=-1 || url.indexOf("page=clients")!=-1 || url.indexOf("page=services")!=-1){
         this.document.getElementById("licenca").style.display="none";
         this.document.getElementById("licencaTel").style.display="none";
     }


    // CLIENTS
    if(url.indexOf("page=clients")!=-1){
        function upisiVrednostiULs(data){
            let idIgrac=data.map(x=>x.id_client);
            localStorage.setItem("idIgrac",JSON.stringify(idIgrac));
        }
        function vratiVrednostIzLs(){
            return JSON.parse(localStorage.getItem("idIgrac"));
            
        }
        ajaxClients = (callbackSuccess,fileName) =>{
          $.ajax({
            url:"models/clients/"+fileName,
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
                },"clientsSelect.php"
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
            <div class="client col-md-3 col-6 text-center"">
            <img class="" src="${i.src}" alt="${i.alt}">
            <h4 class="mt-3 text-center">${i.name + " " + i.last_name}</h4>
            <hr class="clientsHr mx-auto"/>
            <a href="index.php?page=player&id=${i.id_client}" class="clientBtn mt-3">INFORMATION</a>
            </div>`
        }   

        (function(){
            ajaxClients(
                function(data){
                console.log(data);
                activeLinksAll(data);
                },
                "clientsActive.php"
            );
        })();

        activeLinksAll = (links) => {
            let ispis=`<option value="0">Employment Status</option>`;
            links.forEach(i=>{
                ispis+= singleActiveLink(i);
            });
            document.getElementById("contractDdl").innerHTML=ispis;
        }

        singleActiveLink = (i) => {
            return `<option value="${i.id_active}">${i.nameActive}</option>`;
        }
      
        document.getElementById("contractDdl").addEventListener("change",function(){
            let active = $(this).val();
           
            $.ajax({
                url:"models/clients/clientsFilter.php",
                method:"get",
                dataType:"json",
                data:{
                    active : active
                },
                success:function(data){
                    
                    console.log(active);
                    
                    let igrac=vratiVrednostIzLs();
                    console.log(igrac);
                            clientsAll(data);
                            upisiVrednostiULs(data);
                      
                    
                    
                    
                },
                error:function(xhr){
                    console.log(xhr);
                }
            });
          });


        (function(){
            ajaxClients(
                function(data){
                console.log(data);
                positionLinksAll(data);
                let kliknuto = $(".position");
                
                kliknuto.change(function(){
                    let cekirano = $(".position:checked");
                    let nizCekirano = [];
                   
                    for(let i=0;i<cekirano.length;i++){
                        if(!nizCekirano.includes(cekirano[i].value)){
                            nizCekirano.push(cekirano[i].value);
                        }
                        // if(nizCekirano.includes(cekirano[0]),value){
                        //     $(".position").trigger("click");
                        // }
                    }
                    if(nizCekirano.length==0){
                        nizCekirano.push(0);
                    }
                   
                    $.ajax({
                        url:"models/clients/clientsFilter.php",
                        method:"post",
                        dataType:"json",
                        data:{
                            position : nizCekirano
                        },
                        success:function(data){
                            let igrac=vratiVrednostIzLs();
                            console.log(position);
                            console.log(data);
                           
                            clientsAll(data);
                            
                            upisiVrednostiULs(igrac);
                            
                        },
                        error:function(xhr){
                            console.log(xhr);
                            }
                    });
                })
            },
                "clientsPosition.php"
            );
        })();

        positionLinksAll = (links) => {
            let ispis=`<label for="Select All">
            <input type="checkbox" name="chb" class="mr-2 position" id="0" value="0"/>Select All
        </label>`;
            links.forEach(i=>{
                ispis+= singlePositionLink(i);
            });
            document.getElementById("chbs").innerHTML=ispis;  
        }

        singlePositionLink = (i) => {
            // return `<option value="${i.id_position}">${i.name_position}</option>`;
            return `<label for="${i.name_position}">
            <input type="checkbox" name="chb" class="mr-2 position" id="${i.id_position}" value="${i.id_position}"/>${i.name_position}
        </label>`;
        }



        // let kliknuto = document.getElementsByClassName("position");
        //     for(let i of kliknuto){
        //         i.addEventListener("change",function(){
        //             let position = $(this).val();
        //             $.ajax({
        //                 url:"models/clients/clientsFilter.php",
        //                 method:"get",
        //                 dataType:"json",
        //                 data:{
        //                     position : position
        //                 },
        //                 success:function(data){
        //                     clientsAll(data);
        //                     console.log(position);
        //                     console.log(data);
        //                     console.log("jebi se");
        //                 },
        //                 error:function(xhr){
        //                     console.log(xhr);
        //                 }
        //             });
        //           });
        //     }  
        
         
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
                    console.log(data);
                    newsAll(data);
                }
            );
        })();

        newsAll = (news) => {
            let ispis = "";
            news.forEach(i => {
                ispis+=singleNews(i);
            });
            document.getElementById("vesti").innerHTML=ispis;
        }

        singleNews = (i) => {
            return `<div class="vest col-lg-5 col-md-5">
            <h4 class="mb-3">${i.headline}</h4>
            <p class="newsDatum mb-3">${i.date}</p>
            <p class="newsTekst mb-3">${i.text.substring(0,150) + "..."}</p>
            <a href="index.php?page=blog&id=${i.id_news}" class="newsBtn mt-4">READ MORE</a>
        </div>`;
        }
    }

   

    // $(function() {

    //     $("#team").mousewheel(function(event, delta) {
     
    //        this.scrollLeft -= (delta * 30);
         
    //        event.preventDefault();
     
    //     });
     
    //  });

    //  $('#team').bind('mousewheel', function(event,delta){
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


if(url.indexOf("page=home")!=-1 || url.substr(url.length - 9)=="index.php" || url.substr(url.length - 3)=="com"){
    $(document).ready(function(){
        $('#team').hScroll();
    });
    $.fn.hScroll = function( options )
     {
       function scroll( obj, e )
       {
         var evt = e.originalEvent;
         var direction = evt.detail ? evt.detail * (-240) : evt.wheelDelta;
    
         if( direction > 0)
         {
            direction =  $(obj).scrollLeft() - 240;
         }
         else
         {
            direction = $(obj).scrollLeft() + 240;
         }
    
         $(obj).scrollLeft( direction );
    
         e.preventDefault();
       }
    
       if (window.matchMedia('(max-width: 1920px)').matches) {
        $(this).width( $(this).find('div').width("210px") );
       }
       if (window.matchMedia('(max-width: 1600px)').matches) {
        $(this).width( $(this).find('div').width("180px") );
       }
       if (window.matchMedia('(max-width: 1440px)').matches) {
        $(this).width( $(this).find('div').width("160px") );
       }
       if (window.matchMedia('(max-width: 1366px)').matches) {
        $(this).width( $(this).find('div').width("140px") );
       }
       if (window.matchMedia('(max-width: 1024px)').matches) {
        $(this).width( $(this).find('div').width("140px") );
       }
       $(this).bind('DOMMouseScroll mousewheel', function( e )
       {
        scroll( this, e );
       });
    }

    
const projectList = document.querySelector('#team');
let isDown = false;
let startX;
let scrollLeft;

projectList.addEventListener('mousedown', (e)=>{
    isDown = true;
    projectList.classList.add('active');
    startX = e.pageX - projectList.offsetLeft;
    scrollLeft = projectList.scrollLeft;
    projectList.classList.add('active');
});

projectList.addEventListener('mouseleave', ()=>{
    isDown = false;
    projectList.classList.remove('active');
});

projectList.addEventListener('mouseup', ()=>{
    isDown = false;
    projectList.classList.remove('active');
});

projectList.addEventListener('mousemove', (e)=>{
    if ( !isDown ) return; // stop the function from running
    e.preventDefault();
    const x = e.pageX - projectList.offsetLeft;
    const walk = x - startX;
    projectList.scrollLeft = scrollLeft - walk;
});


}








// (function() {
//     function scrollHorizontally(e) {
//         e = window.event || e;
//         var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
//         document.getElementById('team').scrollLeft -= (delta*700); // Multiplied by 40
//         e.preventDefault();
//     }
//     if (document.getElementById('team').addEventListener) {
//         // IE9, Chrome, Safari, Opera
//         document.getElementById('team').addEventListener("mousewheel", scrollHorizontally, false);
//         // Firefox
//         document.getElementById('team').addEventListener("DOMMouseScroll", scrollHorizontally, false);
//     } else {
//         // IE 6/7/8
//         document.getElementById('team').attachEvent("onmousewheel", scrollHorizontally);
//     }
// })();




// let hamburger = document.querySelector("#hamburger");
// let navLinks = document.querySelector(".nav-links");
// let links = document.querySelectorAll(".nav-links li");

// hamburger.addEventListener("click", () => {
//   navLinks.classList.toggle("open");
//   links.forEach(link => {
//     link.classList.toggle("fade");
//   });
// });

 // CONTACT
 if(url.indexOf("page=contact")!=-1){
    document.getElementById("btnSubmit").addEventListener("click", function(){
    
        let form=document.getElementById("contactForm");
        let name=document.getElementById("name").value;
        let subject=document.getElementById("subject").value;
        let email=document.getElementById("emailContact").value;
        let text=document.getElementById("text").value;
        let error=document.getElementsByClassName("errorMsg");
       
        let regName= /^[A-Z][a-z]{2,15}(\s[A-Z][a-z]{2,15})*$/;
        let regSubject= /^\w{3,30}(\s\w{2,30})*$/;
        let regEmail=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        let greske =[];
    
        stilGreskaBordura = (id) => {
            return document.getElementById(id).style.border="1px solid red";
        }
        
       if(!name.match(regName)){
            if(name == ""){
                error[0].innerHTML="Name filed is mandatory";
                stilGreskaBordura("name");
                greske.push("1");
            }
            if(name != ""){
                error[0].innerHTML="First letter must be uppercase";
                stilGreskaBordura("name");
                greske.push("1");
            }
            if(name.length>32){
                error[0].innerHTML="Max characters 32";
                stilGreskaBordura("name");
                greske.push("1");
            }
       }
       if(!subject.match(regSubject)){
            if(subject == ""){
                error[1].innerHTML="Subject filed is mandatory ";
                stilGreskaBordura("subject");
                greske.push("2");
            }
            if(subject != ""){
                error[1].innerHTML="Use only letters for Subject input";
                stilGreskaBordura("subject");
                greske.push("2");
            }
            if(subject.length>30){
                error[1].innerHTML="Max characters 30 for one word";
                stilGreskaBordura("subject");
                greske.push("2");
            }
        }
       if(!email.match(regEmail)){
            if(email == ""){
                error[2].innerHTML="Email filed is mandatory";
                stilGreskaBordura("emailContact");
                greske.push("2");
            }
            if(email != ""){
                error[2].innerHTML="Wrong email format";
                stilGreskaBordura("emailContact");
                greske.push("3");
            }
        }
        if(text.length<10){
            error[3].innerHTML="Message must contain min 10 characters";
            document.getElementById("text").style.border="1px solid red";
            greske.push("4");
        }
        if(text.length>200){
            error[4].innerHTML="Message can contain max 200 characters";
            document.getElementById("text").style.border="1px solid red";
            greske.push("5");
        } 
       
        if(greske.length){
            return false;          
        }
        else{
           alert("You successfully sent us a message");
           
          
               $.ajax({
                url:"models/contact/contactEmail.php",
                method:"post",
                dataType:"json",
                data:{
                    nameJSON: name,
                    subjectJSON: subject,
                    emailJSON: email,
                    textJSON: text,
                    clicked: true
                },
                success:function(data){
                    console.log(data);
                    form.reset();
                    // window.location="index.php?page=contact";
                    console.log("cao");
                    // $("#restart").trigger("click");
                  
                },
                error:function(status){
                    console.log(status);
                }
               }); 
               
                
           return true;
       }
    });
    
    
}

}

    
let expanded = false;
function prikaziChbZaFilter() {
    let checkboxes = document.getElementById("chbs");
    if (!expanded) {
        checkboxes.style.display = "block";
        expanded = true;
    } 
    else {
        checkboxes.style.display = "none";
        expanded = false;
    }
}