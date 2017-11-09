app.controller('memberController', function($scope,$http,API_URL) {
    
    $http.get(API_URL + "list").then(function(response) {
        $scope.members = response.data; // .data
    });
    
    // show modal form
    $scope.toggle = function(modalstate, id) {
        $scope.modalstate = modalstate;
        
        switch (modalstate)
                {
            case 'add':
                $scope.form_title = "Add New Member";
                break;
                
            case 'edit':
                $scope.form_title = 'Member Detail';
                $scope.id = id;
                $http.get(API_URL + 'edit/' + id).success(function (response) {
                    //console.log(response);
                    $scope.member = response;
                });
                
                break;
                
            default:
                
                $scope.form_title = "unknown";
                
                break;
        }
        
        console.log(id);
        $('#myModal').modal('show');
    }
    
    
    // save new record / update existing record
    $scope.save = function (modalstate, id) {
        
        
        if (modalstate == 'add')
            {
                var url = API_URL + "add";
                var data = $.param($scope.member);
                
                $http({
                    method  : 'POST',
                    url     : url,
                    data    : data,
                    headers : {'Content-Type': 'application/x-www-form-urlencoded'}

                })
                .success(function (response) {
                console.log(response);
                location.reload();
                })
        
                .error(function(response) {
                    console.log(response);
                    alert('This is embarassing. An error has occured. Please check the log for details.');
                });
            }
        
        // append member id to the URL if the form is in edit mode
        if (modalstate == 'edit')
            {
                var url = API_URL + 'edit' + id;
                var data = $.param($scope.member);
                
                $http({
                method  : 'POST',
                url     : url,
                data    : data,
                headers : {'Content-Type': 'application/x-www-form-urlencoded'}
                })
                .success(function (response) {
                console.log(response);
                location.reload();
                })
        
                .error(function (response) {
                    console.log(response);
                    alert('This is embarassing. An error has occured. Please check the log for details.');
                });

            }
        
    }
    
    
    // delete record
    $scope.confirmDelete = function (id) {
        
        var isConfirmDelete = confirm('Are you sure you want this record deleted?');
        
        if (isConfirmDelete)
            {
                $http.get(API_URL + 'delete/' +id)
                
                .success(function (response) {
                    console.log(response);
                    location.reload();
                })
                
                .error(function (response) {
                    console.log(response);
                    alert('Unable to delete');
                });
                
            } else {
                
                return false;
            }
    }
});