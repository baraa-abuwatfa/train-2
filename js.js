(() => {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
  
        form.classList.add('was-validated')
      }, true)
    })
  })()




  $('.btn').click(function(){
    $(this).toggleClass("click");
    $('.sidebar').toggleClass("show");
  });
   

    $('.sidebar ul li a').click(function(){
         var id = $(this).attr('id');
         $('nav ul li ul.item-show-'+id).toggleClass("show");
         $('nav ul li #'+id+' span').toggleClass("rotate");
         
    });
    
    $('nav ul li').click(function(){
      $(this).addClass("active").siblings().removeClass("active");
    });


    