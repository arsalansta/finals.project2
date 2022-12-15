<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Instructors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
		  

  <body>
    <div class="container">
      
<?php
	$servername = "localhost";
$username = "amiresta_Final";
$password = "Ii-e@x&i=.M.";
$dbname = "amiresta_Medizone";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
      $sqlAdd = "insert into Doctor (Doctor_Name) value (?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("s", $_POST['iName']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Doctor added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Doctor set Doctor_Name=? where Doctor_ID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("si", $_POST['iName'], $_POST['iid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Doctor edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Doctor where Doctor_ID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['iid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Doctor deleted.</div>';
      break;
  }
}
	     <header id="header" class="header">
    <div class="header-nav navbar-fixed-top header-dark navbar-white navbar-transparent bg-transparent-1 navbar-sticky-animated animated-active">
      <div class="header-nav-wrapper">
        <div class="container">
          <nav id="menuzord-right" class="menuzord blue no-bg">
<a class="menuzord-brand pull-left flip xs-pull-center mb-15" style:height="auto" href="http://mis4013finalproject.amiresta.oucreate.com"><img src="Medical-health-care-logo-designPNG.png"  ></a>
            <ul class="menuzord-menu onepage-nav">
              <li class="active"><a href="#home">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#depertments">Departments</a></li>
              <li><a href="Doctor-Table.php">Doctors</a></li>
              <li><a href="Patient-Table.php">Patients</a></li>
              <li><a href="#pricing">Pricing</a></li>
              <li><a href="#gallery">Gallery</a></li>
              <li><a href="#contact">Contact</a></li>
              <li class="active"><a data-toggle="modal" data-target="#BSParentModal" href="ajax-load/form-appointment.html">Request an appointment</a></li>
              
	
          </nav>
        </div>
      </div>
    </div>
	</header>

      <h1>Doctors List</h1>
      <table class="table table-success table-striped">
        <thead>
          <tr>
            <th>Doctor ID</th>
            <th>Doctor Name</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
             
            </ul>
    
          
<?php
$sql = "SELECT Doctor_ID, Doctor_Name from Doctor";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
            <td><?=$row["Doctor_ID"]?></td>
            <td><a href="Doctor-section.php?id=<?=$row["Doctor_ID"]?>"><?=$row["Doctor_Name"]?></a></td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editDoctor<?=$row["Doctor_ID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editDoctor<?=$row["Doctor_ID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editDoctor<?=$row["Doctor_ID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editDoctor<?=$row["Doctor_ID"]?>Label">Edit Doctor</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editDoctor<?=$row["Doctor_ID"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editDoctor<?=$row["Doctor_ID"]?>Name" aria-describedby="editDoctor<?=$row["Doctor_ID"]?>Help" name="iName" value="<?=$row['Doctor_Name']?>">
                          <div id="editDoctor<?=$row["Doctor_ID"]?>Help" class="form-text">Enter the Doctor's name.</div>
                        </div>
                        <input type="hidden" name="iid" value="<?=$row['Doctor_ID']?>">
                        <input type="hidden" name="saveType" value="Edit">
                        <input type="submit" class="btn btn-primary" value="Submit">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <form method="post" action="">
                <input type="hidden" name="iid" value="<?=$row["Doctor_ID"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <input type="submit" class="btn" onclick="return confirm('Are you sure?')" value="Delete">
              </form>
            </td>
          </tr>
          
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
          
        </tbody>
      </table>
      <br />
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDoctor">
        Add New
      </button>
      <button type="button" class="btn btn-primary" href="index.html">
        Home
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addDoctor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addDoctorLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addDoctorLabel">Add Doctor</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="DoctorName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="DoctorName" aria-describedby="nameHelp" name="iName">
                  <div id="nameHelp" class="form-text">Enter the Doctor's name.</div>
                </div>
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
	  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
