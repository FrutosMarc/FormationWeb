/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
         $('TR #LigneArticle').mouseenter(
          function() {

             // votre code ici sera executé au passage de la souris sur le lien   
             $('TR #LigneArticle').addClass("ArticleInligth");
          }
                
        );

         $('TR #LigneArticle').mouseleave(
          function() {

             // votre code ici sera executé au passage de la souris sur le lien   
              $('TR #LigneArticle').addClass("ArticleUnligth");
          }
                 
        );
   
});