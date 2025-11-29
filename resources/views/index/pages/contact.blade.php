<div class="page-nav no-margin row">
       <div class="container">
           <div class="row">
               <h2>Contact Us</h2>
               <ul>
                   <li> <a href="#"><i class="fas fa-home"></i> Home</a></li>
                   <li><i class="fas fa-angle-double-right"></i> Contact Us</li>
               </ul>
           </div>
       </div>
   </div>
   
   
   
    <div style="margin-top:0px;" class="row no-margin">
        
        <iframe style="width:100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3000!2d7.5923222!3d6.1230333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!6e4!9m1!1e3!12b0!3d6.1230333!4d7.5923222!15z!q=Cornelia+Connelly+College+Nise,+Anambra,+Nigeria" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>




      </div>

    
      
      <div class="row contact-rooo no-margin">
        <div class="container">
           <div class="row">
               
          
            <div style="padding:20px" class="col-sm-6">
            <h2 style="font-size:18px">Contact Form</h2>
                <div class="row cont-row">
                    <div  class="col-sm-3"><label>Enter Name </label><span>:</span></div>
                    <div class="col-sm-8"><input type="text" placeholder="Enter Name" name="name" class="form-control input-sm"  ></div>
                </div>
                <div  class="row cont-row">
                    <div  class="col-sm-3"><label>Email Address </label><span>:</span></div>
                    <div class="col-sm-8"><input type="text" name="name" placeholder="Enter Email Address" class="form-control input-sm"  ></div>
                </div>
                 <div  class="row cont-row">
                    <div  class="col-sm-3"><label>Mobile Number</label><span>:</span></div>
                    <div class="col-sm-8"><input type="text" name="name" placeholder="Enter Mobile Number" class="form-control input-sm"  ></div>
                </div>
                 <div  class="row cont-row">
                    <div  class="col-sm-3"><label>Enter Message</label><span>:</span></div>
                    <div class="col-sm-8">
                      <textarea rows="5" placeholder="Enter Your Message" class="form-control input-sm"></textarea>
                    </div>
                </div>
                 <div style="margin-top:10px;" class="row">
                    <div style="padding-top:10px;" class="col-sm-3"><label></label></div>
                    <div class="col-sm-8">
                     <button class="btn btn-success btn-sm">Send Message</button>
                    </div>
                </div>
            </div>
             <div class="col-sm-6">
                    
                  <div style="margin:50px" class="serv"> 
                
               
             
                              
              
          <h2 style="margin-top:10px;">Address</h2>

            Cornelia Connelly College <br>
            Nise<br>
            Anambra State, Nigeria<br>
            Phone:+91 9159669599<br>
            Email:info@cccollege.org<br>
            Website:www.cccollege.org<br>  
           </div>    
                
             
         </div>

            </div>
        </div>
        
      </div>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery library -->

      <script>
      $(document).ready(function() {
          $('#sendMessageBtn').click(function(e) {
              e.preventDefault(); // Prevent the default form submission
              
              // Get form data
              var name = $('#name').val();
              var email = $('#email').val();
              var mobile = $('#mobile').val();
              var message = $('#message').val();
              
              // Send form data via AJAX
              $.ajax({
                  type: 'POST',
                  url: '/submit_contact_form/',
                  data: {
                      'name': name,
                      'email': email,
                      'mobile': mobile,
                      'message': message
                  },
                  success: function(response) {
                      // Display success message
                      $('#formMessage').html('<div class="alert alert-success">Form submitted successfully!</div>');
                  },
                  error: function(xhr, status, error) {
                      // Display validation errors or error message
                      $('#formMessage').html('<div class="alert alert-danger">' + xhr.responseText + '</div>');
                  }
              });
          });
      });
      </script>
      
   
      <div class="banner">
        <h2>Enrol Your Child Now!</h2>
       <a href="admissionForm.html" button class="enroll-btn"> Enrol Now</button> </a>
      </div>
   
    