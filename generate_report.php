<?php
require 'vendor/autoload.php';
require_once './class.php';
require_once 'session.php';
$db = new db_class();

// use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// styles
$boldStyle = [
    'font' => [
        'bold' => true,
    ],
];
$thStyleArray = [
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '808080'],
        ],
    ]
];
$tdStyleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '808080'],
        ],
    ],
];
$noBorder = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_NONE,
            'color' => ['argb' => '808080'],
        ],
    ],
];

// validation
if ((!isset($_SESSION['user_id'])) || ($_SESSION['user_type'] != 1 && $_SESSION['user_type'] != 2 && $_SESSION['user_type'] != 3)) {
    header('location:home.php');
}

// if user is borrower and trying to generate other user's loan report, go back to report page
if ($_SESSION['user_type'] == 0 && $_SESSION['user_id'] != $_GET['user_id']) {
    header('location:report.php');
}

$redirect = "report.php";
if ($_SESSION['user_type'] == 3) {
    $redirect = "user/report.php";
}

// create spreadsheet
$spreadsheet = new Spreadsheet();
$from = $_POST['lpr-start'];
$to = $_POST['lpr-end'];
$filename = "";

if ($_POST['report-type'] == 1) {
    spreadsheetHeader('A1', 70, 'C');
    inidividualLoanReport();
} else if ($_POST['report-type'] == 2 && $_SESSION['user_type'] != 3) {
    spreadsheetHeader('D1', -5, 'M');
    allMembersLoanReport();
} else if ($_POST['report-type'] == 3 && $_SESSION['user_type'] != 3) {
    spreadsheetHeader('B1', 0, 'F');
    loanPaymentsReport();
} else if ($_POST['report-type'] == 4 && $_SESSION['user_type'] != 3) {
    spreadsheetHeader('C1', 5, 'F');
    membersListReport();
} else if ($_POST['report-type'] == 5 && $_SESSION['user_type'] != 3) {
    spreadsheetHeader('A1', 25, 'D');
    membersSavingsAccountsReport();
} else if ($_POST['report-type'] == 6) {
    spreadsheetHeader('B1', -30, 'E');
    membersSavingsTransactionsReport();
} else if ($_POST['report-type'] == 7) {
    spreadsheetHeader('A1', 70, 'C');
    membersCapitalSharesReport();
}


// go back to reports page
header("Location: " . $redirect . "?report_generated=1&filename=" . $filename);


// functions

// header function
function spreadsheetHeader($logo_cell, $logo_position, $last_column)
{
    global $spreadsheet, $noBorder;

    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    $drawing->setName('Logo');
    $drawing->setDescription('Logo');
    $drawing->setPath('image/logo.jpg');
    $drawing->setHeight(36);
    $drawing->setCoordinates($logo_cell);
    $drawing->setOffsetY(5);
    $drawing->setOffsetX($logo_position);
    $drawing->setWorksheet($spreadsheet->getActiveSheet());
    $activeWorksheet = $spreadsheet->getActiveSheet();
    $activeWorksheet->mergeCells('A1:' . $last_column . '1');
    $activeWorksheet->setCellValue('A1', 'LAGUNA UNIVERSITY EMPLOYEES CREDIT COOPERATIVE');
    $activeWorksheet->mergeCells('A2:' . $last_column . '2');
    $activeWorksheet->mergeCells('A3:' . $last_column . '3');
    $activeWorksheet->mergeCells('A5:' . $last_column . '5');
    $activeWorksheet->setCellValue('A2', 'Laguna Sports Complex, Brgy. Bubukal, Sta. Cruz, Laguna');
    $activeWorksheet->getStyle('A1:' . $last_column . '5')->applyFromArray($noBorder);
}

