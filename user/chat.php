<?php
	date_default_timezone_set("Etc/GMT+8");
	require_once'../session.php'; 
    user();
	require_once'../class.php';
	$db=new db_class(); 
?>
<?php
                            $tbl_loan=$db->displayMessage($_SESSION['user_id']);
                            while($fetch=$tbl_loan->fetch_array()){ ?>

                            
                            <div class="row" >
                                
                                <?php
                                if($fetch['sent']=="user"){?>
                                    <div class="form-group col-sm-12 text-right pr-5 pb-2">
                                    <span class="bg-primary text-white rounded-pill p-2"><?php echo $fetch['message']?></span>
                                    </div>       
                                <?php }
                                else if($fetch['sent']=="admin"){ ?>
                                    <div class="form-group col-sm-12 text-left pl-5 pb-2">
                                    <span class=" bg-success text-white rounded-pill p-2"><?php echo $fetch['message']?></span>
                                    </div>
                               <?php }
                                ?>
                                
                            </div>
                          
                            <?php }
                            ?>