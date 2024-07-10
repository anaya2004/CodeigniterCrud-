<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>form</title>

</head>
<body>
    <div class ="container">
        <?php if(!empty($arr->id)){
                      echo form_open_multipart('TempController/update_data', ['method' => 'post', 'enctype' => 'multipart/form-data']); 

        }else {
            // for image
                     echo form_open('TempController/myfunc',['method'=>'post','enctype'=>'multipart-formdata']);
                    //  echo form_open_multipart('TempController/myfunc');
        }   ?>
        
        <div class ="row mt-5">
            <div class="col-md-12 col-lg-12">
                <div class ="col-md-6 col-lg-6 mb-3">
                    <label>FULL NAME</label>
                    <input type ="text" name ="name" value = "<?php echo set_value('name',(!empty($arr->name) ? $arr->name :''))?>"  class ="form-control" placeholder="Full name">
                    <?php echo form_error('name'); ?>
                </div>
                <div class ="col-md-6 col-lg-6 mb-3">
                    <label>EMAIL</label>
                    <input type ="email" name ="email" value = "<?php echo set_value('email',(!empty($arr->email) ? $arr->email :''))?>" class ="form-control" placeholder="Email">
                    <?php echo form_error('email'); ?>

                </div>
                <div class ="col-md-6 col-lg-6 mb-3">
                    <label>CONTACT</label>
                    <input type ="text" name ="contact" value = "<?php echo set_value('contact',(!empty($arr->contact) ? $arr->contact :''))?>" class ="form-control" placeholder="Phone Number">
                    <?php echo form_error('contact'); ?>

                </div>
                <div class ="col-md-6 col-lg-6 mb-3">
                    <label>Password</label>
                    <input type ="password" name ="password" class ="form-control" placeholder="Password">
                    <?php echo form_error('password'); ?>

                </div>
                <div class ="col-md-6 col-lg-6 mb-3">
                    <label>LANGUAGE</label>
                    <select class = "form-control" name ="language">
                        <option value ="">select</option>
                        <option value ="PHP" <?php if(!empty($arr->id) && $arr->language == 'PHP'){echo "selected";}?>>PHP</option>
                        <option value ="JAVA"<?php if(!empty($arr->id) && $arr->language == 'JAVA'){echo "selected";}?>>JAVA</option>
                        <option value ="PYTHON"<?php if(!empty($arr->id) && $arr->language == 'PYTHON'){echo "selected";}?>>PYTHON</option>
                        <option value ="C++"<?php if(!empty($arr->id) && $arr->language == 'C++'){echo "selected";}?>>C++</option>
                    </select>
                    <?php echo form_error('language'); ?>
                </div>
                <div class ="col-md-6 col-lg-6 mb-3">
                    <label>GENDER</label>
                    <div>
                    <input type ="radio" name ="gender" value ="Male"<?php if(!empty($arr->id) && $arr->gender == 'Male'){echo "checked";}?>>Male
                    <input type ="radio" name ="gender" value ="Female"<?php if(!empty($arr->id) && $arr->gender == 'Female'){echo "checked";}?>>Female
                    </div>  
                </div>
                <!-- for image upload  -->
                <div class="form-group">
                <label for="image">Profile Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
                <?php echo form_error('image'); ?>
                </div>
                <br>
                <div style ="background-color:white">
                <input type ="hidden"  value ="<?= $arr->id ?? ''?>" name="id">
                <input type ="submit"  value ="SignUp" class="btn btn-outline-primary text-dark">
                </div>
              <?php echo form_close();?>

                <br>
                <!-- <div style ="background-color:white">
                <a href="<?php echo base_url('TempController/login'); ?>" type ="submit" class="btn btn-outline-primary text-dark">SignIn</a>
                </div> -->
            </div>
        </div>
        <div style ="background-color:white">
                <a href="<?php echo base_url('TempController/login'); ?>" type ="submit" class="btn btn-outline-primary text-dark">SignIn</a>
                </div>
        <!-- <?php echo form_close();?> -->
    </div>
</body>
</html>
