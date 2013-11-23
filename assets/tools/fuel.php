<?php

     ini_set('max_execution_time', 1200); //300 seconds = 5 minutes

     // Create connection
    $con=mysqli_connect("localhost","root","", "car");

    // Check connection
    if (mysqli_connect_errno($con))
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      echo("<br>");
    }

    // Create database
    /*$sql="CREATE DATABASE car";
    if (mysqli_query($con,$sql))
    {
      echo "Database my_db created successfully";
    }
    else
    {
      echo "Error creating database: " . mysqli_error($con);
    }*/
    
    // Create table
    //$sql="CREATE TABLE cars(Year INT, Make CHAR(15), Model CHAR(15), Engine CHAR(100), ID int AUTO_INCREMENT primary key NOT NULL, Fuel CHAR(50), Injection CHAR(50), Gallons CHAR(25), Power CHAR(100))";

    // Execute query
    /*if (mysqli_query($con,$sql))
    {
      echo "Table persons created successfully";
    }
    else
    {
      echo "Error creating table: " . mysqli_error($con);
    }*/

    mysqli_query($con, "DELETE FROM fuel");
    //mysqli_query($con, "ALTER TABLE `cars` auto_increment = 1");

    ini_set('max_execution_time', 600); //300 seconds = 5 minutes

    // Defining the basic scraping function
   function scrape_between($data, $start, $end)
   {
       $data = stristr($data, $start); // Stripping all data from before $start
       $data = substr($data, strlen($start));  // Stripping $start
       $stop = stripos($data, $end);   // Getting the position of the $end of the data to scrape
       $data = substr($data, 0, $stop);    // Stripping all data from after and including the $end of the data to scrape
       return $data;   // Returning the scraped data from the function
   }

   // Defining the basic cURL function
   function curl($url) 
   {
       // Assigning cURL options to an array
       $options = Array
       (
           CURLOPT_RETURNTRANSFER => TRUE,  // Setting cURL's option to return the webpage data
           CURLOPT_FOLLOWLOCATION => TRUE,  // Setting cURL to follow 'location' HTTP headers
           CURLOPT_AUTOREFERER => TRUE, // Automatically set the referer where following 'location' HTTP headers
           CURLOPT_CONNECTTIMEOUT => 120,   // Setting the amount of time (in seconds) before the request times out
           CURLOPT_TIMEOUT => 120,  // Setting the maximum amount of time for cURL to execute queries
           CURLOPT_MAXREDIRS => 10, // Setting the maximum number of redirections to follow
           CURLOPT_USERAGENT => "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1a2pre) Gecko/2008073000 Shredder/3.0a2pre ThunderBrowse/3.2.1.8",  // Setting the useragent
           CURLOPT_URL => $url, // Setting cURL's URL option with the $url variable passed into the function
       );

       $ch = curl_init();  // Initialising cURL
       curl_setopt_array($ch, $options);   // Setting cURL's options using the previously assigned array data in $options
       $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
       curl_close($ch);    // Closing cURL
       return $data;   // Returning the data from the function
   }

   $continue = TRUE;   // Assigning a boolean value of TRUE to the $continue variable

   $url = "http://www.automobilemag.com/car_specifications/t3_66_1/";    // Assigning the URL we want to scrape to the variable $url


   $results_page = curl($url); // Downloading the results page using our curl() funtion
   $results_page = scrape_between($results_page, "<table id=\"ctl00_ctl18_ctl00_rptSec_ctl00_dlistFilters\"", "<div id=\"ID_SpecN\""); // Scraping out only the middle section of the results page that contains our results
   $separate_results = explode("<td valign=\"top\">", $results_page);   // Exploding the results into separate parts into an array

   // For each separate result, scrape the URL
  foreach ($separate_results as $separate_result)
   {
       if ($separate_result != "")
       {
           $results_urls[] = "http://www.automobilemag.com" . scrape_between($separate_result, "href='", "'>"); // Scraping the page ID number and appending to the IMDb URL - Adding this URL to our URL array
       }
   }

   //One level deeper
   $n = 0;
   $z = 0;
   $size=sizeof($results_urls);

   //for($i=1; $i<2; $i++)
   //{
     $results_page1 = curl($results_urls[1]); //Downloading the results page1 using our curl() function
     $results_page1 = scrape_between($results_page1, "<table id=\"ctl00_ctl16_ctl00_rptSec_ctl00_dlistFilters\"", "<div class=\"mgn_b s8_f\">");    //Scrapping out only the section with links
       $separate_results1 = explode("<td valign=\"top\">", $results_page1);   //Expoding the results into separate parts into an array
     foreach($separate_results1 as $separate_result1)
     {
       if($separate_result1 != "")
       {
         $carInfo = scrape_between($separate_result1, "title=\"", "\"");
         $carInfo = explode(" ", $carInfo);
         $carSize = sizeof($carInfo);
         echo("CarSize: ");
         print_r($carInfo);
         echo("<br>");


         if($carSize>1)
         {
           if($carInfo[2] == "General" || $carInfo[2] == "Martin" || $carInfo[2] == "Rover")
           {
             $carInfo[1] = ($carInfo[1] . " " . $carInfo[2]);
             unset($carInfo[2]);
             $carInfo = array_values($carInfo);
           }
         }
         echo("Adjusted1: ");
         print_r($carInfo);
         echo("<br>");

         $carSize1 = sizeof($carInfo);

         if($carSize1 >3)
         {
           $carSize1 -= 2;
           for($i=1; $i<$carSize1; $i++)
           {
             $j = $i + 2;
             $carInfo[2] = ($carInfo[2] . " " . $carInfo[$j]);
             unset($carInfo[$j+1]);
           }
         }

         $results_urls1[] = "http://www.automobilemag.com" . scrape_between($separate_result1, "href='", "'>"); //Scraping the page

         if($results_urls1[0] != "http://www.automobilemag.com")
         {
           $final = curl($results_urls1[0]);

           if (strpos($final,'<div class="listing">') !== false)
           {
             $n = 0;
             $carFinal[$n] = scrape_between($final, "Fuel Economy:", "highway");
             echo("String Check: ");
             print_r($carFinal);
             echo("<br>");
             $carFinal[$n] = str_replace("Gasoline ", "", $carFinal[$n]);
             $carFinal[$n] = str_replace(" MPG ", "", $carFinal[$n]);
             $carFinal[$n] = str_replace("city", "", $carFinal[$n]);
             $carFinal[$n] = str_replace("EPA (08):, ", "", $carFinal[$n]);
             $carFinal[$n] = str_replace("Gasoline:,", "", $carFinal[$n]);
             echo("String Check1: ");
             print_r($carFinal);
             echo("<br>");
             $carFinal1 = explode(', ', $carFinal[$n]);
             unset($carFinal);
             $carFinal[0] = ($carFinal1[0] . "/" . $carFinal1[1]);

             echo("Car Info: ");
             print_r($carInfo);
             echo("<br>");
             echo("Fuel1: ");
             print_r($carFinal);
             echo("<br>");
             echo("<br>");
             $t=0;
             $fourth = $carFinal[$t];
             $first = $carInfo[$t];
             $t++;
             $second = $carInfo[$t];
             $t++;
             $third = $carInfo[$t];

             $query = "INSERT INTO fuel (Year, Make, Model, fuel)
                       VALUES ('$first', '$second', '$third', '$fourth')";

               mysqli_query($con, $query) or die(mysqli_error($con));
               unset($carFinal);
           }
           else
           {
             $final = scrape_between($final, "<div id=\"performance_efficiencyRow\">", "</td>");
             $carFinal[0] = "";
             if(strpos($final, 'Fuel economy EPA highway (mpg):') !== false)
             {
               $separate_results2[] = scrape_between($final, "fuel economy EPA highway (mpg): ", "</div>");
               echo("String Check: ");
               print_r($separate_results2);
               echo("<br>");
               $separate_results = str_replace(" and EPA city (mpg): ", "/", $separate_results2[0]);
               unset($separate_results2);
               $carFinal[0] = $separate_results;
             }
             elseif(strpos($final, 'Fuel economy: EPA (08):, ') !== false)
             {
               $separate_results2[] = scrape_between($final, "Fuel economy: EPA (08):, ", " MPG highway");
               echo("String Check: ");
               print_r($separate_results2);
               echo("<br>");
               $separate_results = str_replace(" MPG city, ", "/", $separate_results2[0]);
               unset($separate_results2);
               $carFinal[0] = $separate_results;
             }
             echo("Car Info: ");
             print_r($carInfo);
             echo("<br>");
             echo("Fuel2: ");
             print_r($carFinal);
             echo("<br>");
             echo("<br>");
             $t=0;
             $fourth = $carFinal[$t];
             $first = $carInfo[$t];
             $t++;
             $second = $carInfo[$t];
             $t++;
             $third = $carInfo[$t];
             $t++;

             $query = "INSERT INTO fuel (Year, Make, Model, fuel)
                       VALUES ('$first', '$second', '$third', '$fourth')";

             mysqli_query($con, $query) or die(mysqli_error($con));
             unset($carFinal);
           }
         }
         unset($results_urls1);
       }
     }
   //}

  mysqli_close($con);

?>