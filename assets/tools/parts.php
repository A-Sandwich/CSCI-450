<?php
     
     echo memory_get_usage();
     echo("<br>");

     //ini_set('memory_limit','2048M');

     $con = new mysqli("localhost","root","", "parts");

     /*Check Connection*/
     if (mysqli_connect_errno())
     {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
       echo("<br>");
     }

     // Create database
     /*$sql="CREATE DATABASE Parts";
     if (mysqli_query($con,$sql))
     {
       echo "Database my_db created successfully";
       echo("<br>");
     }
     else
     {
       echo "Error creating database: " . mysqli_error($con);
       echo("<br>");
     }*/

     // Create table
     //$sql="CREATE TABLE parts(make CHAR(15),model CHAR(25),year INT, part CHAR(30), count INT, part_name CHAR(30), part_number CHAR(50), part_brand CHAR(30))";

     // Execute query
     /*if (mysqli_query($con,$sql))
     {
       echo "Table persons created successfully";
       echo("<br>");
     }
     else
     {
       echo "Error creating table: " . mysqli_error($con);
       echo("<br>");
     }*/

     //$sql = "DROP TABLE IF EXISTS temp";
     mysqli_query($con, "DELETE FROM temp");

     // Create table
     //$sql="CREATE TABLE temp(make CHAR(15),model CHAR(25),year INT, part CHAR(30), count INT, part_name CHAR(30), part_number CHAR(50), part_brand CHAR(30))";

     // Execute query
     /*if (mysqli_query($con,$sql))
     {
       echo "Table persons created successfully";
       echo("<br>");
     }
     else
     {
       echo "Error creating table: " . mysqli_error($con);
       echo("<br>");
     }*/

    //Defining the basic CURL function
    function curl($url)
    {
      $options = Array(
               CURLOPT_RETURNTRANSFER => TRUE,
               CURLOPT_FOLLOWLOCATION => TRUE,
               CURLOPT_AUTOREFERER => TRUE,
               CURLOPT_CONNECTTIMEOUT => 120,
               CURLOPT_TIMEOUT => 120,
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_USERAGENT => "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1a2pre) Gecko/2008073000 Shredder/3.0a2pre ThunderBrowse/3.2.1.8",
               CURLOPT_URL => $url,
      );

      $ch = curl_init(); //initializing CURL
      curl_setopt_array($ch, $options);
      $data = curl_exec($ch);
      curl_close($ch);
      return $data;
    }

    function scrape_between($data, $start, $end)
    {
      $data = stristr($data, $start);
      $data = substr($data, strlen($start));
      $stop = stripos($data, $end);
      $data = substr($data, 0, $stop);
      return $data;
    }

    $url = "http://www.autopartswar.com/";
    $results_page = curl($url);
    $results_page = scrape_between($results_page, "<ul class=\"green-dots cols col4\">", "<h2 id=\"by-year\">By Year <span class=\"noweight small\">");
    $separate_results = explode("<li>", $results_page);
    foreach($separate_results as $separate_result)
    {
      if($separate_result != "")
      {
        $results_urls[] = "http://www.autopartswar.com" . scrape_between($separate_result, "href=\"", "\">");
      }
    }

    $j = 0;
    //foreach($results_urls as $results_url) //expensive
    //{
      $listings_page = curl($results_urls[1]);
      $listings_page = scrape_between($listings_page, "<h2 class=\"underline\">Models</h2>", "</ul>");
      $separate_title = explode("<li>", $listings_page);
      unset($listings_page);
      unset($separate_title[0]);
      foreach($separate_title as $title)
      {
        $splitcheck = explode("\"", $title);
        $size = sizeof($splitcheck);
        for($i = 0; $i<=$size; $i++)
        {
          if($i%2==0)
          {
            unset($splitcheck[$i]);
          }
        }
        $final[$j] = $splitcheck[1];
        $j++;
      }
      unset($separate_title);
    //}
    $adjust = sizeof($final);
    for($i=0; $i<$adjust; $i++)
    {
      $final2[$i]="http://www.autopartswar.com" . $final[$i];
    }

    unset($separate_title);
    unset($splitcheck);
    unset($final);

    $k = 0;
    foreach($final2 as $final3)
    {
      $results_page3 = curl($final3);
      $results_page3 = scrape_between($results_page3, "<h2 class=\"underline\">Years</h2>", "</ul>");
      $separate_title3 = explode("<li>", $results_page3);
      foreach($separate_title3 as $title1)
      {
        $splitcheck1 = explode("\"", $title1);
        $size1 = sizeof($splitcheck1);
        for($i=0; $i<$size1; $i++)
        {
          if($i%2 == 0)
          {
            unset($splitcheck1[$i]);
          }
          else
          {
            $final5[$k] = "http://www.autopartswar.com" . $splitcheck1[$i];
            $k++;
          }
        }
      }
    }
    
    unset($final2);
    unset($results_page3);
    unset($separate_title3);
    unset($splitcheck1);

    $l = 0;
    foreach($final5 as $final6)
    {
      $results_page4 = curl($final6);
      $results_page4 = scrape_between($results_page4, "<div class=\"listings listings_col2\">", "</ul>");
      $separate_title4 = explode("<li>", $results_page4);

      foreach($separate_title4 as $title2)
      {
        if($title2 != "")
        {
          $splitcheck2 = explode("\"", $title2);
          $splitcheck22[] = scrape_between($title2, "</a> (", ")</li>");
          $size2 = sizeof($splitcheck2);
          for($i=0; $i<$size2; $i++)
          {
            if($i%2 == 0)
            {
              unset($splitcheck2[$i]);
            }
            else
            {
              $final7[$l] = "http://www.autopartswar.com" . $splitcheck2[$i];
              $l++;
            }
          }
        }
      }
    }
    
    unset($final5);
    unset($results_page4);
    unset($separate_title4);
    unset($splitcheck2);

    $s23 = sizeof($splitcheck22);
    for($i=0; $i<$s23; $i++)
    {
      if($splitcheck22[$i] == "")
      {
        unset($splitcheck22[$i]);
      }
    }
    $splitcheck22 = array_values($splitcheck22);

    $checksize = sizeof($final7);
    for($i=0; $i<$checksize; $i++)
    {
      if($final7[$i] == "http://www.autopartswar.comunderline")
      {
        unset($final7[$i]);
      }
    }

    $final7 = array_values($final7);
    $n = 0;
    foreach($final7 as $final10)
    {
      $results_page6 = curl($final10);
      $results_page6 = scrape_between($results_page6, "<div class=\"crumb\">", "<div class");
      $separate_title6 = explode("</strong>", $results_page6);

      foreach($separate_title6 as $title4)
      {
        if($title4 != "")
        {
          $splitcheck4[] = scrape_between($title4, "/\">", "</a>");
        }
      }
    }

    unset($results_page6);
    unset($separate_title6);

    
    $sizecheck2 = sizeof($splitcheck4);
    for($i=0; $i<$sizecheck2; $i++)
    {
      if($splitcheck4[$i] == "Auto Parts War")
      {
        unset($splitcheck4[$i]);
      }
    }

    $splitcheck4 = array_values($splitcheck4);
    $o = 0;
    $t = 0;
    $sizecheck = sizeof($splitcheck4);
    for($i=0; $i<$sizecheck; $i++)
    {
      if($i%4 == 0 && $i != 0)
      {
        $final12[$o] = $splitcheck22[$t];
        $o++;
        $t++;
      }
      $final12[$o] = $splitcheck4[$i];
      $o++;
    }
    $final12[$o] = $splitcheck22[$t];
    
    unset($splitcheck22);
    unset($splitcheck4);

    $sizecheck4 = sizeof($final12);
    for($i=0; $i<$sizecheck4; $i++)
    {
      if(($i+1)%5 == 0 && $i != 0)
      {
        if($final12[$i] == 0)
        {
          unset($final12[$i-4]);
          unset($final12[$i-3]);
          unset($final12[$i-2]);
          unset($final12[$i-1]);
          unset($final12[$i]);
        }
      }
    }

    $m = 0;
    foreach($final7 as $final8)
    {
      $results_page5 = curl($final8);
      $results_page5 = scrape_between($results_page5, "<h4>", "</div>");
      $separate_title5 = explode("<li>", $results_page5);

      foreach($separate_title5 as $title3)
      {
        if($title3 != "")
        {
          $splitcheck3 = explode("\"", $title3);
          $size3 = sizeof($splitcheck3);
          for($i=0; $i<$size3; $i++)
          {
            if($i != 1)
            {
              unset($splitcheck3[$i]);
            }
            else
            {
              $final9[$m] = "http://www.autopartswar.com" . $splitcheck3[$i];
              $m++;
            }
          }
        }
      }
    }

    unset($final7);
    unset($results_page5);
    unset($separate_title5);
    unset($splitcheck3);

    $p = 0;
    foreach($final9 as $final13)
    {
      $results_page7 = curl($final13);
      $results_page7 = scrape_between($results_page7, "<strong class=\"darker\">Part Name", "</p>");
      $separate_title7 = explode("</strong>", $results_page7);
      foreach($separate_title7 as $title5)
      {
        if($title5 != "")
        {
          $splitcheck5[] = scrape_between($title5, "\">", "</a>" );
        }
      }
    }
    
    unset($final9);
    unset($results_page7);
    unset($separate_title7);

    $sizecheck3 = sizeof($splitcheck5);
    for($i=0; $i<$sizecheck3; $i++)
    {
      if($splitcheck5[$i] == "")
      {
        unset($splitcheck5[$i]);
      }
    }

    $final12 = array_values($final12);
    $splitcheck5 = array_values($splitcheck5);

    $q = 0;
    $s = 0;   
    $last = sizeof($final12);
    for($i=0; $i<$last; $i++)
    {

      $parts[$q] = $final12[$i];
      $q++;
      if(($i+1)%5 == 0 && $i != 0)
      {
        $temp = $final12[$i];
        $r = 0;
        while($r < $temp)
        {
          for($j=0; $j<3; $j++)
          {
            $parts[$q] = $splitcheck5[$s];
            $s++;
            $q++;
          }
          if($temp != 1 && $r != ($temp-1))
          {
            $parts[$q] = $final12[$i-4];
            $q++;
            $parts[$q] = $final12[$i-3];
            $q++;
            $parts[$q] = $final12[$i-2];
            $q++;
            $parts[$q] = $final12[$i-1];
            $q++;
            $parts[$q] = $final12[$i];
            $q++;
          }
          $r++;
        }
      }
    }

    /*echo("Final12: ");
    print_r($final12);
    echo("<br>");
    echo("<br>");
    echo("Splitcheck5: ");
    print_r($splitcheck5);
    echo("<br>");
    echo("<br>");*/
    echo("Parts: ");
    print_r($parts);
    echo("<br>");
    echo("<br>");


    $i=0;
    $dataTable = sizeof($parts);
    while($i<$dataTable)
    {
      $first = $parts[$i];
      $first = mysql_real_escape_string($first);
      $second = $parts[$i+1];
      $second = mysql_real_escape_string($second);
      $third = $parts[$i+2];
      $third = mysql_real_escape_string($third);
      $fourth = $parts[$i+3];                   
      $fourth = mysql_real_escape_string($fourth);
      $fifth = $parts[$i+4];
      $fifth = mysql_real_escape_string($fifth);
      $sixth = $parts[$i+5];
      $sixth = mysql_real_escape_string($sixth);
      $seventh = $parts[$i+6];
      $seventh = mysql_real_escape_string($seventh);
      $eigth = $parts[$i+7];
      $eigth = mysql_real_escape_string($eigth);

      $query = "INSERT INTO parts (make, model, year, part,count, part_name, part_number, part_brand)
                         VALUES ('$first', '$second', '$third', '$fourth', '$fifth', '$sixth', '$seventh', '$eigth')";

      /*$query = "INSERT INTO temp (make, model, year, part,count, part_name, part_number, part_brand)
                         VALUES ('$first', '$second', '$third', '$fourth', '$fifth', '$sixth', '$seventh', '$eigth')";*/

      mysqli_query($con, $query) or die(mysqli_error($con));
      $i+=8;
    }

    mysqli_close($con);
    
    echo memory_get_usage();
    echo("<br>");

?>