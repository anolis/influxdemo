var formData;


$(document).ready(function(){
   
   var form = $('#paramForm');
   var formselect = $('#paramForm select');
   
   formselect.change(function(){
        
        if(formselect.val() == '---') {
            clearOutput(); 
            return false;
        }
       
        formData = form.serializeArray();
        
        $.post(form.attr('action'), formData, function(res){
        
            if(res.hasOwnProperty('setting') && res.hasOwnProperty('value'))
                var out = $('#output');

            out.html("Setting: " +res.setting +"<br>" 
                +"Value: " +res.value +"<br>"
                +"PHP Value: " +res.phpvalue +"<br>"
                +"PHP Type: " +res.datatype);

            out.fadeIn(300);
        
        });
        
        return false;
   });
});

function clearOutput(){
    $('#output').fadeOut(300, function(){
        $(this).html('');});
    return false;
}