function inidividualLoanReport()
{
    global $spreadsheet, $db, $from, $to, $redirect, $filename, $boldStyle, $thStyleArray, $tdStyleArray;
    $activeWorksheet = $spreadsheet->getActiveSheet();
    $loan_id = $_POST['loan_id'];
    $loan = $db->display_loan_by_loan_id($loan_id)->fetch_array();

    $filename = "reports/Individual Loan Payments Report - " . $loan['ref_no'] . " - " . $_SESSION['user_id'] . ".xlsx";

    $report_title = "Loan Payments Report from " . date("F d, Y", strtotime($from)) . " to " . date("F d, Y", strtotime($to));


    $loan_ref_no = $loan['ref_no'];
    $loan_type = $loan['ltype_name'];
    $full_name = ucfirst($loan['lastname']) . ", " . ucfirst($loan['firstname']) . " " . substr(ucfirst($loan['middlename']), 0, 1) . (strlen($loan['middlename']) == 0 ? '' : '.');
    $months = $loan['lplan_month'];
    $interest_rate = $loan['lplan_interest'];
    $penalty = $loan['lplan_penalty'];
    $amount = $loan['amount'];
    $interest = number_format($loan['loan_rate'], 2);
    $total_balance = number_format($loan['amount'] + $loan['loan_rate'], 2);
    $date_released = date("M d, Y", strtotime($loan['date_released']));

    $comakers = $db->display_loan_comakers($loan['loan_id']);

    $activeWorksheet->mergeCells('A4:C4');
    $activeWorksheet->setCellValue('A4', $report_title);

    $activeWorksheet->setCellValue('A6', 'Loan Reference No.: ' . $loan_ref_no);
    $activeWorksheet->setCellValue('B6', 'Loan Type: ' . $loan_type);
    $activeWorksheet->setCellValue('A7', 'Name: ' . $full_name);
    $activeWorksheet->setCellValue('A9', 'Loan Terms');
    $activeWorksheet->setCellValue('A10', 'Months: ' . $months);
    $activeWorksheet->setCellValue('A11', 'Interest Rate: ' . $interest_rate);
    $activeWorksheet->setCellValue('A12', 'Monthly Overdue Penalty: ' . $penalty);
    $activeWorksheet->setCellValue('B10', 'Amount: ' . number_format($amount, 2));
    $activeWorksheet->setCellValue('B11', 'Interest: ' . $interest);
    $activeWorksheet->setCellValue('B12', 'Total Payable: ' . $total_balance);
    $activeWorksheet->setCellValue('C10', 'Date Released: ' . $date_released);

    $row = 11;
    while ($comaker = $comakers->fetch_array()) {
        $activeWorksheet->setCellValue('C' . $row, 'Co-Maker: ' . ucfirst($comaker['lastname']) . ", " . ucfirst($comaker['firstname']) . " " . substr(ucfirst($comaker['middlename']), 0, 1) . (strlen($comaker['middlename']) == 0 ? '' : '.'));
        $row++;
    }


    $payments = $db->display_loan_payments($loan_ref_no, $from, $to);
    if ($payments->num_rows == 0) {
        header("Location: " . $redirect . "?report_generated=0");
    }

    $activeWorksheet->setCellValue('A15', 'Date');
    $activeWorksheet->setCellValue('B15', 'Payment');
    $activeWorksheet->setCellValue('C15', 'Penalty');

    $row = 16;
    while ($data = $payments->fetch_array()) {
        $activeWorksheet->setCellValue('A' . $row, date("F d, Y", strtotime($data['payment_date'])));
        $activeWorksheet->setCellValue('B' . $row, number_format($data['pay_amount'], 2));
        $activeWorksheet->setCellValue('C' . $row, number_format($data['penalty'], 2));
        $row++;
    }

    $activeWorksheet->getColumnDimension('A')->setWidth(190, 'px');
    $activeWorksheet->getColumnDimension('B')->setWidth(190, 'px');
    $activeWorksheet->getColumnDimension('C')->setWidth(190, 'px');
    // $activeWorksheet->getColumnDimension('D')->setWidth(1, 'px');
    // $activeWorksheet->getColumnDimension('E')->setWidth(190, 'px');
    $activeWorksheet->getStyle('A1:C4')->getAlignment()->setHorizontal('center');
    $activeWorksheet->getStyle('A15:C15')->getAlignment()->setHorizontal('center');


    $activeWorksheet->getStyle('A1:C5')->applyFromArray($boldStyle);
    $activeWorksheet->getStyle('A15:C15')->applyFromArray($thStyleArray);
    $activeWorksheet->getStyle('A15:C' . $row - 1)->applyFromArray($tdStyleArray);
    // $activeWorksheet->getColumnDimension('B')->setVisible(false);
    // $activeWorksheet->getColumnDimension('D')->setVisible(false);
    $activeWorksheet->getStyle('B16:C' . $row - 1)->getNumberFormat()->setFormatCode('#,##0.00');

    $writer = new Xlsx($spreadsheet);
    $writer->save($filename);

    // $preview = IOFactory::createWriter($spreadsheet, 'Html');
    // $msg = $preview->save('php://output');
    // echo $preview->save('php://output');
}

