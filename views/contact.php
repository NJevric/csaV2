
<div class="tekst row d-flex justify-content-center tekstContact">
    <!-- <div class="col-lg-8">
        <h2>Get in touch with us</h2>
        <hr class="naslovHr mb-4"/>
    </div> -->
    <div class="col-lg-8 col-11 text-center">
        <h2 class="mb-5">Get in touch with us</h2>
        <!-- <hr class="naslovHr mb-5"/> -->
        <div class="telefon d-flex justify-content-center">
            <i class="fas fa-phone"></i>
            <a href="tel:+1(480)-435-2821" title="Phone number"><p>+1 (480)-435-2821</p></a>
            <a href="tel:+1(416)-906-6240" title="Phone number"><p>+1 (416)-906-6240</p></a>
        </div>
        
        <form  action="<?= $_SERVER['page=contact'] ?>" method="POST" class="contactForma mx-auto" id="contactForm">
            <h6 class="errorMsgEmptyString"></h6>
            <div class="form-group row">
                <div class="col-lg-12 col-12 mb-0 mb-md-0 mx-auto">
                    <i class="fas fa-user-alt"></i>
                    <input type="text" class="" name="name" id="name" placeholder="Name" onfocus="this.placeholder=''" onblur="this.placeholder='Name'"/>
                    <h6 class="errorMsg" id="errorName"></h6>

                    
                </div>
                <div class="col-lg-12 col-12 mx-auto">
                    <i class="fas fa-font"></i>
                    <input type="text" class="" name="subject" id="subject" placeholder="Subject" onfocus="this.placeholder=''" onblur="this.placeholder='Subject'"/>
                    <h6 class="errorMsg" id="errorSubject"></h6>
                </div>
                
                <div class="col-lg-12 col-12 mb-3 mb-md-0 mx-auto">
                <i class="far fa-envelope"></i>
                    <input type="email" class="" name="emailContact" id="emailContact" placeholder="Email" onfocus="this.placeholder=''" onblur="this.placeholder='Email'"/>
                    <h6 class="errorMsg" id="errorEmail"></h6>
                </div>
                
                <div class="col-lg-12 col-12 mt-4 mx-auto">
                    
                    <textarea name="text" id="text"  placeholder="Message" onfocus="this.placeholder=''" onblur="this.placeholder='Message'"></textarea>
                    <h6 class="errorMsg" id="errorText"></h6>
                </div>
                <div class="col-lg-12 col-10 mb-3 mb-md-0 mx-auto">
                    <button type="button" class="btn-danger mt-4" id="btnSubmit" name="btnSubmit" value="Send Message">Send Message</button>
                    <input type="reset" id="restart"/>
                </div>
            </div>
            </form>
    </div>
                      