<?php
error_reporting(0);
// Include database class
include_once '../inc/db.php';
if (isset($_FILES['csv'])) {
    $admin = $_POST['admin'];
    $csv = array();
    $issues_paycodes = array();
    $uploadable = array();
    $row = 0;

    if ($_FILES['csv']['error'] == 0) {
        $name = $_FILES['csv']['name'];
        $ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
        $type = $_FILES['csv']['type'];
        $tmpName = $_FILES['csv']['tmp_name'];

        if ($type === 'text/csv') {
            if (($handle = fopen($tmpName, 'r')) !== false) {
                set_time_limit(0);
                while (($data = fgetcsv($handle, 10000, ',')) !== false) {
                    if ($data[0] == NULL) {
                        // add name if neccessary
                        array_push($issues_paycodes, array("paycode" => $data[0], "fullname" => $data[2]));
                        $row++;
                        continue;
                    } else {
                        $paycode = Database::getInstance()->get_paycode($data[0]);
                        array_push($csv, $paycode);
                        if (!empty($paycode)) {
                            // add name if neccessary
                            $name = explode('|', $data[2]);
                            $middle_name = ($name[2] == null || $name[2] == '.') ? "" : $name[2];
                            array_push($uploadable, array("paycode" => $data[0], "department" => $data[1], "surname" => $name[0], "first_name" => $name[1], "middle_name" => $middle_name, "phone_number" => $data[3], "email" => $data[4]));
                            $row++;
                        } else {
                            // add name if neccessary
                            array_push($issues_paycodes, array("paycode" => $data[0], "fullname" => $data[2]));
                            $row++;
                            continue;
                        }
                    }
                }
                fclose($handle);
            }
        }
    }
    $ok = json_encode(array("upload" => $uploadable));
    $all = json_decode($ok, true);
    $count = count($all);
    $issues = 0;
    foreach ($all as $staff) {
        $paycode = $staff['paycode'];
        $surname = $staff['surname'];
        $first = $staff['first_name'];
        $middle = $staff['middle_name'];
        $pnumber = $staff['phone_number'];
        $email = $staff['email'];
        $hash = bin2hex(openssl_random_pseudo_bytes(4));


        $newUser = Database::getInstance()->insert_user($first, $middle, $last, $email, $role, $hash, $department, $enrollment_year, $pnumber);
        if ($newUser != 'Done') {
            $count++;
            $myfile = fopen("../csv/logs.txt", "a") or die("Unable to open file!");
            $txt = $count + " email: " + $email + " password: " + $hash;
            fwrite($myfile, "\n" . $txt);
            fclose($myfile);
        }
    }
    if ($count == 0) {
        echo 'Done';
    } else {
        echo $count;
    }
}
