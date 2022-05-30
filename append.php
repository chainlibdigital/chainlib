<?php

function scanAllDir($directory, $allFiles = [])
{
    $files = array_diff(scandir($directory), ['.', '..']);
    foreach ($files as $file) {
        $fullPath = $directory . DIRECTORY_SEPARATOR . $file;
        if (is_dir($fullPath)) {
            $allFiles[] = $fullPath;
            $allFiles += scanAllDir($fullPath, $allFiles);
        }
    }
    return $allFiles;
}

function getRandomFile($dirToChange)
{
    $files = glob(realpath($dirToChange) . '/*.*');
    $file = array_rand($files);
    return $files[$file];
}

function getFileContent($fileName)
{
    $randomOffset = rand(500, 1000);
    return file_get_contents(
        $fileName, false, null, $randomOffset
    );
}

function appendContent($fileName, $content)
{
    $myFile = fopen($fileName, "a") or die("Unable to open file!");
    $txt = $content;
    fwrite($myFile, "\n" . $txt);
    fclose($myFile);
}

$rand = rand(1, 5);
echo $rand;

for ($i=0; $i<=$rand; $i++) {
    $dirList = ['app', 'resources/views', 'database'];
    $allDirectories = scanAllDir($dirList[rand(0, count($dirList) - 1)]);

    shuffle($allDirectories);
    $directory = $allDirectories[0] . '/';

    shuffle($allDirectories);
    $dirToChange = $allDirectories[0] . '/';

    $files = scandir($directory);

    shuffle($files);

    $file = $files[0];
    if (!is_dir($directory . $file)) {
        $randomFile = getRandomFile($dirToChange);
        if (pathinfo($directory . $file)['extension'] === 'php' && pathinfo($randomFile)['extension'] === 'php') {
            $content = getFileContent($directory . $file);
            appendContent($randomFile, $content);
        }
    }
}
