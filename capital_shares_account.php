<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="sharesAccntsDataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Owner</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tbl_capital_shares = $db->display_members_capital_shares();
                    $i = 1;
                    if ($tbl_capital_shares->num_rows != 0) {
                        while ($fetch = $tbl_capital_shares->fetch_array()) {
                            ?>

                            <tr>
                                <td>
                                    <?php echo $i++; ?>
                                </td>
                                <td>
                                    <?php echo ucfirst($fetch['lastname']) . ", " . ucfirst($fetch['firstname']) . " " . substr(ucfirst($fetch['middlename']), 0, 1) . (strlen($fetch['middlename']) == 0 ? '' : '.') ?>
                                </td>
                                <td align="right">
                                    <?php echo "&#8369; " . ($fetch['total_balance'] ? number_format($fetch['total_balance'], 2) : number_format(0, 2)) ?>
                                </td>
                                <td align="center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item bg-success text-white" href="#" data-toggle="modal"
                                                data-target="#view-ledger<?php echo $fetch['user_id'] ?>">View
                                                Ledger</a>
                                            <a class="dropdown-item bg-primary text-white tugler" href="#" data-toggle="modal"
                                                data-target="#deposit-withdraw<?php echo $fetch['user_id'] ?>"
                                                data-balance="<?php echo $fetch['total_balance'] ?>">Add Share</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>


                            <!-- Deposit / Withdraw -->
                            <div class="modal fade" id="deposit-withdraw<?php echo $fetch['user_id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form method="POST" action="save_share.php">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title text-white">Add Capital Share</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <input type="hidden" name="user_id" value="<?php echo $fetch['user_id'] ?>">
                                            <input type="hidden" id="total_balance"
                                                value="<?php echo $fetch['total_balance'] ?>">
                                            <div class="modal-body">
                                                <div class="form-group col-xl-12 col-md-12">
                                                    <label>Owner</label>
                                                    <br />
                                                    <input type="text"
                                                        value="<?php echo ucfirst($fetch['lastname']) . ", " . ucfirst($fetch['firstname']) . " " . substr(ucfirst($fetch['middlename']), 0, 1) . (strlen($fetch['middlename']) == 0 ? '' : '.') ?>"
                                                        name="capital_share_owner" class="form-control" readonly="readonly" />
                                                </div>
                                                <div class="form-group col-xl-12 col-md-12">
                                                    <label>Total Capital Share</label>
                                                    <br />
                                                    <input type="text"
                                                        value="<?php echo '₱ ' . number_format($fetch['total_balance'], 2) ?>"
                                                        name="" class="form-control" readonly="readonly" />
                                                </div>
                                                <div class="form-group col-xl-12 col-md-12">
                                                    <label>Amount</label>
                                                    <br />
                                                    <input type="number" id="dep-wit-amount" name="amount" min="1"
                                                        class="form-control" />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-dismiss="modal">Cancel</button>
                                                <button type="submit" name="save-share" class="btn btn-primary">Save</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- View Capital Share Ledger details -->
                            <div class="modal fade" id="view-ledger<?php echo $fetch['user_id'] ?>" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content" role="document">
                                        <div class="modal-header bg-info">
                                            <h5 class="modal-title text-white">Capital Share Ledger</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="padding: 2rem !important;">
                                            <div class="row">
                                                <div class="col-md-6 col-xl-6">
                                                    <p>Account Owner:</p>
                                                    <p><strong>
                                                            <?php echo ucfirst($fetch['lastname']) . ", " . ucfirst($fetch['firstname']) . " " . substr(ucfirst($fetch['middlename']), 0, 1) . (strlen($fetch['middlename']) == 0 ? '' : '.') ?>
                                                        </strong></p>
                                                </div>
                                                <div class="col-md-6 col-xl-6">
                                                    <p>Total Capital Share:</p>
                                                    <p><strong>
                                                            <?php echo '₱ ' . number_format($fetch['total_balance'], 2) ?>
                                                        </strong></p>
                                                </div>
                                            </div>

                                            <?php
                                            $capital_shares = $db->display_capital_shares_by_user_id($fetch['user_id']);
                                            $show_capital_shares = $capital_shares->num_rows != 0 ? "" : "hidden";
                                            ?>

                                            <hr <?php echo $show_capital_shares; ?> />
                                            <div class="container" <?php echo $show_capital_shares; ?>>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <center>Date</center>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <center>Amount</center>
                                                    </div>
                                                </div>
                                                <hr />
                                                <?php
                                                while ($capital_share = $capital_shares->fetch_array()) {

                                                    ?>
                                                    <div class="row">
                                                        <div class="col-sm-6 p-2 pl-5"
                                                            style="border-right: 1px solid gray; border-bottom: 1px solid gray;">
                                                            <strong>
                                                                <?php echo date("F d, Y", strtotime($capital_share['tx_date'])); ?>
                                                            </strong>
                                                        </div>
                                                        <div class="col-sm-6 p-2 pr-5"
                                                            style="border-bottom: 1px solid gray;  text-align: right;">
                                                            <strong>
                                                                <?php echo "&#8369; " . number_format($capital_share['amount'], 2); ?>
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