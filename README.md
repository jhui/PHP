PHP
===

Git clone or download the project to a local directory ($project_directory)

Put the datafile into $project_directory/data/uploads (3 sample .cvs files are already located in the directory)

Change to the following directory: cd $project_directory/src/main

Usage:   bargin filename item1 [item2 item3...]

Example: php -f bargin.php sample_data.csv burger

Testing scenaiors are listed in $project_directory/src/test/testing.txt

All PHPUnit tests are under $project_directory/src/test

System tested:
PHP 5.5.3
PHPUnit 3.7.27
Mac OS 10.8.4


