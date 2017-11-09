<!DOCTYPE html>
<html lang="en-US" ng-app="memberRecords">
    <head>
        <meta charset="UTF-8" />
	   <meta name="copyright" content="QuocTuan.Info" />
	   <meta name="author" content="Vũ Quốc Tuấn" />

        <title>Herspot.com</title>
        
        <!-- Load Bootstrap CSS -->
        <link type="text/css" rel="stylesheet" href="<?= asset('css/bootstrap.min.css') ?>" >
    </head>
    <body>
        
        <h2>Members Data</h2>
        <div ng-controller="memberController">
            
            <!-- Table-to-load-the-data Part -->
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Age</th>
                        <th>Profile image</th>
                        <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add')">Add New Member</button></th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr ng-repeat="member in members">
                        <td>{{ member.id }}</td>
                        <td>{{ member.name }}</td>
                        <td>{{ member.address }}</td>
                        <td>{{ member.age }}</td>
                        <td>{{ member.profile_img }}</td>
                        
                        <button class="btn btn-default btn-xs btn-detail" ng-click="toggle('edit', member.id)">Edit</button>
                        
                        <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(member.id)">Delete</button>
                    </tr>
                </tbody>
            </table>
            
            <!-- End of Table-to-load-the-data Part -->
            <!-- Modal (Pop up when detail button clicked) -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" arial-label="Close"><span aria-hidden="true">x</span></button>
                            <h4 class="modal-title" id="myModalLabel">{{form_title}}</h4>
                        </div>
            <div class="modal-body">
                            
            <form name="frmMembers" class="form-horizontal" enctype="multipart/form-data" novalidate="">

                <div class="form-group error">
                    <label for="inputName" class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control has-error" id="name" name="name" placeholder="Fullname" value="{{name}}" 
                        ng-model="member.name" ng-required="true">
                        <span class="help-inline" 
                        ng-show="frmMembers.name.$invalid && frmMembers.name.$touched">Name field is required</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputAddress" class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Your Address" value="{{address}}" 
                        ng-model="member.address" ng-required="true">
                        <span class="help-inline" 
                        ng-show="frmMembers.address.$invalid && frmMembers.address.$touched">Valid Address field is required</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputAge" class="col-sm-3 control-label">Age</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="age" name="age" placeholder="Your age" value="{{age}}" 
                        ng-model="member.age" ng-required="true">
                    <span class="help-inline" 
                        ng-show="frmMembers.age.$invalid && frmMembers.age.$touched">Age field is required</span>
                    </div>
                </div>

                <div class="form-group">
                <label for="product_image">Profile image</label>
                <input ng-model="form.image" type="file" class="form-control input-lg" accept="image/*" id="profile_img" name="profile_img"  style="width:100%" onchange="angular.element(this).scope().uploadedFile(this)" ng-required="true">
                <p class="help-block">Please insert profile image here.</p>
<!--
                <span class="help-inline" ng-show="frmMembers.profile_img.$invalid && frmMembers.profile_img.$touched">

                </span>
-->

                </div>

            </form>
                            
            </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(modalstate, id)" ng-disabled="frmMembers.$invalid">Save changes</button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
        <script type="text/javascript" src="<?= asset('js/jquery.min.js') ?>"></script>
        
        <script type="text/javascript" src="<?= asset('js/bootstrap.min.js') ?>"></script>
        
        <script type="text/javascript" src="<?= asset('app/lib/angular/angular.min.js') ?>"></script>

        
        <!-- AngularJS Application Scripts -->
        <script type="text/javascript" src="<?= asset('app/app.js') ?>"></script>
        
        <script type="text/javascript" src="<?= asset('app/controllers/members.js') ?>"></script>

        
    </body>
</html>