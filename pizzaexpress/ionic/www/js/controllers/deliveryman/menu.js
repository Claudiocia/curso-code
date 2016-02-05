angular.module('starter.controllers')
    .controller('DeliverymanMenuCtrl', [
        '$scope', '$state', '$ionicLoading', 'User',
        function($scope, $state, $ionicLoading, User){
            $scope.user = {
                name: ''
            };
            $ionicLoading.show({
                template: 'Carregando...'
            });
            User.autenticated({}, function(data){
                $scope.user = data.data;
                $ionicLoading.hide();
            }, function(dataError){
                $ionicLoading.hide();
                alert('Conexão Falhou');
            });
        }]);