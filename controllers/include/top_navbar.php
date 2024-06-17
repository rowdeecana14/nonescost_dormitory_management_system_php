<div class="top_nav hidden-print">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo "../../images/UPLOADED/".$user_data['user_image']; ?>" alt=""> 
                        <?php echo ucwords($user_data['user_fname'])." ".ucwords($user_data['user_lname'])." "; ?> 
                        <span class=" fa fa-angle-down"> </span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="../user profile/"><i class="fa fa-info-circle pull-right"></i><b>Profile</b></a></li>
                        <li><a href="../../controllers/logout.php" style="color: red;"><i class="glyphicon glyphicon-log-out pull-right"></i><b>Log Out</b></a></li>
                    </ul>
                </li>
                
                <li class="fa fa-clock-o" aria-hidden="true" style="font-size: 30px; padding: 3px; margin-top: 1%"> <b>
                	<span id="clock" style="font-size: 30px; color: #7745a2;text-shadow: 2px 2px 4px #75aad0; ">11:15:40 AM</span></b>
                </li>
            </ul>
            
        </nav>
    </div>
</div>