<div class="single_product">
    <div class="container">
        <div class="row">
            <!--Table-->
                            <div class="col-sm-6" style="padding:0px;">
                            <h3>Users</h3>
                            </div>
                            <!-- /.col-sm-6 -->
                            <div class="col-sm-6 text-right" style="padding:0px;">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#insertUser">Add User</button>
                            </div>
                            <!-- /.col-sm-6 -->
                            
        <table id="tablePreview" class="table table-sm table-striped table-hover">
        <!--Table head-->
        <thead class="bg-primary" style="color:white;">
            <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Date</th>
            <th>Active</th>
            <th>Role Name</th>
            <th>Options</th>
            </tr>
        </thead>
        <!--Table head-->
        <!--Table body-->
        <tbody>
            <?php $ubr=1; foreach($users as $user):?>
            <tr>
            <th scope="row"><?=$ubr?></th>
            <td><?=$user->first_name?></td>
            <td><?=$user->last_name?></td>
            <td><?=$user->email?></td>
            <td><?=$user->created_at?></td>
            <td><?=$user->active ? "Yes": "No"?></td>
            <td><?=$user->role_name?></td>
            <td><button type="button" data-toggle="modal" data-target="#editUser" class="btn btn-outline-primary btn-sm update-user" data-id="<?=$user->id;?>">Update</button> 
            <button type="button" class="btn btn-outline-primary btn-sm delete-user" data-id="<?=$user->id;?>">Delete</button></td>
            </tr>
            <?php $ubr++; endforeach?>
        </tbody>
        <!--Table body-->
        </table>
        <h3>Actions</h3>
        <table id="tablePreview" class="table table-sm table-striped table-hover">
        <!--Table head-->
        <thead class="bg-primary" style="color:white;">
            <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Table</th>
            <th>Action</th>
            <th>Notification</th>
            <th>Date</th>
            <th>Ip Address</th>
            </tr>
        </thead>
        <!--Table head-->
        <!--Table body-->
        <tbody>
            <?php $ubr=1; foreach($actions as $action):?>
            <tr>
            <th scope="row"><?=$ubr?></th>
            <td><?=$action->first_name?></td>
            <td><?=$action->last_name?></td>
            <td><?=$action->table_name?></td>
            <td><?=$action->action?></td>
            <td><?=$action->notification?></td>
            <td><?=$action->executed_at?></td>
            <td><?=$action->ip_address?></td>
            </td>
            </tr>
            <?php $ubr++; endforeach?>
        </tbody>
        <!--Table body-->
        </table>
        
        <div class="col-sm-6" style="padding:0px;">
                            <h3>Products</h3>
                            </div>
                            <!-- /.col-sm-6 -->
                            <div class="col-sm-6 text-right" style="padding:0px;">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#insertProduct">Add Product</button>
                            </div>
        <table id="tablePreview" class="table table-sm table-striped table-hover">
        <!--Table head-->
        <thead class="bg-primary" style="color:white;">
            <tr>
            <th>#</th>
            <th>Categroy</th>
            <th>Brand</th>
            <th>Product</th>
            <th>Price</th>
            <th>Description</th>
            <th>In Stock</th>
            <th>Available Colors</th>
            <th>Options</th>
            </tr>
        </thead>
        <!--Table head-->
        <!--Table body-->
        <tbody>
            <?php $ubr=1; foreach($products as $item):?>
            <tr>
            <th scope="row"><?=$ubr?></th>
            <td><?=$item->cat_name?></td>
            <td><?=$item->brand_name?></td>
            <td><?=$item->name?></td>
            <td>$<?=$item->price?></td>
            <td><?=$item->description?></td>
            <td><?=$item->in_stock?></td>
            <td>
                <?php
                $output = [];
                foreach($item->colors as $color){
                    $output[] = $color->name;
                } echo implode(", ", $output);?>
            </td>
            <td><button type="button" data-toggle="modal" data-target="#updateProduct" class="btn btn-outline-primary btn-sm update-product" data-id="<?=$item->id;?>">Update</button> 
            <button class="btn btn-outline-primary btn-sm delete-product" data-id="<?=$item->id;?>" onclick="obrisiProizvod(<?=$item->id;?>)">Delete</button></td>
            </tr>
            <?php $ubr++; endforeach?>
        </tbody>
        <!--Table body-->
        </table>
        <!--Table-->
                
        </div>
        <div class="row">
       <div class="col-sm-4">
           <div class="row">
       <div class="col-sm-6">
                            <h3>Categories</h3>
                            </div>
                            <!-- /.col-sm-6 -->
                            <div class="col-sm-6 text-right">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#insertModel">Add Category</button>
                            </div></div>
         <table id="tablePreview" class="table table-sm table-striped table-hover">
        <!--Table head-->
        <thead class="bg-primary" style="color:white;">
            <tr>
            <th>#</th>
            <th>Name</th>
            <th>Options</th>
            </tr>
        </thead>
        <!--Table head-->
        <!--Table body-->
        <tbody>
            <?php $ubr=1; foreach($categories as $cat):?>
            <tr>
            <th scope="row"><?=$ubr?></th>
            <td><?=$cat->name?></td>
            <td>
            <button type="button" class="btn btn-outline-primary btn-sm delete-post" onclick="obrisiKategoriju(<?=$cat->id;?>)" data-id="<?=$cat->id;?>">Delete</button></td>
            </tr>
            <?php $ubr++; endforeach?>
        </tbody>
        <!--Table body-->
        </table>
       </div>
       <!-- /.col-sm-4 -->
       <div class="col-sm-4">
       <div class="row">
       <div class="col-sm-6">
                            <h3>Brands</h3>
                            </div>
                            <!-- /.col-sm-6 -->
                            <div class="col-sm-6 text-right">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#insertModel">Add Brand</button>
                            </div></div>
       <table id="tablePreview" class="table table-sm table-striped table-hover">
        <!--Table head-->
        <thead class="bg-primary" style="color:white;">
            <tr>
            <th>#</th>
            <th>Name</th>
            <th>Options</th>
            </tr>
        </thead>
        <!--Table head-->
        <!--Table body-->
        <tbody>
            <?php $ubr=1; foreach($brands as $cat):?>
            <tr>
            <th scope="row"><?=$ubr?></th>
            <td><?=$cat->name?></td>
            <td>
            <button type="button" class="btn btn-outline-primary btn-sm delete-post" onclick="obrisiBrend(<?=$cat->id;?>)" data-id="<?=$cat->id;?>">Delete</button></td>
            </tr>
            <?php $ubr++; endforeach?>
        </tbody>
        <!--Table body-->
        </table>
       </div>
       <!-- /.col-sm-4 -->
       <div class="col-sm-4">
       <div class="row">
       <div class="col-sm-6">
                            <h3>Colors</h3>
                            </div>
                            <!-- /.col-sm-6 -->
                            <div class="col-sm-6 text-right">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#insertModel">Add Color</button>
                            </div></div>
       <table id="tablePreview" class="table table-sm table-striped table-hover">
        <!--Table head-->
        <thead class="bg-primary" style="color:white;">
            <tr>
            <th>#</th>
            <th>Name</th>
            <th>Code</th>
            <th>Options</th>
            </tr>
        </thead>
        <!--Table head-->
        <!--Table body-->
        <tbody>
            <?php $ubr=1; foreach($colors as $cat):?>
            <tr>
            <th scope="row"><?=$ubr?></th>
            <td><?=$cat->name?></td>
            <td><?=$cat->code?></td>
            <td> 
            <button type="button" class="btn btn-outline-primary btn-sm delete-post" data-id="<?=$cat->id;?>">Delete</button></td>
            </tr>
            <?php $ubr++; endforeach?>
        </tbody>
        <!--Table body-->
        </table>
       </div>
       <!-- /.col-sm-4 -->
  </div>
    </div>
