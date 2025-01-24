<?php

require_once("db.php");

//insert
function insertUser($username, $email, $Password, $user_type) {
    $conn = getConnection();

    $insertQuery = "INSERT INTO users (USERNAME, EMAIL, PASSWORD, USER_TYPE) VALUES (?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);

    $insertStmt->bind_param("ssss", $username, $email, $Password, $user_type);
    $insertStmt->execute();
}
//get User Name
function isUsernameExists($username) {
    $conn = getConnection();
    $query = "SELECT * FROM users WHERE USERNAME = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}
function getUserByUsername($username) {
    $conn = getConnection();
    $query = "SELECT * FROM users WHERE USERNAME = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
function getUserById($user_id) {
    $conn = getConnection();
    $query = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
// Update
function updateUserEmail($username, $newEmail) {
    $conn = getConnection();
    $query = "UPDATE users SET email = ? WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $newEmail, $username);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
function updateUserPassword($username, $newPassword) {
    $conn = getConnection();
    $query = "UPDATE users SET password = ? WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $newPassword, $username);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
//search freelancer
function searchFreelancer($searchQuery) {
    $conn = getConnection();

    $query = "SELECT * FROM users WHERE user_type = 'freelancer' AND (username LIKE ? OR user_id = ?)";
    $stmt = $conn->prepare($query);
    $searchParameter = "%$searchQuery%";
    $stmt->bind_param("ss", $searchParameter, $searchQuery);
    $stmt->execute();
    $result = $stmt->get_result();
    $freelancers = [];
    while ($row = $result->fetch_assoc()) {
        $freelancers[] = $row;
    }

    return $freelancers;
}

//FaisalVai part
// update and edit
function deleteUserByID($id){
    $conn = getConnection();
    if ($conn) {
        $query = "DELETE FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("i", $id); 
            if ($stmt->execute()) {
                return "User deleted successfully";
            } else {
                return "Execution failed";
            }
        } else {
            return "Statement preparation failed";
        }
    } else {
        return "Connection error";
    }
}

function editUserById($id){
    $conn = getConnection();
    $sql = "SELECT * FROM users WHERE user_id={$id}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    return $row;
}

function getUsersByType($type){
    $conn = getConnection();
    $data = array();
    if($conn){
        $query = "SELECT * FROM users WHERE user_type = ?";
        $stmt = $conn->prepare($query);
        if($stmt){
            $stmt -> bind_param("s", $type);
            if($stmt->execute()){
                $result = $stmt->get_result();
                if($result->num_rows>0){
                    while($row = $result->fetch_assoc()){
                        $data[] = $row;
                    }
                }
            }
            
        }
    }
    
    return $data;
}

function updateUserInfo($id, $name, $email, $password){
    $conn = getConnection();
    if($name == "" or $email == "" or $password == ""){
        return "Fields are empty or are not filled correctly";
    }
    else{
        $sql = "UPDATE users set username = '$name', email = '$email', PASSWORD = '$password' WHERE user_id = {$id}";
        if($conn->query($sql) == TRUE){
            return "User updated successfully";
        }
        else return "Unable to update";
    }
}
function insertUserInfo($name, $email, $password, $type){
    $conn = getConnection();

    $sql = "INSERT INTO users (USERNAME, EMAIL, PASSWORD, USER_TYPE) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $password, $type);

    
     if($stmt->execute()){
        $stmt->close();
        $conn->close();
        return "User inserted successfully";
    } else {
        $stmt->close();
        $conn->close();
        return "Unable to insert";
    } 
}
?>

