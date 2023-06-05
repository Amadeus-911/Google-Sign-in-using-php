<?php

session_start();

if (isset($_GET['code'])) {
    echo $_GET['code'];

    $code = $_GET['code'];
    $client_id = '1020136124385-4ufvv79pge22e96j5c0fkijleqo567vh.apps.googleusercontent.com';
    $client_secret = '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';
    $redirect_uri = 'http://localhost/auth/test.php';
    $grant_type = 'authorization_code';

    // Create a new cURL resource
    $ch = curl_init();

    // Set the URL and other options
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'code=' . urlencode($code) . '&client_id=' . urlencode($client_id) . '&client_secret=' . urlencode($client_secret) . '&redirect_uri=' . urlencode($redirect_uri) . '&grant_type=' . urlencode($grant_type));

    // Execute the request and fetch the response
    $response = curl_exec($ch);


    // Check for errors
    if (curl_errno($ch)) {
        $error = curl_error($ch);
        // Handle the error as needed
        // Example: echo "cURL Error: " . $error;
    }

    // Close the cURL resource
    curl_close($ch);

    // Handle the response
    if ($response) {
        // Process the response as needed
        $jsonObj = json_decode($response);
        $accessToken = $jsonObj->access_token;

        $_SESSION['access_token'] = $accessToken;

        // API endpoint
        $apiUrl = 'https://www.googleapis.com/oauth2/v3/userinfo';

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $accessToken
        ));

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            $error = curl_error($ch);
        }

        // Close the cURL resource
        curl_close($ch);

        // Handle the response
        if ($response) {
            // Process the response as needed
            $data = json_decode($response);

            print_r( $response);
            // Access the data
            $email = $data->email;
            $imageUrl = $data->picture;
            $name = $data->family_name ? $data->given_name . ' ' . $data->family_name : $data->given_name;
            
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            $_SESSION['imgUrl'] = $imageUrl;

            header("location: ./index.php");
        } else {
            echo "error1 ";
        }
    } else {
        echo "Error";
    }
}

?>