</div>

<!-- Modali -->
<!-- Insert Product -->
<div class="modal fade" id="insertProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
	<form method="post" action="<?=$base_url?>/insertproduct" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Insert Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--body-->
          <!-- <div class="form-group row">
        <label for="post_id" class="col-sm-2 col-form-label">IdPost*</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name="nesto" id="post_id" readonly>
        </div>
    </div> -->
    <div class="form-group row">
        <label for="category" class="col-sm-2 col-form-label">Category*</label>
        <div class="col-sm-10">
            <select class="custom-select" id="category" name="cat_id">
	            <option selected value="0">Select Category</option>
                <?php foreach($categories as $cat):?>
                    <option value="<?=$cat->id?>"><?=$cat->name?></option>
                <?php endforeach?>
	        </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="brand" class="col-sm-2 col-form-label">Brand*</label>
        <div class="col-sm-10">
            <select class="custom-select" id="brand" name="brand_id">
            <option selected value="0">Select Brand</option>
            <?php foreach($brands as $cat):?>
                    <option value="<?=$cat->id?>"><?=$cat->name?></option>
                <?php endforeach?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Product</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name">
        </div>
    </div>
    <div class="form-group row">
        <label for="price" class="col-sm-2 col-form-label">Price</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="price">
        </div>
    </div>
    <div class="form-group row">
        <label for="count" class="col-sm-2 col-form-label">In Stock</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" name="count">
        </div>
    </div>
    <div class="form-group row">
        <label for="body_type" class="col-sm-2 col-form-label">Colors</label>
        <div class="col-sm-10">
        <?php foreach ($colors as $color):?>
			<li class="color">
			<label class="custom-control custom-checkbox">
			<input type="checkbox" name="color_ids[]" class="custom-control-input" value="<?=$color->id?>">
			<span class="custom-control-indicator"></span>
			<span class="custom-control-description" style="padding-top:3px;color:rgba(0,0,0,0.5);"><a href="#" style="background: <?=$color->code?>;"></a></span>
			</label>
			</li>
		<?php endforeach?>
        </div>
    </div>
    <div class="form-group row">
        <label for="body_type" class="col-sm-2 col-form-label">Image</label>
        <div class="col-sm-10">
            <input type="file" id="inputGroupFile02" name="img"/>
            
        </div>
    </div>
    <div class="form-group">
        <label for="exampleTextarea">Description</label>
        <textarea class="form-control" id="exampleTextarea" rows="4" name="desc"></textarea>
    </div>
        <!--/body-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="btnUpdatePostId">Save changes</button>
      </div>
	  </form>
    </div>
  </div>
