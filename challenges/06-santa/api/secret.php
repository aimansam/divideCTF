<?php

header('Content-Type: application/json');

$flag = getenv('SANTA_FLAG');
if (!$flag) {
    $flag = "FLAG{s4nt4_r4nd0m_p4rty_2026}";
}

mt_srand(time());
$currentWinningCode = mt_rand(1000, 9999);

$userGuess = isset($_POST['guess']) ? $_POST['guess'] : '';

if ($userGuess !== "" && (int)$userGuess === $currentWinningCode) {
    echo json_encode([
        "success" => true,
        "message" => "🎁 The vault is open!",
        "flag" => $flag,
        "code" => $currentWinningCode
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Wrong code! 🥶",
        "hint" => "The magic number just changed. Try again!" 
    ]);
}
?>