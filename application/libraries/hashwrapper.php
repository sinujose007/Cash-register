 <?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('PasswordHash.php');

define('PHPASS_HASH_STRENGTH', 8);
define('PHPASS_HASH_PORTABLE', false);

class Hashwrapper
{
 
 function createhash($raw_password) 
 {
  // Passwords should never be longer than 72 characters to prevent DoS attacks
  if (strlen($raw_password) > 72) { die("Password must be 72 characters or less"); }
  
  // Hash raw_password using phpass
  $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
  $hashed_password = $hasher->HashPassword($raw_password);
 
  // Return the hashed password
  return $hashed_password;
 }
 
 function checkpassword($raw_password,$hashed_password) 
 {
  //Check if raw_password matches hashed_password when it is hashed using phpass
  $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
  if($hasher->CheckPassword($raw_password, $hashed_password))
   return true;
  else return false;
 }
}
?>  