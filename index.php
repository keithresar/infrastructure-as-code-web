<?php

require_once("configure.php");

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Language Wizard</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">Language Wizard</a>
    </nav>

    <main role="main" class="container" style="margin-top:6em;">

      <form class="form-inline">
        <div class="form-group">
          <label for="url">Give URL to Scan</label>
          <input style="margin-left:2em; margin-right:2em; width:25em;" autocomplete="off" type="text" class="form-control" id="url" placeholder="http://example.com">
        </div>
        <button type="button" id="submit_url_btn" class="btn btn-primary">Submit</button>
      </form>
      <hr>

      <div id="results">
      </div>


      <div class="card" id="response_tpl" style="width: 100%; margin-bottom:2em;  display:none;">
        <div class="card-header">
          Request <span class="request_count"></span> (<span class="request_duration"></span>)
        </div>
        <div class="card-body" style="">
          <pre class="request_response">request pending on API server...</pre>
        </div>
      </div>

    </main><!--container -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>


  <script type="text/javascript">
  $(document).ready(function() {

        var request_count = 0;

        $(document).keypress(function(e) {
            if(e.which == 13)  { $("#submit_url_btn").click(); }
        });

        $("#submit_url_btn").click(function(){
            request_start_ms = Date.now()
            request_count++;
            el = $("#response_tpl").clone();
            el.removeAttr("id");
            el.find(".request_count").html(request_count);
            el.find(".request_duration").html('request in process');
            el.show().prependTo("#results");

            $.get("/api.php?url="+encodeURI($("#url").val()),function(o){
                request_duration_ms = Date.now()-request_start_ms;
                console.log(request_duration_ms);

                el.find(".request_duration").html(request_duration_ms+'ms');
                el.find(".request_response").html(o);

            },'html');

            return(false);
        });

  });
  </script>

  </body>
</html>
