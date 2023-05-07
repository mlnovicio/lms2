<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="savingsAccntsDataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Account Name</th>
                        <th>Owner</th>
                        <th>Amount</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tbl_savings_accnts = $_SESSION['user_type'] == 0 ? $db->display_savings_by_owner_id($_SESSION['user_id']) : $db->display_all_savings_account();
                    $i = 1;
                    if ($tbl_savings_accnts->num_rows != 0) {
                        while ($fetch = $tbl_savings_accnts->fetch_array()) {
                            ?>

                            <tr>
                                <td>
                                    <?php echo $i++; ?>
                                </td>
                                <td>
                                    <?php echo $fetch['account_name'] ?>
                                </td>
                                <td>
                                    <?php echo ucfirst($fetch['lastname']) . ", " . ucfirst($fetch['firstname']) . " " . substr(ucfirst($fetch['middlename']), 0, 1) . (strlen($fetch['middlename']) == 0 ? '' : '.') ?>
                                </td>
                                <td align="right">
                                    <?php echo "&#8369; " . ($fetch['total_balance'] ? number_format($fetch['total_balance'], 2) : number_format(0, 2)) ?>
                                </td>
                                <!-- <td align="center">
                                    <?php
                                    if ($_SESSION['user_type'] == 0):
                                        ?>
                                        <button class="btn btn-sm btn-secondary" href="#" data-toggle="modal"
                                            data-target="#view-ledger<?php echo $fetch['saving_account_id'] ?>">View Ledger</button>
                                    <?php endif; ?>
                                    <?php
                                    if ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2):
                                        ?>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item bg-success text-white" href="#" data-toggle="modal"
                                                    data-target="#view-ledger<?php echo $fetch['saving_account_id'] ?>">View
                                                    Ledger</a>
                                                <a class="dropdown-item bg-primary text-white tugler" href="#" data-toggle="modal"
                                                    data-target="#deposit-withdraw<?php echo $fetch['saving_account_id'] ?>"
                                                    data-balance="<?php echo $fetch['total_balance'] ?>">Deposit/Withdraw</a>
                                                <a class="dropdown-item bg-danger text-white " href="#" <?php echo $fetch['total_balance'] != 0 ? 'hidden' : ''; ?> data-toggle="modal"
                                                    data-target="#deactivate<?php echo $fetch['saving_account_id'] ?>">Deactivate</a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </td> -->
                            </tr>


                            <!-- Deposit / Withdraw -->
                            <div class="modal fade" id="deposit-withdraw<?php echo $fetch['saving_account_id'] ?>"
                                aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form method="POST" action="save_saving.php">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title text-white">Deposit / Withdraw</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <input type="hidden" name="account_id"
                                                value="<?php echo $fetch['saving_account_id'] ?>">
                                            <input type="hidden" id="total_balance"
                                                value="<?php echo $fetch['total_balance'] ?>">
                                            <div class="modal-body">
                                                <div class="form-group col-xl-12 col-md-12">
                                                    <label>Owner</label>
                                                    <br />
                                                    <input type="text"
                                                        value="<?php echo ucfirst($fetch['lastname']) . ", " . ucfirst($fetch['firstname']) . " " . substr(ucfirst($fetch['middlename']), 0, 1) ?>."
                                                        name="account_owner" class="form-control" readonly="readonly" />
                                                </div>
                                                <div class="form-group col-xl-12 col-md-12">
                                                    <label>Account Name</label>
                                                    <br />
                                                    <input type="text" value="<?php echo $fetch['account_name'] ?>"
                                                        name="account_name" class="form-control" readonly="readonly" />
                                                </div>
                                                <div class="form-group col-xl-12 col-md-12">
                                                    <label>Current Balance</label>
                                                    <br />
                                                    <input type="text"
                                                        value="<?php echo '₱ ' . number_format($fetch['total_balance'], 2) ?>"
                                                        name="" class="form-control" readonly="readonly" />
                                                </div>
                                                <div class="form-group col-xl-12 col-md-12">
                                                    <label>Transaction type</label>
                                                    <br />
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="tx_type"
                                                                value="1">Deposit
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="tx_type"
                                                                value="0">Withdraw
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-xl-12 col-md-12">
                                                    <label>Amount</label>
                                                    <br />
                                                    <!-- max="<?php echo $fetch['saving_account_id'] ?>" -->
                                                    <input type="number" id="dep-wit-amount" name="amount" min="1"
                                                        class="form-control" />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" name="save-saving" class="btn btn-primary">Save</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>



                            <!-- Deactivate Savings Account Modal -->

                            <div class="modal fade" id="deactivate<?php echo $fetch['saving_account_id'] ?>" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title text-white">System Information</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Are you sure you want to deactivate this
                                            savings account?
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                            <a class="btn btn-danger"
                                                href="deactivateSavingsAccount.php?account_id=<?php echo $fetch['saving_account_id'] ?>">Deactivate</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- View Loan details -->
                            <div class="modal fade" id="view-ledger<?php echo $fetch['saving_account_id'] ?>" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content" role="document">
                                        <div class="modal-header bg-info">
                                            <h5 class="modal-title text-white">Savings Ledger</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="padding: 2rem !important;">
                                            <div class="row">
                                                <div class="col-md-4 col-xl-4">
                                                    <p>Account No:</p>
                                                    <p><strong>
                                                            <?php echo $fetch['saving_account_id'] ?>
                                                        </strong></p>
                                                </div>
                                                <div class="col-md-4 col-xl-4">
                                                    <p>Account Name:</p>
                                                    <p><strong>
                                                            <?php echo $fetch['account_name'] ?>
                                                        </strong></p>
                                                </div>
                                                <div class="col-md-4 col-xl-4">
                                                    <p>Account Owner:</p>
                                                    <p><strong>
                                                            <?php echo ucfirst($fetch['lastname']) . ", " . ucfirst($fetch['firstname']) . " " . substr(ucfirst($fetch['middlename']), 0, 1) . (strlen($fetch['middlename']) == 0 ? '' : '.') ?>
                                                        </strong></p>
                                                </div>

                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-6 col-xl-6">
                                                    <p><small>Date opened: <strong>
                                                                <?php echo date("F d, Y", strtotime($fetch['date_created'])) ?>
                                                            </strong>
                                                        </small></p>
                                                </div>
                                                <div class="col-md-6 col-xl-6">
                                                    <p><small>Total Balance: <strong>
                                                                <?php echo '₱ ' . number_format($fetch['total_balance'], 2) ?>
                                                            </strong>
                                                        </small></p>

                                                </div>
                                            </div>

                                            <?php
                                            $savings = $db->display_savings_by_account_id($fetch['saving_account_id']);
                                            $show_savings = $savings->num_rows != 0 ? "" : "hidden";
                                            ?>

                                            <hr <?php echo $show_savings; ?> />
                                            <div class="container" <?php echo $show_savings; ?>>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <center>Date</center>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <center>Type</center>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <center>Amount</center>
                                                    </div>
                                                </div>
                                                <hr />
                                                <?php
                                                while ($saving = $savings->fetch_array()) {

                                                    ?>
                                                    <div class="row">
                                                        <div class="col-sm-4 p-2 pl-5"
                                                            style="border-right: 1px solid gray; border-bottom: 1px solid gray;">
                                                            <strong>
                                                                <?php echo date("F d, Y", strtotime($saving['tx_date'])); ?>
                                                            </strong>
                                                        </div>
                                                        <div class="col-sm-4 p-2 "
                                                            style="border-right: 1px solid gray; border-bottom: 1px solid gray; text-align: center;">
                                                            <strong>
                                                                <?php echo $saving['tx_type'] == 1 ? 'Deposit' : 'Withdraw'; ?>
                                                            </strong>
                                                        </div>
                                                        <div class="col-sm-4 p-2 pr-5"
                                                            style="border-bottom: 1px solid gray;  text-align: right;">
                                                            <strong>
                                                                <?php echo "&#8369; " . number_format($saving['amount'], 2); ?>
                                                            </strong>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>