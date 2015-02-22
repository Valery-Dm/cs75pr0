	 
	  <div class="footer navbar-fixed-bottom clear">
		  
			 <h3><?= htmlspecialchars($data['company_name'][0]) ?></h3>
			 <p>
				 <span class="glyphicon glyphicon-envelope"></span>
				 Our address: <?= htmlspecialchars($data['company_address'][0]) ?>
			 </p>
			 <p>
				 <span class="glyphicon glyphicon-phone"></span>
				 Phone: <?= htmlspecialchars($data['company_phone'][0]) ?>
			 </p>
			 <p>&copy; dmv 2015 
				| <a href="admin.php">Admin</a>
				| <a href="orders.php">Orders history</a>
			</p>
		 
	   </div>
	  
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../bootstrap/js/bootstrap.js"></script>
  </body>
</html>
