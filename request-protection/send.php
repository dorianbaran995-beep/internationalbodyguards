<?php
declare(strict_types=1);

const FORM_URL = '/request-protection/';
const RECIPIENT_EMAIL = 'enquiries@internationalbodyguards.net';
const WEBSITE_SENDER = 'website@internationalbodyguards.net';

function redirectToForm(string $query): never
{
    header('Location: ' . FORM_URL . '?' . $query, true, 303);
    exit;
}

function cleanSingleLine(string $value, int $maxLength = 200): string
{
    $value = trim(strip_tags($value));
    $value = preg_replace('/[\r\n]+/', ' ', $value) ?? '';
    return mb_substr($value, 0, $maxLength);
}

function cleanMultiline(string $value, int $maxLength = 2000): string
{
    $value = trim(strip_tags($value));
    $value = str_replace(["\r\n", "\r"], "\n", $value);
    return mb_substr($value, 0, $maxLength);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectToForm('error=method');
}

// Honeypot field: real visitors never see or complete it.
if (!empty($_POST['website'])) {
    redirectToForm('sent=1');
}

$fullName = cleanSingleLine((string)($_POST['fullName'] ?? ''), 120);
$email = filter_var(trim((string)($_POST['email'] ?? '')), FILTER_VALIDATE_EMAIL);
$phone = cleanSingleLine((string)($_POST['phone'] ?? ''), 60);
$country = cleanSingleLine((string)($_POST['country'] ?? ''), 100);
$city = cleanSingleLine((string)($_POST['city'] ?? ''), 120);
$assignmentType = cleanSingleLine((string)($_POST['assignmentType'] ?? ''), 80);
$startDate = cleanSingleLine((string)($_POST['startDate'] ?? ''), 20);
$endDate = cleanSingleLine((string)($_POST['endDate'] ?? ''), 20);
$peopleCount = filter_var($_POST['peopleCount'] ?? null, FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1, 'max_range' => 99],
]);
$coverageType = cleanSingleLine((string)($_POST['coverageType'] ?? ''), 120);
$bodyguardCount = cleanSingleLine((string)($_POST['bodyguardCount'] ?? ''), 80);
$details = cleanMultiline((string)($_POST['details'] ?? ''), 2000);
$consent = (string)($_POST['consent'] ?? '');

$requiredValid = $fullName !== ''
    && $email !== false
    && $phone !== ''
    && $country !== ''
    && $city !== ''
    && $assignmentType !== ''
    && $peopleCount !== false
    && $coverageType !== ''
    && $bodyguardCount !== ''
    && $consent === 'Yes';

if (!$requiredValid) {
    redirectToForm('error=validation');
}

if ($startDate !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $startDate)) {
    redirectToForm('error=date');
}

if ($endDate !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $endDate)) {
    redirectToForm('error=date');
}

$subject = 'New protection request - ' . $city . ', ' . $country;
$messageLines = [
    'NEW CONFIDENTIAL PROTECTION REQUEST',
    '',
    'Full name: ' . $fullName,
    'Email: ' . $email,
    'Phone / WhatsApp: ' . $phone,
    '',
    'Country: ' . $country,
    'City / general location: ' . $city,
    'Assignment type: ' . $assignmentType,
    'Start date: ' . ($startDate !== '' ? $startDate : 'Not provided'),
    'End date: ' . ($endDate !== '' ? $endDate : 'Not provided / ongoing'),
    'People requiring protection: ' . (string)$peopleCount,
    'Coverage required: ' . $coverageType,
    'Approximate bodyguards required: ' . $bodyguardCount,
    '',
    'Brief details:',
    $details !== '' ? $details : 'No additional details provided.',
    '',
    'Consent to contact: Yes',
    'Submitted: ' . gmdate('Y-m-d H:i:s') . ' UTC',
];

$headers = [
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8',
    'From: International Bodyguards Website <' . WEBSITE_SENDER . '>',
    'Reply-To: ' . $fullName . ' <' . $email . '>',
    'X-Mailer: PHP/' . phpversion(),
];

$sent = mail(
    RECIPIENT_EMAIL,
    $subject,
    implode("\n", $messageLines),
    implode("\r\n", $headers)
);

redirectToForm($sent ? 'sent=1' : 'error=send');
