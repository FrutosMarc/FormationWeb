<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div><h1>Query en test</h1></div>
        <div id="message"></div>
        <div>
            <textarea id="NewMessage"></textarea>
            <button onclick="AddMessage(this)">Ajout Note</button>
        </div>
        <script src="http://code.jquery.com/jquery-2.1.3.js" type="text/javascript"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script> 
        <Script>
            
            $(function(){
                $.ajax({
                    type:"GET",
                    url:"http://sfrest.local/app_dev.php/notes.json",
                    contentType:"Text/plain",
                    dataType:"json",
                    data:{limit: 100},
                    success: function(data, status, jqXHR){
                        showData(data);
                    },
                    error:function(jqXHR,status){
                        showError(status,jqXHR);
                    }});
            });
            function showData(data){
                $("#message").append("<ul/>");
                $.each(data.notes,
                function(id,item){
                    $("#message ul").append("<li id='item"+id+"'><a hRef='#'>" +item.message+"</a><button onClick='EditData("+id+","+item+")' >Edition</button><button onclick='deleteMessage("+id+")'>Supprimer Note</button></li>");
                });
                $("#message").append("<h2><b> nombre total affiché " + $("li").length + "</b></h2>");
            }
            function EditData(id){
                $.ajax({
                    type:"GET",
                    url:"http://sfrest.local/app_dev.php/notes.json",
                    contentType:"Text/plain",
                    dataType:"json",
                    success: function(data, status, jqXHR){
                        EditData(data);
                    },
                    error:function(jqXHR,status){
                        console.log(status);
                    }
                });
                
            }
            
            function AddMessage(Doc){
                var sMess = $("#NewMessage").val();
                alert(sMess);
                 $.ajax({
                    type:"POST",
                    url:"http://sfrest.local/app_dev.php/notes.json",
//                    contentType:"Text/plain",
                    dataType:"json",
                    data:{"note[message]":sMess},
                    error:function(jqXHR,status){
                        showError(status,jqXHR);
                    }});
            };
            function deleteMessage(id){
                $.ajax({
                    type:"GET",
                    url:"http://sfrest.local/app_dev.php/notes/"+id+"/remove",
//                    contentType:"Text/plain",
                    dataType:"json",
//                    data:{"note[message]":sMess},
                    error:function(jqXHR,status){
                        showError(status,jqXHR);
                    }});
                $("#item"+id).remove();
            };
            function showError(status,jqXHR){
                alert("Status :" + status + " ***** Info JSON ***** "+ JSON.stringify(jqXHR));
            };
            function editData(data){
                $(#NewMessage).value = data.message;
                
            };
            
        </script>
    </body>
</html>
