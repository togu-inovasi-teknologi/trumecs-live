$(document).ready(function () {
    
    const tags = $('#tags');
    const input = $('#input-tag');

    $(document).on('keydown', '#input-tag', function(event){
        
        $('#input-email-validator').html('');
        
        if (event.key === 'Enter') { 
          
            
            
            event.preventDefault(); 
          
            
            const tag = document.createElement('li'); 
          
            
            const tagContent = $(this).val().trim(); 
          
            
            if (tagContent !== '') { 
          

                if(hasEmail(tagContent)){
                    tag.innerHTML = `<i class="value">${tagContent}</i><button class="delete-button">X</button>`; 

              
                
                    $('#tags').append(tag); 
                      
                    $(this).val('');
                }
                
                
                
            } 
        } 
    })


    function hasEmail(value){
        var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
          
        if (value.match(validRegex)) {
            return true;
        
        } else {
            $('#input-email-validator').append(`<div class="alert alert-warning">Invalid Email Address!</div>`)
        
            return false;
        
        }
    }
    
 

    
    $(document).on('click', '#tags',function (event) { 

        
        if (event.target.classList.contains('delete-button')) { 
          
            
            event.target.parentNode.remove(); 
        } 
    }); 
});