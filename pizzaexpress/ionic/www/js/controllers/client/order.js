angular.module('starter.controllers')
    .controller('ClientOrderCtrl', [
        '$scope', '$state',
        '$ionicLoading', 'Order',
        function($scope, $state, $ionicLoading, Order){
            $scope.items = [];
            $ionicLoading.show({
                template: 'Carregando...'
            });
            /*Order.query({
                id: null,
                orderBy: 'created_at',
                sortedBy: 'desc'
            }, function (data) {
                $scope.items = data.data;
                $ionicLoading.hide();
            }, function (dataError) {
                $ionicLoading.hide();
                alert('Conexão Falhou');
            });*/
            $scope.openOrder = function(order){
                $state.go('client.view_order', {id: order.id});
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
                return Order.query({
                    id: null,
                    orderBy: 'created_at',
                    sortedBy: 'desc'
                }).$promise;
            }

            getOrders().then(function(data){
                $scope.items = data.data;
                $ionicLoading.hide();
            }, function(dataError){
                $ionicLoading.hide();
                alert('Conexão Falhou');
            });
        }]);