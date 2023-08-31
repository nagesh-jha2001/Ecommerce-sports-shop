<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if (isset($_POST['dlscno'])) {
	$_SESSION['dlscno'] = filter_var($_POST['dlscno'], FILTER_SANITIZE_NUMBER_INT);
	header('Location:order-single.php');
}


// print_r($_SESSION);die; 


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&amp;family=Roboto&amp;display=swap" />
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


	<!--plugins-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<!--Datatables-->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

</head>

<body>

    <?php include 'components/user_header.php'; ?>

    <section class="orders">

        <h1 class="heading">placed orders</h1>

        <div class="" style="font-size:20px">

     
            <div class="card-deck flex-column flex-lg-row">
						<div class="card radius-15">
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Sl</th>
												<th>Name</th>
												<th>Date</th>
												<th>Total Amount</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
                              <?php
											$i = 1;
											$query = $conn->query("select * from orders where user_id= '$user_id' ");
											while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>
												<tr>
                                    <td><?php echo $i;
														$i++; ?></td>
													<td><?php echo $row['name']  ?></td>
													<td><?php echo $row['placed_on']  ?></td>
													<td><?php echo $row['total_price']  ?></td>
													
													<td><form method="post">
															<button class="btn btn-primary btn-block " style="font-size:20px" value="<?php echo $row['id'] ?>" name="dlscno"> <i class="fa fa-arrow-right"></i>View Order </button>
														</form></td>

												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>


					</div>
            <?php
   
   
   ?>

        </div>

    </section>













    <?php include 'components/footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>