</div>

<!-- Update Product -->
<div class="modal fade" id="updateProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
	<form method="post" action="<?=$base_url?>/editproduct" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--body-->
          <div class="form-group row">
        <label for="post_id" class="col-sm-2 col-form-label">Id</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name="product_id" id="product_id" readonly value="5">
        </div>
    </div>
    <div class="form-group row">
        <label for="category" class="col-sm-2 col-form-label">Category</label>
        <div class="col-sm-10">
            <select class="custom-select" id="upcategory" name="cat_id">
	            <option selected value="0">Select Category</option>
                <?php foreach($categories as $cat):?>
                    <option value="<?=$cat->id?>"><?=$cat->name?></option>
                <?php endforeach?>
	        </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="brand" class="col-sm-2 col-form-label">Brand</label>
        <div class="col-sm-10">
            <select class="custom-select" id="upbrand" name="brand_id">
            <option selected value="0">Select Brand</option>
            <?php foreach($brands as $cat):?>
                    <option value="<?=$cat->id?>"><?=$cat->name?></option>
                <?php endforeach?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Product</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" id="upname">
        </div>
    </div>
    <div class="form-group row">
        <label for="price" class="col-sm-2 col-form-label">Price</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="price" id="upprice">
        </div>
    </div>
    <div class="form-group row">
        <label for="count" class="col-sm-2 col-form-label">In Stock</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" name="count" id="upin_stock">
        </div>
    </div>
    <div class="form-group row">
        <label for="body_type" class="col-sm-2 col-form-label">Colors</label>
        <div class="col-sm-10">
        <?php foreach ($colors as $color):?>
			<li class="color">
			<label class="custom-control custom-checkbox">
			<input type="checkbox" name="color_ids[]" class="custom-control-input upcolor_ids" value="<?=$color->id?>">
			<span class="custom-control-indicator"></span>
			<span class="custom-control-description" style="padding-top:3px;color:rgba(0,0,0,0.5);"><a href="#" style="background: <?=$color->code?>;"></a></span>
			</label>
			</li>
		<?php endforeach?>
        </div>
    </div>
    <div class="form-group row">
        <label for="body_type" class="col-sm-2 col-form-label">Image</label>
        <div class="col-sm-10">
            <input type="file" id="inputGroupFile02" name="img"/>
            
        </div>
    </div>
    <div class="form-group">
        <label for="exampleTextarea">Description</label>
        <textarea class="form-control" rows="4" name="desc" id="updesc"></textarea>
    </div>
        <!--/body-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="btnUpdatePostId">Save changes</button>
      </div>
	  </form>
    </div>
  </div>
