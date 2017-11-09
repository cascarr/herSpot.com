app.controller('memberController', function ($scope, $http, API_URL) {

    $http.get(API_URL + "list").then(function (response) {
        $scope.members = response.data; // .data
    });

    // show modal form
    $scope.toggle = function (modalstate, id) {
        $scope.modalstate = modalstate;

        switch (modalstate) {
            case 'add':
                $scope.form_title = "Add New Member";
                break;

            case 'edit':
                $scope.form_title = 'Member Detail';
                $scope.id = id;

                $http.get(API_URL + 'edit/' + id).then(function (response) {
                    $scope.member = response.data;

                }).catch(err => console.log(err));
                break;

            default:
                $scope.form_title = "unknown";
                break;
        }

        $('#myModal').modal('show');
    }


    $scope.uploadFile = (files) => {
        $scope.member.img = files[0];
    };

    // save new record / update existing record
    $scope.save = function (modalstate, id) {
        if (modalstate === 'add') {
            let url = API_URL + "add";
            let formData = new FormData;
            for(let i in $scope.member){
                formData.append(i, $scope.member[i]);
            }
            $http({
                method : 'POST',
                url : url, data : formData,
                headers: {
                    "Content-Type": undefined
                }
            }).then(response => location.reload()).catch(err => console.log(err));
        }


        // append member id to the URL if the form is in edit mode
        if (modalstate === 'edit') {
            let url = API_URL + 'edit/' + id;
            let formData = new FormData;
            for(let i in $scope.member){
                formData.append(i, $scope.member[i]);
            }
            $http({
                method: 'POST',
                url: url,
                data: formData,
                headers: {
                    "Content-Type": undefined
                }
            }).then(response => location.reload()).catch(response => alert('This is embarassing. An error has occured. Please check the log for details.'));

        }

    }


    // delete record
    $scope.confirmDelete = function (id) {
        var isConfirmDelete = confirm('Are you sure you want this record deleted?');
        if (isConfirmDelete) {
            $http.delete(API_URL + 'delete/' + id).then( response => location.reload()).catch(response => alert('Unable to delete'));
        } else {
            return false;
        }
    }
});