<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">


            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php"><div class="sidebar-brand-text mx-3">
                <?php  
            if($_SESSION['user_type'] == 1)
            {
                echo 'GENERAL MANAGER';
            } 
            else if($_SESSION['user_type'] == 2)
            {
                echo 'CASHIER';
            } 
            else if($_SESSION['user_type'] == 4)
            {
                echo 'TREASURER';
            } 
             ?></div>
                
            </a>


            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span></a>
            </li>

            <?php if ($_SESSION['user_type'] == 1): ?>
                <li class="nav-item">
                <a class="nav-link" href="message.php">
                    <i class="fas fa-fw fas fa-envelope"></i>
                    <span>Message</span></a>
            <?php endif; ?>
            

            <?php if ($_SESSION['user_type'] != 3): ?>
			<li class="nav-item">
                <a class="nav-link" href="membership.php">
                    <i class="fas fa-fw fas fa-house-user"></i>
                    <span>Membership request </span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="members.php">
                    <i class="fas fa-fw fas fa-user"></i>
                    <span>Members</span></a>
            </li>
            <?php endif; ?>

			<li class="nav-item">
                <a class="nav-link" href="loan.php">
                    <i class="fas fa-fw fas fa-comment-dollar"></i>
                    <span>Loans</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="payment.php">
                    <i class="fas fa-fw fas fa-coins"></i>
                    <span>Payments</span></a>
            </li>

            <?php if ($_SESSION['user_type'] == 4): ?>
            <li class="nav-item">
                <a class="nav-link" href="remitted_money.php">
                    <i class="fas fa-fw fas fa-money-bill-wave"></i>
                    <span>Remmited Money</span></a>
            </li>
            <?php endif; ?>


			<li class="nav-item">
                <a class="nav-link" href="saving.php">
                <i class="fas fa-fw fa-donate"></i>
                    <span>Savings</span></a>
            </li>
			<li class="nav-item">
				<a class="nav-link" href="capital_share.php">
					<i class="fas fa-fw fa-chart-pie"></i>
					<span>Capital Shares</span></a>
			</li>
            <li class="nav-item">
                <a class="nav-link" href="report.php">
                <i class="fas fa-fw fa-table"></i>
                    <span>Reports</span></a>
            </li>
            <?php if ($_SESSION['user_type'] == 1): ?>
			<!--<li class="nav-item">
                <a class="nav-link" href="loan_plan.php">
                    <i class="fas fa-fw fa-piggy-bank"></i>
                    <span>Loan Plans</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="loan_type.php">
                    <i class="fas fa-fw fa-money-check"></i>
                    <span>Loan Types</span></a>
            </li>!-->

            
                <li class="nav-item">
                    <a class="nav-link" href="user.php">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Users</span></a>
                </li>

                

                <li class="nav-item">
                    <a class="nav-link" href="announce.php">
                    <i class="fas fa-fw fa-bullhorn"></i>
                        <span>Content Management </span></a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                    <a class="nav-link" href="password.php">
                        <i class="fas fa-tools "></i>
                        <span>Change Password</span></a>
                </li>
		
        </ul>