function allMembersLoanReport()
{
    global $spreadsheet, $db, $from, $to, $redirect, $filename, $boldStyle, $thStyleArray, $tdStyleArray;
    $activeWorksheet = $spreadsheet->getActiveSheet();
    $filename = "reports/All Members Loans Report - " . date("F d, Y") . " - " . $_SESSION['user_id'] . ".xlsx";
    $report_title = "All Members Loans Report from " . date("F d, Y", strtotime($from)) . " to " . date("F d, Y", strtotime($to));

    $activeWorksheet->mergeCells('A4:M4');
    $activeWorksheet->setCellValue('A4', $report_title);

    $loans = $db->display_loan($from, $to);
    if ($loans->num_rows == 0) {
        header("Location: " . $redirect . "?report_generated=0");
    }

    $activeWorksheet->setCellValue('A6', 'Member');
    $activeWorksheet->setCellValue('B6', 'Ref. No.');
    $activeWorksheet->setCellValue('C6', 'Type');
    $activeWorksheet->setCellValue('D6', 'Months');
    $activeWorksheet->setCellValue('E6', 'Rate (%)');
    $activeWorksheet->setCellValue('F6', 'Loan Amount');
    $activeWorksheet->setCellValue('G6', 'Total Payable');
    $activeWorksheet->setCellValue('H6', 'Monthly Amortization');
    $activeWorksheet->setCellValue('I6', 'Monthly Penalty');
    $activeWorksheet->setCellValue('J6', 'Balance');
    $activeWorksheet->setCellValue('K6', 'Application Date');
    $activeWorksheet->setCellValue('L6', 'Release Date');
    $activeWorksheet->setCellValue('M6', 'Status');

    $row = 7;
    while ($data = $loans->fetch_array()) {
        $fullname = ucfirst($data['lastname']) . ", " . ucfirst($data['firstname']) . " " . substr(ucfirst($data['middlename']), 0, 1) . (strlen($data['middlename']) == 0 ? '' : '.');
        $ref_no = $data['ref_no'];
        $type = $data['ltype_name'];
        $months = $data['lplan_month'];
        $interest_rate = $data['lplan_interest'];
        $amount = $data['amount'];
        $total_payable = $data['amount'] + ($data['amount'] * ($data['lplan_interest'] / 100));
        $amortization = $total_payable / $months;
        $penalty = $amortization * ($data['lplan_penalty'] / 100);
        $balance = $data['balance'];
        $loan_year = (int)date("Y", strtotime($data['date_released']));
        $loan_date = $loan_year < 2000 ? '' : date("F d, Y", strtotime($data['date_released']));
        $application_date = date("F d, Y", strtotime($data['date_created']));
        $statuses = array('pending', 'confirmed', 'released', 'completed');
        $status = $statuses[$data['status']];

        $activeWorksheet->setCellValue('A' . $row, $fullname);
        $activeWorksheet->setCellValue('B' . $row, $ref_no);
        $activeWorksheet->setCellValue('C' . $row, $type);

        $activeWorksheet->setCellValue('D' . $row, $months);
        $activeWorksheet->setCellValue('E' . $row, $interest_rate);
        $activeWorksheet->setCellValue('F' . $row, $amount);

        $activeWorksheet->setCellValue('G' . $row, $total_payable);
        $activeWorksheet->setCellValue('H' . $row, $amortization);
        $activeWorksheet->setCellValue('I' . $row, $penalty);
        $activeWorksheet->setCellValue('J' . $row, $balance);
        $activeWorksheet->setCellValue('K' . $row, $application_date);
        $activeWorksheet->setCellValue('L' . $row, $loan_date);
        $activeWorksheet->setCellValue('M' . $row, $status);
        $row++;
    }

    $cols = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M');
    for ($i = 0; $i < count($cols); $i++) {
        $activeWorksheet->getColumnDimension($cols[$i])->setAutoSize(true);
    }
    $activeWorksheet->getStyle('A1:M4')->getAlignment()->setHorizontal('center');

    $activeWorksheet->getStyle('A1:M5')->applyFromArray($boldStyle);
    $activeWorksheet->getStyle('A6:M6')->applyFromArray($thStyleArray);
    $activeWorksheet->getStyle('A7:M' . $row - 1)->applyFromArray($tdStyleArray);
    $activeWorksheet->getStyle('F7:J' . $row - 1)->getNumberFormat()->setFormatCode('#,##0.00');

    $writer = new Xlsx($spreadsheet);
    $writer->save($filename);
}

