<?php
session_start(); header('Content-Type: application/json; charset=utf-8');
require __DIR__.'/db.php';
function reply($success,$message,$redirect=null){echo json_encode(['success'=>$success,'message'=>$message,'redirect'=>$redirect]);exit;}
if($_SERVER['REQUEST_METHOD']!=='POST') reply(false,'Invalid request.');
$action=$_POST['action']??''; $email=trim(strtolower($_POST['email']??'')); $password=$_POST['password']??'';
if(!filter_var($email,FILTER_VALIDATE_EMAIL))reply(false,'Please enter a valid email address.');
if($action==='register'){
$name=trim($_POST['name']??'');$studentId=trim($_POST['student_id']??'');
if(strlen($name)<2)reply(false,'Please enter your name.');if(strlen($password)<8)reply(false,'Password must be at least 8 characters.');
try{$check=$pdo->prepare('SELECT id FROM users WHERE email=?');$check->execute([$email]);if($check->fetch())reply(false,'This email is already registered. Try logging in.');
$hash=password_hash($password,PASSWORD_DEFAULT);$stmt=$pdo->prepare('INSERT INTO users (full_name,email,password_hash,student_id) VALUES (?,?,?,?)');$stmt->execute([$name,$email,$hash,$studentId?:null]);$_SESSION['user_id']=$pdo->lastInsertId();$_SESSION['full_name']=$name;reply(true,'Account created successfully!','backend/dashboard.php');}catch(PDOException $e){reply(false,'Registration failed. Please try again.');}
}elseif($action==='login'){
$stmt=$pdo->prepare('SELECT id,full_name,password_hash FROM users WHERE email=?');$stmt->execute([$email]);$user=$stmt->fetch();if(!$user||!password_verify($password,$user['password_hash']))reply(false,'Incorrect email or password.');session_regenerate_id(true);$_SESSION['user_id']=$user['id'];$_SESSION['full_name']=$user['full_name'];reply(true,'Logged in!','backend/dashboard.php');
}else reply(false,'Unknown action.');
