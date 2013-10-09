<?php

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
     //$scraped_website = curl("http://www.imdb.com/search/title?genres=action");

     // While $continue is TRUE, i.e. there are more search results pages
     $counter=0;
     while ($continue == TRUE)
     {
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
         sleep(rand(3,5));   // Sleep for 3 to 5 seconds. Useful if not using proxies. We don't want to get into trouble.
         $counter++;
         if($counter==5)
         {
           $continue=FALSE;
         }
     }
     
     //One level deeper
     $continue = TRUE;
     $counter=0;
     while ($continue == TRUE)
     {
       for($i=1; $i<sizeof($results_urls); $i++)
       {
         $results_page1 = curl($results_urls[$i]); //Downloading the results page1 using our curl() function
         $results_page1 = scrape_between($results_page1, "<table id=\"ctl00_ctl16_ctl00_rptSec_ctl00_dlistFilters\"", "<div class=\"mgn_b s8_f\">");    //Scrapping out only the section with links
         $separate_results1 = explode("<td valign=\"top\">", $results_page1);   //Expoding the results into separate parts into an array
         
         foreach($separate_results1 as $separate_result1)
         {
           if($separate_result1 != "")
           {
             $results_urls1[] = "http://www.automobilemag.com" . scrape_between($separate_result1, "href='", "'>"); //Scraping the page
           }
         }
       }
       sleep(rand(3,5));    //Sleep for 3 to 5 seconds.
       $counter++;
       if($counter==5)
       {
         $continue=FALSE;
       }
     }

     //print_r($separate_results);
     echo("<br>");
     echo("<br>");
     print_r($results_urls);
     $file = 'C:\wamp\www\Garage\carfinal.txt';
     file_put_contents($file, $results_page);
     /*$file1 = 'C:\wamp\www\Garage\carfinaltest.txt';
     file_put_contents($file1, $separate_results);
     echo("<br>");
     echo("<br>");
     print_r($results_urls1);    */

    foreach($results_urls1 as $result_url1)
    {
      //Visit $result_url1(Reference Part 1)
      //Scrape data from page (Reference Part 1)
      //Add to array or other suitable data structure (Reference part 2)

      set_time_limit(600);     //Setting execution time to 1 miunte for each itereation of the loop
      $listing_page = curl($result_url1);          //Retrieving listing page
      $listing_titles[] = scrape_between($listing_page, "<h3 class=\"header\">", "</ul>");  //Scraping
      sleep(rand(3,5));
    }
    
    print_r($listing_titles);
    $file2 = 'C:\wamp\www\Garage\carfinaloutput.txt';
    file_put_contents($file2, $listing_titles);

?>