function loanPaymentsReport()
{
    global $spreadsheet, $db, $from, $to, $redirect, $filename, $boldStyle, $thStyleArray, $tdStyleArray;
    $activeWorksheet = $spreadsheet->getActiveSheet();
    $filename = "reports/Loan Payments Report - " . date("F d, Y") . " - " . $_SESSION['user_id'] . ".xlsx";
    $report_title = "Loan Payments Report from " . date("F d, Y", strtotime($from)) . " to " . date("F d, Y", strtotime($to));

    $activeWorksheet->mergeCells('A4:F4');
    $activeWorksheet->setCellValue('A4', $report_title);

    $payments = $db->display_loan_payments('all');
    if ($payments->num_rows == 0) {
        header("Location: " . $redirect . "?report_generated=0");
    }

    $activeWorksheet->setCellValue('A6', 'Member');
    $activeWorksheet->setCellValue('B6', 'Ref. No.');
    $activeWorksheet->setCellValue('C6', 'Type');
    $activeWorksheet->setCellValue('D6', 'Payment');
    $activeWorksheet->setCellValue('E6', 'Penalty');
    $activeWorksheet->setCellValue('F6', 'Date');

    $row = 7;
    while ($data = $payments->fetch_array()) {
        $fullname = $data['payee'];
        $ref_no = $data['ref_no'];
        $type = $data['ltype_name'];
        $penalty = $data['penalty'];
        $amount = $data['pay_amount'];
        $date = date("F d, Y", strtotime($data['payment_date']));

        $activeWorksheet->setCellValue('A' . $row, $fullname);
        $activeWorksheet->setCellValue('B' . $row, $ref_no);
        $activeWorksheet->setCellValue('C' . $row, $type);

        $activeWorksheet->setCellValue('D' . $row, $amount);
        $activeWorksheet->setCellValue('E' . $row, $penalty);
        $activeWorksheet->setCellValue('F' . $row, $date);
        $row++;
    }

    $cols = array('A', 'B', 'C', 'D', 'E', 'F');
    for ($i = 0; $i < count($cols); $i++) {
        $activeWorksheet->getColumnDimension($cols[$i])->setAutoSize(true);
    }
    $activeWorksheet->getStyle('A1:F4')->getAlignment()->setHorizontal('center');

    $activeWorksheet->getStyle('A1:F5')->applyFromArray($boldStyle);
    $activeWorksheet->getStyle('A6:F6')->applyFromArray($thStyleArray);
    $activeWorksheet->getStyle('A7:F' . $row - 1)->applyFromArray($tdStyleArray);
    $activeWorksheet->getStyle('D7:E' . $row - 1)->getNumberFormat()->setFormatCode('#,##0.00');

    $writer = new Xlsx($spreadsheet);
    $writer->save($filename);
}

