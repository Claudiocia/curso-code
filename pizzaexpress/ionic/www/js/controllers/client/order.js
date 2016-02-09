angular.module('starter.controllers')
    .controller('ClientOrderCtrl', [
        '$scope', '$state',
        '$ionicLoading', '$ionicActionSheet', 'Order',
        function($scope, $state, $ionicLoading, $ionicActionSheet, Order){
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
            $scope.showActionSheet = function(order){
                $ionicActionSheet.show({
                    buttons: [
                        {text: 'Ver Detalhes'},
                        {text: 'Ver Entrega'}
                    ],
                    titleText: 'Opções',
                    cancelText: 'Cancelar',
                    cancel: function() {
                        //
                    },
                    buttonClicked: function(index){
                        switch (index){
                            case 0:
                                $state.go('client.view_order', {id: order.id});
                                break;
                            case 1:
                                $state.go('client.view_delivery', {id: order.id});
                                break;
                        }
                    }
                });
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