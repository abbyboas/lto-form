<?php
$serverName="ABBY\SQLEXPRESS";
$connectionOptions=[
"Database"=>"WEBAPP",
"Uid"=>"",
"PWD"=>""
];
$conn=sqlsrv_connect($serverName, $connectionOptions);
if($conn==false)
die(print_r(sqlsrv_errors(),true));
else echo 'Connection Success';

//VARIABLE

//FOR USER DATA TABLE
$lastname=$_POST['lastname'];
$firstname=$_POST['firstname'];
$middlename=$_POST['middlename'];
$housenum=$_POST['housenum'];
$street=$_POST['street'];
$municipality=$_POST['municipality'];
$province=$_POST['province'];
$nationality=$_POST['nationality'];
$gender=$_POST['gender'];
$birthdate=$_POST['birthdate'];
$height=$_POST['height'];
$weight=$_POST['weight'];
$contact=$_POST['contact'];
$tin=$_POST['tin'];

$sql_UserData="INSERT INTO USER_DATA (LAST_NAME, FIRST_NAME, MIDDLE_NAME, HOUSE_NO, STREET, [CITY/MUNICIPALITY], PROVINCE, NATIONALITY, GENDER, BIRTHDATE, HEIGHT, 
WEIGHT,CONTACT,TIN) VALUES ('$lastname', '$firstname', '$middlename', '$housenum', '$street', '$municipality', '$province', '$nationality',
'$gender', '$birthdate', '$height', '$weight', '$contact', '$tin')";

$results1=sqlsrv_query($conn,$sql_UserData);
if($results1){
  echo 'Registration Successful';
}else{
  echo 'Error';
}

$get_UserNumber ="SELECT USER_NUMBER FROM USER_DATA ORDER BY USER_NUMBER DESC";
$result_UserNumber = sqlsrv_query($conn,$get_UserNumber);
$UserNumber = sqlsrv_fetch_array($result_UserNumber);

//FOR BIO DATA
$civilstatus=$_POST['civilstat'];
$haircolor=$_POST['haircolor'];
if($haircolor == "other"){
  $haircolor=$_POST['other-haircolor'];
}
$eyecolor=$_POST['eyecolor'];
if($eyecolor == "other"){
  $eyecolor=$_POST['other-eyecolor'];
}
$built=$_POST['built'];
$complexion=$_POST['complexion'];
$bloodtype=$_POST['blood-type'];
$organdonor=$_POST['donor'];
$birthplacemunicipal=$_POST['birthplace-municipal'];
$birthplaceprovince=$_POST['birthplace-province'];
$fatherlastname=$_POST['father-lastname'];
$fatherfirstname=$_POST['father-firstname'];
$fathermiddlename=$_POST['father-middlename'];
$motherlastname=$_POST['mother-lastname'];
$motherfirstname=$_POST['mother-firstname'];
$mothermiddlename=$_POST['mother-middlename'];
$spouselastname=$_POST['spouse-lastname'];
$spousefirstname=$_POST['spouse-firstname'];
$spousemiddlename=$_POST['spouse-middlename'];


$sql_BioData="INSERT INTO BIO_DATA (USER_NUMBER,CIVIL_STATUS, HAIR_COLOR, EYE_COLOR, BUILT, COMPLEXION, BLOOD_TYPE, ORGAN_DONOR, [CITY/MUNICIPALITY], PROVINCE, FATHER_LASTNAME, 
FATHER_FIRSTNAME, FATHER_MIDDLENAME, MOTHER_LASTNAME, MOTHER_FIRSTNAME, MOTHER_MIDDLENAME, SPOUSE_LASTNAME, SPOUSE_FIRSTNAME, SPOUSE_MIDDLENAME) 
VALUES ('$UserNumber[0]','$civilstatus', '$haircolor', '$eyecolor', '$built', '$complexion', '$bloodtype', '$organdonor', '$birthplacemunicipal',
'$birthplaceprovince', '$fatherlastname', '$fatherfirstname', '$fathermiddlename', '$motherlastname', '$motherfirstname', '$mothermiddlename',
'$spouselastname', '$spousefirstname', '$spousemiddlename')";

$results2=sqlsrv_query($conn,$sql_BioData);
if (!$results2) {
  die(print_r(sqlsrv_errors(), true));
}

//FOR WORK DATA
$employer_businessname=$_POST['employer-businessname'];
$employer_tel=$_POST['employer-tel'];
$business_street=$_POST['business-street'];
$business_municipal=$_POST['business-municipal'];
$zipcode=$_POST['zipcode'];
$business_province=$_POST['business-province'];


$sql_WorkData="INSERT INTO WORK_DATA (USER_NUMBER,EMPLOYER_BUSINESS_NAME, TEL_NO, STREET, [CITY/MUNICIPALITY], ZIPCODE, PROVINCE ) 
VALUES ('$UserNumber[0]','$employer_businessname', '$employer_tel', '$business_street', '$business_municipal', '$zipcode', '$business_province')";

$results3=sqlsrv_query($conn,$sql_WorkData);
if (!$results3) {
  die(print_r(sqlsrv_errors(), true));
}

//FOR APPLICATION DATA

$toa=$_POST['toa'];
$change_address=$_POST['change-add'];
$change_civilstat=$_POST['change-civilstat'];
$change_name=$_POST['change-name'];
$change_birthdate=$_POST['change-birthdate'];
$others=$_POST['others'];
$tla=$_POST['tla'];
$dsa=$_POST['dsa'];
$educ=$_POST['ea'];


$sql_ApplicationData="INSERT INTO APPLICATION_DATA (USER_NUMBER, TYPE_OF_APP, CHANGE_ADDRESS, CHANGE_CIVILSTAT, CHANGE_NAME, CHANGE_BIRTHDATE, OTHERS, TYPE_OF_LIC, DRIVING_SCHOOL, EDUC_ATT) 
VALUES ('$UserNumber[0]','$toa', '$change_address', '$change_civilstat', '$change_name', '$change_birthdate', '$others', '$tla', '$dsa', '$educ')";

$results4=sqlsrv_query($conn,$sql_ApplicationData);
if (!$results4) {
  die(print_r(sqlsrv_errors(), true));
}