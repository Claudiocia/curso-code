angular.module('starter.controllers')
    .controller('DeliverymanOrderCtrl', [
        '$scope', '$state',
        '$ionicLoading', 'DeliverymanOrder',
        function($scope, $state, $ionicLoading, DeliverymanOrder){
            $scope.items = [];
            $ionicLoading.show({
                template: 'Carregando...'
            });
            $scope.openOrder = function(order){
                $state.go('deliveryman.view_order', {id: order.id});
            };
            //Código para o pushrefresh que deverá ser usado pelo deliveryman
            $scope.doRefresh = function(){
                getOrders().then(function(data){
                    $scope.items = data.data;
                    $scope.$broadcast('scroll.refreshComplete');
                }, function(dataError){
                    $scope.$broadcast('scroll.refreshComplete');
                })
            };
            function getOrders() {
                return DeliverymanOrder.query({
                    id: null,
                    orderBy: 'created_at',
                    sortedBy: 'desc'
                }).$promise;
            }

            getOrders().then(function(data){
                $scope.items = data.data;
                console.log(data.data);
                $ionicLoading.hide();
            }, function(dataError){
                $ionicLoading.hide();
                alert('Conexão Falhou');
            });
        }]);