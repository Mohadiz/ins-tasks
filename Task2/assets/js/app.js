$(document).ready(function(){
    $('form').validate();
});


var myApp = angular.module('myApp', []);

myApp.controller('formCtrl' , function($scope){
    $scope.dayOfWeek = (new Date()).getDay();
    $scope.theHour = (new Date()).getHours();
});
