angular.module('starter.diretivas')
.directive('ngIf', function(){
       return {
           link: function(scope, element, attrs){
               if(scope.$eval(attrs.ngIf)){
                   //remove a <div ngIf ...></div>
                   element.replaceWith(element.children())
               }else{
                   element.replaceWith(' ')
               }
           }
       }
    });