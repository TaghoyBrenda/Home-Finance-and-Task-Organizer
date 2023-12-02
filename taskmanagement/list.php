<?php
    include("../connection/config.php");   
    include("../sidebar.php");
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel = "stylesheet" href = "list.css">     
    <link rel="stylesheet" href="sidebar.css"/>
    <title>Daily Task Management List</title>

</head>
<body>

    
    <hr>
    <div class="container">
        <h2>Task Management List</h2>

        <div class="create">
                <!-- bootstrap button connected sa modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                Create
                </button>
                </div>


  <table class="table">
                   <thead class= "table-dark" style = "background-color: blue;" id = "t">
                        <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Assignee</th>
                        <th scope="col">Date</th>
                        <th scope="col">To-DO list</th>
                        <th scope="col">Remaining Task</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
         <?php

            $sql = "SELECT * FROM lists";

            $result = mysqli_query($conn,$sql);

            $number = 1;

            while($test = mysqli_fetch_assoc($result)){

                $id = $test['id'];

                echo'

                <tr>
                <td>'.$number.'</td>
                <td>'.$test['Assignee'].'</td>
                <td>'.$test['Date'].'</td>
                <td>'.$test['To_Do_List'].'</td>
                <td>'.$test['Remaining_Task'].'</td>
                <td>
                    <button class = "btn btn-outline-success" onclick = "edit('.$id.')" >EDIT</button>
                    <button class = "btn btn-outline-danger" onclick = "Delete('.$id.')">REMOVE TASK</button>
                    
                </td>
              </tr>

                ';

                $number++;


            }


        ?>


    <!-- Modal -->
    <form  action = "list.php" method = "post">
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add List</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    
        <label>Assignee</label>
        <input type="text" name="a" id = "a" class = "form-control" placeholder="Enter Name">
     
        <label>Date</label>
        <input type="date" name="b" id = "b" class = "form-control" placeholder="MM/DD/YY">
        
        <label>To Do List</label>
        <input type="text" name="c" id = "c" class = "form-control" placeholder="Enter to do list">
    
        <label>Remaining Task</label>
        <input type="text" name="d" id = "d"  class = "form-control" placeholder="Enter Remaining Task">
        
   

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick = "Add()">Add</button>
        
      
       
      </div>
    </div>
  </div>
</div>









<div class="modal fade" id="EDITmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">EDIT INFORMATION</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    
      <label>Assignee</label>
        <input type="text" name="a" id = "Ea" class = "form-control" placeholder="Enter Name">
     
        <label>Date</label>
        <input type="date" name="b" id = "Eb" class = "form-control" placeholder="MM/DD/YY">
        
        <label>To Do List</label>
        <input type="text" name="c" id = "Ec" class = "form-control" placeholder="Enter to do list">
    
        <label>Remaining Task</label>
        <input type="text" name="d" id = "Ed"  class = "form-control" placeholder="Enter Remaining Task">
        
   
   

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button  name="add" class="btn btn-primary" onclick = "toEdit()">EDIT</button>
        <input type = "hidden" id = "hiddenID">
       
      </div>
    </div>
  </div>
</div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>




    <script>

            function edit(id) {
                $('#hiddenID').val(id);
                $('#EDITmodal').modal('show'); // Corrected the ID here
            }



    function Delete(id) {

        $.ajax({
            url: "../ajax/admin_ajax.php",
            type: 'post',
            data: {
                DeleteId:id
            },
            success: function (data, status) {
                refreshIfClose();
            }
        });
    }

 
    
    
    function Add(){
       

        var assignee = $('#a').val();
        var date = $('#b').val();
        var Todo = $('#c').val();
        var remainingTask = $('#d').val();
        var click = true;
       

        $.ajax({
            url: "../ajax/admin_ajax.php",
            type: 'post',
            data: {

                a:assignee,
                b:date,
                c:Todo,
                d:remainingTask,
                click:click
                
            },
            success: function (data, status) {
              
                $('#create').modal('hide');
                refreshIfClose();
            }
        });


    }


    function toEdit(){

        var id = $('#hiddenID').val();
        var a = $('#Ea').val();
        var b = $('#Eb').val();
        var c = $('#Ec').val();
        var d = $('#Ed').val();



$.ajax({
       url: "../ajax/admin_ajax.php",
       type: 'post',
       data: {


            editing:id,
           a:a,
           b:b,
           c:c,
           d:d
          


           

       },
       success: function (data, status) {
           refreshIfClose();
       }
   });
     

}



    function refreshIfClose() {
        location.reload();
    }
</script>

</body>
</html>



