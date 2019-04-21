
<?php
// LOGIN USER
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
session_start();
include("config.php"); 


$username = $_POST[username];
$password = $_POST[password];

if($username == "") 
{                    
echo "คุณยังไม่ได้กรอกชื่อผู้ใช้ครับ";
} 
else if($password == "") 
{        
echo "คุณยังไม่ได้กรอกรหัสผ่านครับ";
} 
else
{                                              


$query_RecordsetP = "SELECT * FROM cust_login WHERE user LIKE '$username' AND password LIKE '$password'";
$RecordsetP = mysql_query($conn, $query_RecordsetP) or die(mysql_error());
$row_RecordsetP = mysql_fetch_assoc($RecordsetP);
$check_admin=$row_RecordsetP['admin'];

if($num !=0) 
{       
		if($check_admin == ("1"))
         {

         echo "YOU ARE ADMIN";
         //echo "<meta http-equiv='refresh' content='1;URL=index_admin.html'>";
         }
         else
          {
         echo "YOU ARE USER";
         //echo "<meta http-equiv='refresh' content='1;URL=index_user.html'>";  
         
          }

}
else 
{
echo "Username หรือ Password อาจจะผิดกรุณา Login ใหม่อีกครั้ง <br /><a href='index_login.html'>Back</a>";
}


?>