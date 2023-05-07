<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="savingsTxDataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Account Name</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tbl_savings_tx = $db->display_savings_transactions();
                    $i = 1;
                    while ($fetch = $tbl_savings_tx->fetch_array()) {
                        ?>

                        <tr>
                            <td>
                                <?php echo $i++; ?>
                            </td>
                            <td>
                                <?php echo $fetch['account_name'] ?>
                            </td>
                            <td>
                                <?php echo $fetch['tx_type'] == 1 ? 'Deposit' : 'Withdraw' ?>
                            </td>
                            <td align="right">
                                <?php echo "&#8369; " . number_format($fetch['amount'], 2); ?>
                            </td>
                            <td>
                                <?php echo date("F d, Y", strtotime($fetch['tx_date'])) ?>
                            </td>
                            <td align="center">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item bg-warning text-white" href="#" data-toggle="modal"
                                            data-target="#updateSavingsTx<?php echo $fetch['savings_id'] ?>">Edit</a>
                                        <a class="dropdown-item bg-danger text-white " href="#" data-toggle="modal"
                                            data-target="#deleteSavingsTx<?php echo $fetch['savings_id'] ?>">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>


                        <!-- Update transaction modal -->
                        <div class="modal fade" id="updateSavingsTx<?php echo $fetch['savings_id'] ?>" aria-hidden="true">
                            <div class="modal-dialog modal-md">
                                <form method="POST" action="save_saving.php">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title text-white">Edit Deposit / Withdraw</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <input type="hidden" name="account_id_update"
                                            value="<?php echo $fetch['saving_account_id'] ?>">
                                        <input type="hidden" name="savings_id" value="<?php echo $fetch['savings_id'] ?>">
                                        <input type="hidden" id="total_balance_update"
                                            value="<?php echo $fetch['total_balance'] ?>">
                                        <input type="hidden" id="current_tx_amount" value="<?php echo $fetch['amount'] ?>">
                                        <div class="modal-body">
                                            <div class="form-group col-xl-12 col-md-12">
                                                <label>Owner</label>
                                                <br />
                                                <input type="text"
                                                    value="<?php echo ucfirst($fetch['lastname']) . ", " . ucfirst($fetch['firstname']) . " " . substr(ucfirst($fetch['middlename']), 0, 1) ?>."
                                                    name="account_owner_update" class="form-control" readonly="readonly" />
                                            </div>
                                            <div class="form-group col-xl-12 col-md-12">
                                                <label>Account Name</label>
                                                <br />
                                                <input type="text" value="<?php echo $fetch['account_name'] ?>"
                                                    name="account_name_update" class="form-control" readonly="readonly" />
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
                                                        <input type="radio" class="form-check-input" name="tx_type_update"
                                                            value="1" <?php echo $fetch['tx_type'] == 1 ? 'checked' : '' ?>>Deposit
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="tx_type_update"
                                                            value="0" <?php echo $fetch['tx_type'] == 0 ? 'checked' : '' ?>>Withdraw
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group col-xl-12 col-md-12">
                                                <label>Amount</label>
                                                <br />
                                                <!-- max="<?php echo $fetch['saving_account_id'] ?>" -->
                                                <input type="number" id="dep-wit-amount-update" name="amount_update" min="1"
                                                    value="<?php echo abs($fetch['amount']); ?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="update-saving" class="btn btn-primary">Save</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Delete Savings Tx Modal -->
                        <div class="modal fade" id="deleteSavingsTx<?php echo $fetch['savings_id'] ?>" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h5 class="modal-title text-white">System Information</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Are you sure you want to delete this transaction?
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <a class="btn btn-danger"
                                            href="deleteSavingsTransaction.php?savings_id=<?php echo $fetch['savings_id'] ?>">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>