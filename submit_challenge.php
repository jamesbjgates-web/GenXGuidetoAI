<?php
// Basic cPanel-friendly challenge form handler.
// IMPORTANT: confirm PHP mail() works on the live host before launch.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit('Method not allowed'); }
if (!empty($_POST['website'] ?? '')) { header('Location: thanks.html'); exit; }

function clean_line($s) { return trim(preg_replace('/[\r\n]+/', ' ', (string)$s)); }
$name = clean_line($_POST['name'] ?? '');
$location = clean_line($_POST['location'] ?? '');
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$problem = trim((string)($_POST['problem'] ?? ''));
$outcome = trim((string)($_POST['outcome'] ?? ''));
$permission = clean_line($_POST['permission'] ?? '');
$allowedPermissions = ['name_location','anonymous','ask_first','private'];

if (!$name || !$email || !$problem || !$outcome || !in_array($permission,$allowedPermissions,true)) {
  http_response_code(400); exit('Please complete all required fields.');
}
if (strlen($problem) > 5000 || strlen($outcome) > 2500) { http_response_code(400); exit('Submission is too long.'); }

$labels = [
  'name_location' => 'Yes - first name and general location may be used',
  'anonymous' => 'Yes - anonymise me',
  'ask_first' => 'Maybe - ask before using anything',
  'private' => 'No - keep private; contact me if you can help'
];

$to = 'hello@genxguidetoai.com';
$subject = 'New Gen X Guide challenge from ' . $name;
$boundary = '=_genx_' . bin2hex(random_bytes(12));
$headers = [];
$headers[] = 'From: Gen X Guide Challenge <hello@genxguidetoai.com>';
$headers[] = 'Reply-To: ' . $email;
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-Type: multipart/mixed; boundary="' . $boundary . '"';

$bodyText = "NEW CHALLENGE\n\n" .
  "Name: $name\n" .
  "Location: " . ($location ?: 'Not supplied') . "\n" .
  "Email: $email\n" .
  "Permission: " . $labels[$permission] . "\n\n" .
  "PROBLEM\n$problem\n\n" .
  "GOOD RESULT LOOKS LIKE\n$outcome\n";

$message = "--$boundary\r\n";
$message .= "Content-Type: text/plain; charset=UTF-8\r\n";
$message .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
$message .= $bodyText . "\r\n";

$maxTotal = 10 * 1024 * 1024;
$total = 0;
$allowedExt = ['pdf','doc','docx','xls','xlsx','csv','txt','png','jpg','jpeg','webp','mp3','m4a','mp4'];
if (!empty($_FILES['files']['name']) && is_array($_FILES['files']['name'])) {
  foreach ($_FILES['files']['name'] as $i => $originalName) {
    if ($_FILES['files']['error'][$i] === UPLOAD_ERR_NO_FILE) continue;
    if ($_FILES['files']['error'][$i] !== UPLOAD_ERR_OK) continue;
    $size = (int)$_FILES['files']['size'][$i];
    $total += $size;
    if ($total > $maxTotal) { http_response_code(400); exit('Attachments exceed 10MB total.'); }
    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    if (!in_array($ext,$allowedExt,true)) continue;
    $tmp = $_FILES['files']['tmp_name'][$i];
    if (!is_uploaded_file($tmp)) continue;
    $data = chunk_split(base64_encode(file_get_contents($tmp)));
    $safeName = preg_replace('/[^A-Za-z0-9._-]/','_',basename($originalName));
    $mime = mime_content_type($tmp) ?: 'application/octet-stream';
    $message .= "--$boundary\r\n";
    $message .= "Content-Type: $mime; name=\"$safeName\"\r\n";
    $message .= "Content-Disposition: attachment; filename=\"$safeName\"\r\n";
    $message .= "Content-Transfer-Encoding: base64\r\n\r\n$data\r\n";
  }
}
$message .= "--$boundary--\r\n";

$ok = mail($to, $subject, $message, implode("\r\n", $headers));
if ($ok) { header('Location: thanks.html'); exit; }
http_response_code(500);
echo 'Something went wrong sending that. Please email hello@genxguidetoai.com instead.';
?>
