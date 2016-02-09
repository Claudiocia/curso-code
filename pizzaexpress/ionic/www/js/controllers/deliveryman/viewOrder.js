angular.module('starter.controllers')
    .controller('DeliverymanViewOrderCtrl', [
        '$scope', '$stateParams', 'DeliverymanOrder',
        '$ionicLoading', '$ionicPopup','$cordovaGeolocation',
        function($scope, $stateParams, DeliverymanOrder,
                 $ionicLoading,$ionicPopup, $cordovaGeolocation){
            var watch;
            $scope.order = {};
            $ionicLoading.show({
                template: 'Carregando...'
            });

            DeliverymanOrder.get({id: $stateParams.id, include: "items, cupom"}, function(data){
                $scope.order = data.data;
                $ionicLoading.hide();
            }, function(dataError){
                $ionicLoading.hide();
                alert('Conexão Falhou');
            });

            $scope.goToDelivery = function(){
                $ionicPopup.confirm({
                    title:'Confirma a entrega?',
                    template: 'Aperte ok para confirmar'
                }).then(function(res){
                    if(res) {
                        stopWatchPosition();
                    }else{
                        rollbackEntrega();
                    }
                });
                DeliverymanOrder.updateStatus({id: $stateParams.id}, {status: 1}, function(){
                    var watchOptions = {
                        timeout: 3000,
                        enableHighAccuracy: false
                    };
                    watch = $cordovaGeolocation.watchPosition(watchOptions);
                    watch.then(null,
                    function(responseError){
                       //error
                    },
                        function(position){
                            DeliverymanOrder.geo({id: $stateParams.id},{
                                lat: position.coords.latitude,
                                long: position.coords.longitude
                            });
                        });
                });
            };
            function stopWatchPosition(){
                if(watch && typeof watch == 'object' && watch.hasOwnProperty('watchID')){
                    $cordovaGeolocation.clearWatch(watch.watchID);
                    DeliverymanOrder.updateStatus({id: $stateParams.id}, {status: 2},
                        function(){
                        $ionicPopup.alert({
                            title:'Obrigado',
                            template: 'Entrega Confirmada'
                        });
                    }, function(responseError){
                            $ionicPopup.alert({
                                title:'Atenção',
                                template: 'Não foi possivel avisar a entrega'
                            });
                            console.log(responseError);
                    });
                }
            }
            function rollbackEntrega() {
                if(watch && typeof watch == 'object' && watch.hasOwnProperty('watchID')){
                    $cordovaGeolocation.clearWatch(watch.watchID);
                    DeliverymanOrder.updateStatus({id: $stateParams.id}, {status: 0},
                        function(){
                            $ionicPopup.alert({
                                title:'Atençao',
                                template: 'Entrega Cancelada'
                            });
                        }, function(responseError){
                            $ionicPopup.alert({
                                title:'Atenção',
                                template: 'Não foi possivel avisar o cancelamento'
                            });
                            console.log(responseError);
                        });
                }
            }
        }]);