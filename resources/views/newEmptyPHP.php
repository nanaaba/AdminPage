<?php

$reviews = $productinfo['reviews']['details'];
if (sizeof($reviews) > 0) {
    foreach ($reviews as $review) {
        if (empty($review['user'])) {
            $user = 'Anomynous';
        } else {
            $user = $review['user'];
        }
        echo ' <tr>
           <td style="width: 50%;"><strong><span>' . $user . '</span></strong></td>
             <td class="text-right"><span>' . $review['dateAdded'] . '</span></td>
            </tr>
              <tr>
             <td colspan="2"><p>' . $review['comment'] . '</p>
            <div class="rating">';

        if ($review['rating'] == 5) {
            echo ' <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x">

                                        </i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                      <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                     <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>';
        }

        if ($review['rating'] == 4) {
            echo ' <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x">

                                        </i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                      <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                     
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>';
        }

        if ($review['rating'] == 3) {
            echo ' <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x">  </i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                       <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                      <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>';
        }


        if ($review['rating'] == 2) {
            echo ' <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x">

                                        </i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                     
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                     
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>';
        }

        if ($review['rating'] == 1) {
            echo ' <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                     
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                     
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>';
        }

        ' </div></td>
                                                </tr>';
    }

  
    
}
?>