</div>

<!-- Inser User -->
<div class="modal fade" id="insertUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
	<form method="post" action="#">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Insert User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">First Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" id="ifname">
        </div>
    </div>
    <div class="form-group row">
        <label for="price" class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="price" id="ilname">
        </div>
    </div>
    <div class="form-group row">
        <label for="count" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="count" id="iemail">
        </div>
    </div>
    <div class="form-group row">
        <label for="count" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="count" id="ipassword">
        </div>
    </div>
    <div class="form-group row">
        <label for="count" class="col-sm-2 col-form-label">Active</label>
        <div class="col-sm-10">
        <select class="custom-select" id="iactive" name="cat_id">
	            <option selected value="2">Slect Active Status</option>
                <option value="0">No</option>
                <option value="1">Yes</option>
	        </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="category" class="col-sm-2 col-form-label">Role</label>
        <div class="col-sm-10">
            <select class="custom-select" id="irole" name="cat_id">
	            <option selected value="0">Slect Role</option>
                <?php foreach($roles as $cat):?>
                    <option value="<?=$cat->id?>"><?=$cat->name?></option>
                <?php endforeach?>
	        </select>
        </div>
    </div>
        <!--/body-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="add-user">Save changes</button>
      </div>
	  </form>
    </div>
  </div>
</div>

<!-- Update User -->
<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
	<form method="post" action="#">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Insert User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
        <label for="post_id" class="col-sm-2 col-form-label">Id</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" name="nesto" id="u_id" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">First Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="fname" id="ufname">
        </div>
    </div>
    <div class="form-group row">
        <label for="price" class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="lname" id="ulname">
        </div>
    </div>
    <div class="form-group row">
        <label for="count" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="" id="uemail">
        </div>
    </div>
    <div class="form-group row">
        <label for="count" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="upassword">
        </div>
    </div>
    <div class="form-group row">
        <label for="count" class="col-sm-2 col-form-label">Active</label>
        <div class="col-sm-10">
        <select class="custom-select" id="uactive" name="cat_id">
	            <option selected value="2">Slect Active Status</option>
                <option value="0">No</option>
                <option value="1">Yes</option>
	        </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="category" class="col-sm-2 col-form-label">Role</label>
        <div class="col-sm-10">
            <select class="custom-select" id="u_role" name="cat_id">
	            <option selected value="0">Slect Role</option>
                <?php foreach($roles as $cat):?>
                    <option value="<?=$cat->id?>"><?=$cat->name?></option>
                <?php endforeach?>
	        </select>
        </div>
    </div>
        <!--/body-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update_user">Save changes</button>
      </div>
	  </form>
    </div>
  </div>
</div>