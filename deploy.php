<?php
//Prerequisite:
// - valid ssh key
// - .env with DEPLOY_KEY

$log ='git-deploy-$(date +%F_%Hh%MM%Ss).log';

$key = $_GET["key"];
//TODO read .env end get DEPLOY_KEY
$repoUri = $_GET["repo"];
$revision = $_GET["revision"];

$beforeCmd = $_GET["before"];
$afterCmd = $_GET["after"];

$updateFilesCmd="git archive --remote=$repoUri --format=tar $revision | (tar xf -) ";

$cmds = [$beforeCmd,$updateFilesCmd,$afterCmd];

foreach ($cmds as $cmd)
{
    $result = exec("$cmd 2>>$log >>$log");
}