function membersListReport()
{
    global $spreadsheet, $db, $from, $to, $redirect, $filename, $boldStyle, $thStyleArray, $tdStyleArray;
    $activeWorksheet = $spreadsheet->getActiveSheet();
    $filename = "reports/Members List Report - " . date("F d, Y") . " - " . $_SESSION['user_id'] . ".xlsx";
    $report_title = "Members List Report from " . date("F d, Y", strtotime($from)) . " to " . date("F d, Y", strtotime($to));

    $activeWorksheet->mergeCells('A4:F4');
    $activeWorksheet->setCellValue('A4', $report_title);

    $payments = $db->display_user_for_report($from, $to);
    if ($payments->num_rows == 0) {
        header("Location: " . $redirect . "?report_generated=0");
    }

    $activeWorksheet->setCellValue('A6', 'Name');
    $activeWorksheet->setCellValue('B6', 'Contact. No.');
    $activeWorksheet->setCellValue('C6', 'Email Address');
    $activeWorksheet->setCellValue('D6', 'No. of Active Loans');
    $activeWorksheet->setCellValue('E6', 'No. of Inactive Loans');
    $activeWorksheet->setCellValue('F6', 'Regsitration Date');

    $row = 7;
    while ($data = $payments->fetch_array()) {
        $fullname = ucfirst($data['lastname']) . ", " . ucfirst($data['firstname']) . " " . substr(ucfirst($data['middlename']), 0, 1) . (strlen($data['middlename']) == 0 ? '' : '.');
        $ref_no = $data['contact_no'];
        $email = $data['email'];
        $active_loans = $data['active_loans'];
        $inactive_loans = $data['inactive_loans'];
        $date = date("F d, Y", strtotime($data['registration_date']));

        $activeWorksheet->setCellValue('A' . $row, $fullname);
        $activeWorksheet->setCellValue('B' . $row, $ref_no);
        $activeWorksheet->setCellValue('C' . $row, $email);

        $activeWorksheet->setCellValue('D' . $row, $active_loans);
        $activeWorksheet->setCellValue('E' . $row, $inactive_loans);
        $activeWorksheet->setCellValue('F' . $row, $date);
        $row++;
    }

    $cols = array('A', 'B', 'C', 'D', 'E', 'F');
    for ($i = 0; $i < count($cols); $i++) {
        $activeWorksheet->getColumnDimension($cols[$i])->setAutoSize(true);
    }
    $activeWorksheet->getStyle('A1:F4')->getAlignment()->setHorizontal('center');

    $activeWorksheet->getStyle('A1:F5')->applyFromArray($boldStyle);
    $activeWorksheet->getStyle('A6:F6')->applyFromArray($thStyleArray);
    $activeWorksheet->getStyle('A7:F' . $row - 1)->applyFromArray($tdStyleArray);

    $writer = new Xlsx($spreadsheet);
    $writer->save($filename);
}

