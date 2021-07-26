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

