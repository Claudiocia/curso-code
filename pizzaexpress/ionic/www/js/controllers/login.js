angular.module('starter.controllers')
    .controller('LoginCtrl', [
        '$scope', 'OAuth', '$ionicPopup', '$state', '$q', function($scope, OAuth,
                                                   $ionicPopup, $state, $q){
            $scope.user = {
                username: '',
                password: ''
            };

            function adiarExecucao(){
                var deffered = $q.defer();
                setTimeout(function(){
                    deffered.resolve({name: 'ionic'});
                }, 2000);
                return deffered.promise;
            }
            adiarExecucao().then(function(data){
                console.log(data);
            });

            $scope.login = function(){
                OAuth.getAccessToken($scope.user)
                    .then(function(data){
                        $state.go('client.checkout');
                    }, function(responseError){
                        $ionicPopup.alert({
                            title: 'Advertência',
                            template: 'Login e/ou Senha inválidos'
                        })
                        console.debug(responseError);
                    });
            }
    }]);