function membersSavingsAccountsReport()
{
    global $spreadsheet, $db, $from, $to, $redirect, $filename, $boldStyle, $thStyleArray, $tdStyleArray;
    $activeWorksheet = $spreadsheet->getActiveSheet();
    $filename = "reports/Members Savings Accounts Report - " . date("F d, Y") . " - " . $_SESSION['user_id'] . ".xlsx";
    $report_title = "Members Savings Accounts Report from " . date("F d, Y", strtotime($from)) . " to " . date("F d, Y", strtotime($to));

    $activeWorksheet->mergeCells('A4:D4');
    $activeWorksheet->setCellValue('A4', $report_title);

    $payments = $db->display_all_savings_account($from, $to);
    if ($payments->num_rows == 0) {
        header("Location: " . $redirect . "?report_generated=0");
    }

    $activeWorksheet->setCellValue('A6', 'Owner');
    $activeWorksheet->setCellValue('B6', 'Account Name');
    $activeWorksheet->setCellValue('C6', 'Current Balance');
    $activeWorksheet->setCellValue('D6', 'Date opened');

    $row = 7;
    while ($data = $payments->fetch_array()) {
        $fullname = ucfirst($data['lastname']) . ", " . ucfirst($data['firstname']) . " " . substr(ucfirst($data['middlename']), 0, 1) . (strlen($data['middlename']) == 0 ? '' : '.');
        $acc_name = $data['account_name'];
        $total_balance = $data['total_balance'];
        $date = date("F d, Y", strtotime($data['date_created']));

        $activeWorksheet->setCellValue('A' . $row, $fullname);
        $activeWorksheet->setCellValue('B' . $row, $acc_name);
        $activeWorksheet->setCellValue('C' . $row, $total_balance);
        $activeWorksheet->setCellValue('D' . $row, $date);
        $row++;
    }

    $cols = array('A', 'B', 'C', 'D');
    for ($i = 0; $i < count($cols); $i++) {
        $activeWorksheet->getColumnDimension($cols[$i])->setAutoSize(true);
    }
    $activeWorksheet->getStyle('A1:D4')->getAlignment()->setHorizontal('center');

    $activeWorksheet->getStyle('A1:D5')->applyFromArray($boldStyle);
    $activeWorksheet->getStyle('A6:D6')->applyFromArray($thStyleArray);
    $activeWorksheet->getStyle('A7:D' . $row - 1)->applyFromArray($tdStyleArray);
    $activeWorksheet->getStyle('C7:C' . $row - 1)->getNumberFormat()->setFormatCode('#,##0.00');

    $writer = new Xlsx($spreadsheet);
    $writer->save($filename);
}

function membersSavingsTransactionsReport()
{
    global $spreadsheet, $db, $from, $to, $redirect, $filename, $boldStyle, $thStyleArray, $tdStyleArray;
    $activeWorksheet = $spreadsheet->getActiveSheet();
    $filename = "reports/Members Savings Transactions Report - " . date("F d, Y") . " - " . $_SESSION['user_id'] . ".xlsx";
    $report_title = "Members Savings Transactions Report from " . date("F d, Y", strtotime($from)) . " to " . date("F d, Y", strtotime($to));

    $activeWorksheet->mergeCells('A4:E4');
    $activeWorksheet->setCellValue('A4', $report_title);

    $payments = $_SESSION['user_type'] == 3 ? $db->display_savings_transactions($from, $to, $_SESSION['user_id']) : $db->display_savings_transactions($from, $to);
    if ($payments->num_rows == 0) {
        header("Location: " . $redirect . "?report_generated=0");
    }

    $activeWorksheet->setCellValue('A6', 'Owner');
    $activeWorksheet->setCellValue('B6', 'Account Name');
    $activeWorksheet->setCellValue('C6', 'Type');
    $activeWorksheet->setCellValue('D6', 'Amount');
    $activeWorksheet->setCellValue('E6', 'Date');

    $row = 7;
    while ($data = $payments->fetch_array()) {
        $fullname = ucfirst($data['lastname']) . ", " . ucfirst($data['firstname']) . " " . substr(ucfirst($data['middlename']), 0, 1) . (strlen($data['middlename']) == 0 ? '' : '.');
        $acc_name = $data['account_name'];
        $status = $data['status'] == 0 ? ' (Deactivated)': '';
        $amount = abs($data['amount']);
        $type = $data['tx_type'] == 1 ? 'Deposit' : 'Withdraw';
        $date = date("F d, Y", strtotime($data['tx_date']));

        $activeWorksheet->setCellValue('A' . $row, $fullname);
        $activeWorksheet->setCellValue('B' . $row, $acc_name . $status);
        $activeWorksheet->setCellValue('C' . $row, $type);
        $activeWorksheet->setCellValue('D' . $row, $amount);
        $activeWorksheet->setCellValue('E' . $row, $date);
        $row++;
    }

    $cols = array('A', 'B', 'C', 'D', 'E');
    for ($i = 0; $i < count($cols); $i++) {
        $activeWorksheet->getColumnDimension($cols[$i])->setAutoSize(true);
    }
    $activeWorksheet->getStyle('A1:E4')->getAlignment()->setHorizontal('center');

    $activeWorksheet->getStyle('A1:E5')->applyFromArray($boldStyle);
    $activeWorksheet->getStyle('A6:E6')->applyFromArray($thStyleArray);
    $activeWorksheet->getStyle('A7:E' . $row - 1)->applyFromArray($tdStyleArray);
    $activeWorksheet->getStyle('D7:D' . $row - 1)->getNumberFormat()->setFormatCode('#,##0.00');

    $writer = new Xlsx($spreadsheet);
    $writer->save($filename);
}

