angular.module('starter.controllers')
    .controller('ClientViewDeliveruCtrl', [
        '$scope', '$stateParams', 'Order',
        '$ionicLoading', '$ionicPopup',
        'UserData','$pusher', '$window', '$map',
        'uiGmapGoogleMapApi',
        function($scope, $stateParams, Order,
                 $ionicLoading, $ionicPopup,
                 UserData, $pusher, $window, $map,
                 uiGmapGoogleMapApi){
            iconUrl = 'http://maps.google.com/mapfiles/kml/pal3';
            $scope.order = {};
            $scope.map = $map;
            $scope.markers = [];

            $ionicLoading.show({
                template: 'Carregando...'
            });
            uiGmapGoogleMapApi.then(function(maps){
                $ionicLoading.hide();
            }, function(responseError){
                $ionicLoading.hide();
            });

            Order.get({id: $stateParams.id, include: 'items,cupom'}, function(data){
                $scope.order = data.data;

                if($scope.order.status == 1){
                    initMarkers($scope.order);
                }else{
                    switch ($scope.order.status){
                        case 0:
                            $ionicPopup.alert({
                                title: 'Atenção',
                                template: 'Produto aguardando entregador'
                            });
                            break;
                        case 2:
                            $ionicPopup.alert({
                                title: 'Atenção',
                                template: 'Produto já entregue'
                            });
                            break;
                        case 3:
                            $ionicPopup.alert({
                                title: 'Atenção',
                                template: 'Pedido cancelado'
                            });
                            break
                    }
                }
            }, function(dataError){

            });
            $scope.$watch('markers.length', function(value){
                //console.log(value);
                if(value == 2){
                    createBounds();
                }
            });
            function initMarkers(order){
                var client = UserData.get().client.data,
                    address = client.zipcode + ', ' +
                        client.address + ', ' +
                        client.city + ' - ' +
                        client.state;
                createMarkerClient(address);
                watchPositionDelivery(order.hash);
            }
            function createMarkerClient(address){
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    address: address
                },function(results, status){
                    //console.log(results);
                    //console.log(status);
                    if(status == google.maps.GeocoderStatus.OK){
                        var lat = results[0].geometry.location.lat(),
                            long= results[0].geometry.location.lng();
                        $scope.markers.push({
                            id: 'client',
                            coords:{
                                latitude: lat,
                                longitude: long
                            },
                            options: {
                                title: 'Local de entrega',
                                icon: iconUrl+'/icon18.png'
                            }
                        });
                    }else{
                        $ionicPopup.alert({
                            title: 'Atenção',
                            template: 'Não foi possível encontrar seu endereço'
                        });
                    }
                });
            }
            function watchPositionDelivery(channel){
                var pusher = $pusher($window.client),
                    channel= pusher.subscribe(channel);
                channel.bind('pizzaexpress\\Events\\GetLocationDeliveryman',
                function(data){
                    //console.log(data);
                    var latE = data.geo.lat,
                        longE= data.geo.long;
                    if($scope.markers.length == 1 || $scope.markers.length == 0){
                        $scope.markers.push({
                            id: 'delivery',
                            coords:{
                                latitude: latE,
                                longitude: longE
                            },
                            options: {
                                title: 'Entregador',
                                icon: iconUrl+'/icon48.png'
                            }
                        });
                        return;
                    }
                    for(var key in $scope.markers){
                        if($scope.markers[key].id = 'delivery'){
                            $scope.markers[key].coords = {
                                latitude: latE,
                                longitude: longE
                            }
                        }
                    }
                });
            }
            function createBounds(){
                var bounds = new google.maps.LatLngBounds(),
                    latlng;
                angular.forEach($scope.markers, function(value){
                    latlng = new google.maps.LatLng(Number(value.coords.latitude),Number(value.coords.longitude));
                    bounds.extend(latlng);
                });
                $scope.map.bounds = {
                    northeast: {
                        latitude: bounds.getNorthEast().lat(),
                        longitude: bounds.getNorthEast().lng()
                    },
                    southwest: {
                        latitude: bounds.getSouthWest().lat(),
                        longitude: bounds.getSouthWest().lng()
                    }
                };
            }
        }])
    .controller('CvdDescentralizeCtrl', ['$scope', '$map', function($scope, $map){
        $scope.map = $map;
        $scope.fit = function(){
            $scope.map.fit = !$scope.map.fit;
        }
    }])
    .controller('CvdReloadCtrl', ['$scope', '$window', '$timeout',
        function($scope, $window, $timeout){
            $scope.reload = function(){
                $timeout(function(){
                    $window.location.reload(true);
                },100);
            }
    }]);