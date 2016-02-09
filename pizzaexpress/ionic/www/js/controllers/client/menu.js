angular.module('starter.controllers')
    .controller('ClientMenuCtrl', [
        '$scope', '$state', 'UserData', 'OAuthToken',
        function($scope, $state, UserData, OAuthToken){
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