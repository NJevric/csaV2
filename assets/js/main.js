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
                    // form.reset();
                    // window.location="index.php?page=contact";
                    // console.log("cao");
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

// LOGIN PAGE
if(url.indexOf("login.php")!=-1){
    document.getElementById("btnLogin").addEventListener("click",function(){

        let email=document.getElementById("usernameLog").value;
        let password=document.getElementById("passLog").value;
        let error=document.getElementsByClassName("errorMsgLogin");

        let regPass= /^.{5,60}$/;
        let regEmail=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        let errors =[];

        if(!email.match(regEmail)){
            if(email == ""){
                error[0].innerHTML="Email filed is mandatory";
                stilGreskaBordura("usernameLog");
                errors.push("1");
            }
            if(email != ""){
                error[0].innerHTML="Wrong email format";
                stilGreskaBordura("usernameLog");
                errors.push("2");
            }
        }
        if(!password.match(regPass)){
            if(password == ""){
                error[1].innerHTML="Password filed is mandatory";
                stilGreskaBordura("passLog");
                errors.push("3");
            }
            if(password != ""){
                error[1].innerHTML="Wrong password format";
                stilGreskaBordura("passLog");
                errors.push("4");
            }
        }
        if(errors.length){
            return false;
        }
        else{
            $.ajax({
                url: "../models/loginCheck.php",
                method: "post",
                dataType: "json",
                data:{
                    emailJSON: email,
                    passJSON : password,
                    clicked : true
                },
                success:function(data){
                    console.log("sve je ok sa serverom");
                    console.log(data);
                    window.location='../index.php?page=home';
                },
                error:function(xhr){
                    if(xhr.status==422){
                        // if(xhr.responseJSON.errorEmail){
                        //     console.log(xhr.responseJSON.errorEmail);
                        //     document.getElementById("errorEmail").innerHTML=xhr.responseJSON.errorEmail;
                        //     stilGreskaBordura("passLog");
                        
                        // }
                        if(xhr.responseJSON.errorPass){
                            console.log(xhr.responseJSON.errorPass);
                            document.getElementById("errorPass").innerHTML=xhr.responseJSON.errorPass;
                            stilGreskaBordura("passLog");
                        }
                    }
                    if(xhr.status==500){
                        console.log(xhr);
                        alert(xhr.responseJSON.errorMsg);
                    }
                    else{
                        console.log(xhr);
                    }
                    // console.log(xhr);
                }
            });
            return true;
        }
    })
}

    if(url.indexOf("register.php")!=-1){
        document.getElementById("btnRegister").addEventListener("click",function(){
            let firstName=document.getElementById("firstNameRegister").value;
            let lastName=document.getElementById("lastNameRegister").value;
            let email=document.getElementById("usernameRegister").value;
            let password=document.getElementById("passRegister").value;
            let error=document.getElementsByClassName("errorMsgRegister");

            let regFirstName = "/^[A-Z][a-z]{2,15}$/";
            let regLastName = "/^[A-Z][a-z]{2,15}$/";
            let regPass= /^.{5,60}$/;
            let regEmail=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            let errors =[];

            if(!firstName.match(regFirstName)){
                if(email == ""){
                    error[0].innerHTML="First Name field is mandatory";
                    stilGreskaBordura("firstNameRegister");
                    errors.push("1");
                }
                if(email != ""){
                    error[0].innerHTML="Invalid first name format (Fist letter must be uppercase)";
                    stilGreskaBordura("firstNameRegister");
                    errors.push("2");
                }
            }
            if(!lastName.match(regLastName)){
                if(email == ""){
                    error[1].innerHTML="Last Name field is mandatory";
                    stilGreskaBordura("lastNameRegister");
                    errors.push("3");
                }
                if(email != ""){
                    error[1].innerHTML="Invalid last name format (Fist letter must be uppercase)";
                    stilGreskaBordura("lastNameRegister");
                    errors.push("4");
                }
            }
    
            if(!email.match(regEmail)){
                if(email == ""){
                    error[2].innerHTML="Email filed is mandatory";
                    stilGreskaBordura("usernameRegister");
                    errors.push("5");
                }
                if(email != ""){
                    error[2].innerHTML="Wrong email format";
                    stilGreskaBordura("usernameRegister");
                    errors.push("6");
                }
            }
            if(!password.match(regPass)){
                if(password == ""){
                    error[3].innerHTML="Password filed is mandatory";
                    stilGreskaBordura("passRegister");
                    errors.push("7");
                }
                if(password != ""){
                    error[3].innerHTML="Wrong password format";
                    stilGreskaBordura("passRegister");
                    errors.push("8");
                }
            }
            if(errors.length){
                return false;
            }
            $.ajax({
                url: "../models/registerCheck.php",
                method: "post",
                dataType: "json",
                data:{
                    firstNameJSON: firstName,
                    lastNameJSON: lastName,
                    emailJSON: email,
                    passJSON : password,
                    clicked : true
                },
                success:function(data){
                    console.log("sve je ok sa serverom");
                    console.log(data);
                    window.location='login.php';
                    // if(data.status==200){
                        document.getElementById("success").innerHTML=data.responseJSON.success;
                    // }
                },
                error:function(xhr){
                   if(xhr.status==422){
                        if(xhr.responseJSON.errorFistName){
                            document.getElementById("errorMsgFirstName").innerHTML=xhr.responseJSON.errorFistName;
                            stilGreskaBordura("firstNameRegister");
                        }
                        if(xhr.responseJSON.errorLastName){
                            document.getElementById("errorMsgLastName").innerHTML=xhr.responseJSON.errorLastName;
                            stilGreskaBordura("lastNameRegister");
                        }
                        if(xhr.responseJSON.errorEmail){
                            document.getElementById("errorMsgEmail").innerHTML=xhr.responseJSON.errorEmail;
                            stilGreskaBordura("usernameRegister");
                        }
                        if(xhr.responseJSON.errorPass){
                            document.getElementById("errorMsgPass").innerHTML=xhr.responseJSON.errorPass;
                            stilGreskaBordura("passRegister");
                        }
                   }
                   if(xhr.status==500){
                        alert(xhr.responseJSON.errorMsg);
                   }
                   else{
                    console.log(xhr);
                   }
                }
            });
            return true;
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


stilGreskaBordura = (id) => {
    return document.getElementById(id).style.borderBottom="2px solid red";
}