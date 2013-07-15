<?php

    require "../../api/sphinxapi.php";
   

$sphinxClient = new SphinxClient();
$sphinxClient->SetServer( 'localhost', 3312 );
$sphinxClient->SetConnectTimeout( 1 );

// This gives the title more weight than the
// body text for searches.
$sphinxClient->SetFieldWeights(array('nick' => 70,'location'=>50));

// Use the exteneded v2 match type
$sphinxClient->SetMatchMode( SPH_MATCH_ALL );

// Set the maximum number of search results to return
//$sphinxClient->SetLimits( 0, 20, 1000 );
$sphinxClient->SetLimits( 0, 20);

// Set how to rank the weighted values
$sphinxClient->SetRankingMode( SPH_RANK_PROXIMITY_BM25 );

// Give me back the results as an array
$sphinxClient->SetArrayResult( true );
//$searchQuery = $_GET['query'];
//sphinx_query($searchQuery);
    function sphinx_query($searchQuery)
    {   global $sphinxClient;


       // $searchQuery = $_GET['query'];
        $searchResults = $sphinxClient->query( $searchQuery, '*' );


        $str = "select * from search_details where id = 0  ";

        foreach($searchResults['matches'] as $x)
        {

            $str.="or ";
         //   echo "case <br/>";
        //   echo "id is {$x['id']} name is {$x['name']} weight is {$x['weight']} <br/>";
           $str.= "id = {$x['id']} ";
        }
        
        return $str;

        //echo json_encode($jhash);
    }
?>