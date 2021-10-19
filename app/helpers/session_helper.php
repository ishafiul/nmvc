<?php
  session_start();

  // Flash message helper
  // EXAMPLE - flash('register_success', 'You are now registered');
  // DISPLAY IN VIEW - echo flash('register_success');
  function reloadflash($name = '', $message = '', $path = '',$class = 'alert alert-success'){
    if(!empty($name)){
      if(!empty($message) && empty($_SESSION[$name])){
        if(!empty($_SESSION[$name])){
          unset($_SESSION[$name]);
        }

        if(!empty($_SESSION[$name. '_class'])){
          unset($_SESSION[$name. '_class']);
        }

        $_SESSION[$name] = $message;
        $_SESSION[$name. '_class'] = $class;
      } elseif(empty($message) && !empty($_SESSION[$name])){
          $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
          $html='';
          $html .='<div class="'.$class.'" id="msg-flash"><p>'.$_SESSION[$name].'</p>';
          $html .='<p>Processing..</p><progress value="0" max="100" id="progressBar"></progress>';
          $html .=' 
                     <script>
                            var timeleft = 5;
                            var downloadTimer = setInterval(function(){
                                if(timeleft <= 0){
                                    clearInterval(downloadTimer);
                                }
                                document.getElementById("progressBar").value = 95 - timeleft;
                                timeleft -= 4;
                            }, 200);
                        </script>';
          $html .='</div>';
          echo $html;
          unset($_SESSION[$name]);
          unset($_SESSION[$name. '_class']);
      }
      if (!empty($path)){

          header('Refresh: 2; url ='. URLROOT . '/' . $path);

      }


    }
  }
function flash($name = '', $message = '',$class = 'alert alert-success'){
    if(!empty($name)){
        if(!empty($message) && empty($_SESSION[$name])){
            if(!empty($_SESSION[$name])){
                unset($_SESSION[$name]);
            }

            if(!empty($_SESSION[$name. '_class'])){
                unset($_SESSION[$name. '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name. '_class'] = $class;
        } elseif(empty($message) && !empty($_SESSION[$name])){
            $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
            $html='';
            $html .='<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name];
            $html .='</div>';
            echo $html;
            unset($_SESSION[$name]);
            unset($_SESSION[$name. '_class']);
        }
    }
}
function isLoggedIn(){
    if(isset($_SESSION['user_id'])){
        return true;
    } else {
        return false;
    }
}
function loadmore($totaldata,$limit,$rowcount,$loadbutton,$postarea,$url){
   ?>
    <script>
        $(document).ready(function(){

            // Load more data
            $('<?php echo $loadbutton?>').click(function(){
                var row = Number($('<?php echo $rowcount?>').val());
                var allcount = <?php echo $totaldata?>;
                row = row + <?php echo $limit?>;

                if(row <= allcount){
                    $("<?php echo $rowcount?>").val(row);

                    $.ajax({
                        url: '<?php echo $url?>',
                        type: 'post',
                        data: {row:row},
                        beforeSend:function(){
                            $("<?php echo $loadbutton?>").text("Loading...");
                        },
                        success: function(response){

                            // Setting little delay while displaying new content
                            setTimeout(function() {
                                // appending posts after last post with class="post"
                                $("<?php echo $postarea?>:last").after(response).show().fadeIn("slow");

                                var rowno = row + <?php echo $limit?>;

                                // checking row value is greater than allcount or not
                                if(rowno > allcount){

                                    // Change the text and background
                                    $('<?php echo $loadbutton?>').text("Hide");
                                }else{
                                    $("<?php echo $loadbutton?>").text("Load more");
                                }
                            }, 2000);


                        }
                    });
                }else{
                    $('<?php echo $loadbutton?>').text("Loading...");

                    // Setting little delay while removing contents
                    setTimeout(function() {

                        // When row is greater than allcount then remove all class='post' element after  element
                        $('<?php echo $postarea?>:nth-child(<?php echo $limit?>)').nextAll('<?php echo $postarea?>').remove().fadeIn("slow");

                        // Reset the value of row
                        $("<?php echo $rowcount?>").val(0);

                        // Change the text and background
                        $('<?php echo $loadbutton?>').text("Load more");

                    }, 1000);


                }

            });

        });
    </script>
<?php
}
?>

