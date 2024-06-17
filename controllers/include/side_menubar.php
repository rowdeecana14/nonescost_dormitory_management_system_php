<div class="col-md-3 left_col menu_fixed">
	<div class="left_col scroll-view">
	    <div class="navbar nav_title">
	        <a href="../dashboard/" class="site_title">
			<img src="../../images/dmms-sm.png" height="50px" /> NONESCOST
			</a>
	    </div>

	    <!-- menu profile quick info -->
	    <div class="profile clearfix">
	       
	        <div class="profile_pic">
	            <img src="<?php echo "../../images/UPLOADED/".$user_data['user_image']; ?>" style="width:55px; height:55px;" alt="..." class="img-circle profile_img">
	        </div>
	        <div class="profile_info">
	            <h2><b><?php echo ucwords($user_data['user_position']); ?></b></h2>
	            <span><i class="fa fa-circle text-success"></i> Online</span>
	        </div>
	         <!-- <span style="margin-left:6%; color: aqua; width: 100%;"><i class="fa fa-envelope">&nbsp;</i>admin@test.ocom&nbsp;</span> -->
	    </div>
	    <!-- /menu profile quick info -->
	    
	    <br />
	    <div id="sidebar-menu" class="main_menu_side main_menu hidden-print">
	        <div class="menu_section">
	            <h3>MENU</h3>
	            <ul class="nav side-menu">
	            	<li class="">
                        <a href="../dashboard/"><i class="fa fa-home"></i> Dashboard</a>
                    </li>
	               
	                <li>
	                    <a><i class="fa fa-edit"></i>Form <span class="fa fa-chevron-down"></span></a>
	                    <ul class="nav child_menu">
	                        <li><a href="../new tenant/">Tenant</a></li>
	                        <li><a href="../assign room/">Assign bed</a></li>
	                        <li><a href="../payment/">Payment</a></li>
	                        <li><a href="../checkout/">Checkout</a></li>
	                    </ul>
	                </li>
	                <li>
	                    <a><i class="fa fa-table"></i>Records <span class="fa fa-chevron-down"></span></a>
	                    <ul class="nav child_menu">
	                        <li><a href="../tenant/"> Tenant </a></li>
	                        <li><a href="../payment record/"> Payment </a></li>
	                        <li><a href="../report/"> Report </a></li>
	                    </ul>
	                </li>
	                <li class="">
                        <a href="../archieved_list"><i class="fa fa-database"></i> Archive</a>
                    </li>
	                <li>
	                    <a><i class="fa fa-cogs"></i> System Configuration <span class="fa fa-chevron-down"></span></a>
	                    <ul class="nav child_menu">
	                    	<li><a href="../room/">Room</a></li>
	                        <li><a href="../user/">Users</a></li><!-- 
	                        <li><a href="../database/">Database</a></li>
	                        <li><a href="../system/">System</a></li> -->
	                    </ul>
	                </li>
	                <li>
	                    <a><i class="fa fa-history"></i> Logs <span class="fa fa-chevron-down"></span></a>
	                    <ul class="nav child_menu">
	                        <li><a href="../tenant logs/">Tenants</a></li>
	                        <li><a href="../user logs/">Users </a></li>

	                    </ul>
	                </li>
	            </ul>
	        </div>
	    </div>
	</div>
</div>