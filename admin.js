$(document).ready(function(){
    $("#editMenu").sortable({
        "update":function(){
            // return order of items
            var pageOrder=$( "#editMenu" ).sortable('toArray', {'attribute':'dataPageId'});
            console.log(pageOrder);
            
            $.ajax({
                'url':'admin.php?action=setOrder',
                'method':'POST',
                'data':{
                    'pageOrder':pageOrder
                }
            });
        }
    });
    
    // if admin clicked on div CROSS, show alert message with two choices
    $('#cross').click(function getConfirmation(udalost){
               var retVal = confirm("Opravdu chcete odstranit stránku?");
               if( retVal === true ){
                  // if admin clicked on OK, do action delete from admin.php (id cross)
               }
               else{
                   udalost.preventDefault(); // don't do default action, send into URL action NONE
                    $.ajax({
                       'url':'admin.php',
                       'method':'GET',
                       'data':{
                           'action':'none'
                           }});    
               }
    });
    
    // sending form from contact page
    $('#kontaktForm').submit(function(udalost){ // catch sending form
        udalost.preventDefault(); // don't do default action (sending form)
        $.ajax({
           'url':'adminSendMess.php',
           'method':'POST',
           'data':{
               'name':$('#kontaktForm [name=name]').val(),
               'surname':$('#kontaktForm [name=surname]').val(),
               'email':$('#kontaktForm [name=email]').val(),
               'text':$('#kontaktForm [name=text]').val()
           }
        }).fail(function(){ 
            alert("chyba systemu");
        }).done(function(){
            $('#kontaktForm [name=name]').val('');
            $('#kontaktForm [name=surname]').val('');
            $('#kontaktForm [name=email]').val('');
            $('#kontaktForm [name=text]').val('');
        });
        alert('Formulář byl odeslán.');
    });

});