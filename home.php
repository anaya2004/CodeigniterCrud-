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
    <div class ="container mt-5">
       <!-- Display welcome message if available -->
       <?php if(isset($welcome_msg)): ?>
            <div class="alert alert-success shadow p-3 mb-5 bg-body-tertiary rounded" role="alert">
               Welcome <?php echo "$welcome_msg"; ?>!
            </div>
        <?php endif; ?>
        <!-- Display welcome message with user's name -->
        <!-- <?php if(isset($user_data)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo "Welcome " ?>
                <?php echo $user_data; ?>
            </div>
        <?php endif; ?> -->
        <!-- Logout button -->
        <a href="<?php echo base_url('TempController/logout'); ?>" class="btn btn-primary">Logout</a>
    <table class="table table-bordered">
  <thead class ="p-3 mb-2 bg-dark text-white">
    <tr>
      <th scope="col">SNo</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Contact</th>
      <th scope="col">Language</th>
      <th scope="col">Gender</th>
     <th scope="col">Image</th>
      <th scope="col">Status</th>
      <th scope="col">Added On</th>
     <th colspan="2">Action</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    <?php   if(!empty($arr)){
        foreach($arr as $key=>$value){
            if($value->status == '1'){
                $status = '<span class = "spinner-grow text-success"></span>';
            }else{
                $status = '<span class = "spinner-grow text-danger"></span>';
            }

         ?>
     <tr>
      <td><?php echo++$key?></td>
      <td><?php echo$value->name?></td>
      <td><?php echo$value->email?></td>
      <td><?php echo$value->contact?></td>
      <td><?php echo$value->language?></td>
      <td><?php echo$value->gender?></td>
      <td><img src ="<?php echo base_url()?>/uploads/<?php echo $value->image?>" width ="100px" alt =""></td>
      <td><?php echo$status?></td>
      <td><?php echo$value->added_on?></td>
      <!-- Display user's profile image -->
<!-- <?php if(isset($user_image)): ?>
    <div class="user-image">
        <img src="<?php echo base_url('uploads/'.$user_image); ?>" alt="Profile Image" class="img-fluid">
    </div>
<?php endif; ?> -->

      <td><a href="<?php echo base_url('TempController/all_data/'.$value->id); ?>" class="btn btn-outline-primary">Update</a></td>
      <td><a href="<?php echo base_url('TempController/delete_data/'.$value->id); ?>" class="btn btn-outline-danger delete-btn" >Delete</a></td>
      <!-- <?php echo$value->id?> -->
      <!-- <td><a href = "TempController/all_data/<?php echo$value->id?>" class ="btn btn-outline-primary">Update</a></td>
      <td>Delete</td> -->

    </tr>
    
    <?php }}else { ?>
        <tr>
        <td colspan = "10" class ="text-center">NO RECORD FOUND</td>
        </tr>
    <?php    }?>
  </tbody>
</table>
    </div>


    <script>
        // JavaScript for displaying delete success alert
        $(document).ready(function(){
            $(".delete-btn").on("click", function(){
                if(confirm("Are you sure you want to delete this data?")){
                    alert("Data deleted successfully!");
                }
                else {
                    return false;
                }
            });
        });
    </script>

</body>
</html>