function membersCapitalSharesReport()
{
    global $spreadsheet, $db, $from, $to, $redirect, $filename, $boldStyle, $thStyleArray, $tdStyleArray;
    $activeWorksheet = $spreadsheet->getActiveSheet();
    $filename = "reports/Members Capital Shares Transactions Report - " . date("F d, Y") . " - " . $_SESSION['user_id'] . ".xlsx";
    $report_title = "Members Capital Shares Transactions Report from " . date("F d, Y", strtotime($from)) . " to " . date("F d, Y", strtotime($to));

    $activeWorksheet->mergeCells('A4:C4');
    $activeWorksheet->setCellValue('A4', $report_title);

    $payments = $_SESSION['user_type'] == 3 ? $db->display_members_capital_shares_transactions($from, $to, $_SESSION['user_id']) : $db->display_members_capital_shares_transactions($from, $to);
    if ($payments->num_rows == 0) {
        header("Location: " . $redirect . "?report_generated=0");
    }

    $activeWorksheet->setCellValue('A6', 'Owner');
    $activeWorksheet->setCellValue('B6', 'Amount');
    $activeWorksheet->setCellValue('C6', 'Date');

    $row = 7;
    while ($data = $payments->fetch_array()) {
        $fullname = ucfirst($data['lastname']) . ", " . ucfirst($data['firstname']) . " " . substr(ucfirst($data['middlename']), 0, 1) . (strlen($data['middlename']) == 0 ? '' : '.');
        $amount = abs($data['amount']);
        $date = date("F d, Y", strtotime($data['tx_date']));

        $activeWorksheet->setCellValue('A' . $row, $fullname);
        $activeWorksheet->setCellValue('B' . $row, $amount);
        $activeWorksheet->setCellValue('C' . $row, $date);
        $row++;
    }

    $activeWorksheet->getStyle('A1:C4')->getAlignment()->setHorizontal('center');

    $activeWorksheet->getColumnDimension('A')->setWidth(197, 'px');
    $activeWorksheet->getColumnDimension('B')->setWidth(197, 'px');
    $activeWorksheet->getColumnDimension('C')->setWidth(197, 'px');

    $activeWorksheet->getStyle('A1:C5')->applyFromArray($boldStyle);
    $activeWorksheet->getStyle('A6:C6')->applyFromArray($thStyleArray);
    $activeWorksheet->getStyle('A7:C' . $row - 1)->applyFromArray($tdStyleArray);
    $activeWorksheet->getStyle('B7:B' . $row - 1)->getNumberFormat()->setFormatCode('#,##0.00');

    $writer = new Xlsx($spreadsheet);
    $writer->save($filename);
}
?>