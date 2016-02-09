angular.module('starter.controllers')
    .controller('DeliverymanMenuCtrl', [
        '$scope', '$state', 'OAuthToken', 'UserData',
        function($scope, $state, OAuthToken, UserData){
            $scope.user = UserData.get();

            $scope.logout = function(data){
                //console.log(data);
                UserData.set(null);
                data = null;
                OAuthToken.removeToken();
                $state.go('login');
                //console.log(data);
            };
        }]);