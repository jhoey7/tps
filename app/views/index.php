<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

      <script>
      var base_url = '<?php echo base_url(); ?>';
      var site_url = '<?php echo site_url(); ?>';
      </script>
      <title>{_title_}</title>
      {_headers_}
    </head>
    <body class="signin">
      {_content_}
      {_footers_}
    </body>
</html>