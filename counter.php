<?php 
                                    include 'connectMySql.php';
                                    $query = "SELECT COUNT(membership_id) as count FROM membership 
                                        WHERE status = 1";
                                       $result = $conn->query($query);
                                       while($row = $result->fetch_assoc())
                                       {
                                            $cntmem = $row['count'];
                                        }
                                    $sql = "SELECT  COUNT(loan_id) AS cnt FROM `db_lms`.`loans`
                                    WHERE `status`='PENDING'";
                                    $query = "SELECT COUNT(membership_id) as count FROM membership 
                                    WHERE status = 1";
                                   $result = $conn->query($sql);
                                   while($row = $result->fetch_assoc())
                                   {
                                        $cntloan = $row['cnt'];
                                   }
                                    echo $cntmem + $cntloan;
                                    ?>