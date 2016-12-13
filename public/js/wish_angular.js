var blowawish = angular.module("blowawish",[]).controller("wishAngController", function ($scope, $http) {
    $scope.submitWish = function(){
        var req = {
            method: 'POST',
            url: './save_wish',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              /* 'Content-Type': 'application/x-www-form-urlencoded'*/
            },
           data: {
               name: $scope.wishFormName,
               wish: $scope.wishFormWish
           }
        };

        $http(req).then(function(data){
            console.log(data);
        }

        );
    }

});