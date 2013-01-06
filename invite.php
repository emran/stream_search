<?php include_once 'fbconfig.php';

  if (isset($_REQUEST['ids'])){
        header( 'Location: '.$baseUrl ) ;

    }
    ?>
<fb:serverfbml>
  <script type="text/fbml">
      <fb:fbml>
      <fb:request-form action='' method='POST'
          invite='true'
          type='Quiz'
          content='What is your Knorr flavour? <fb:req-choice url="<?php echo $baseUrl;?>" label="Accept and join" />  '>
          <fb:multi-friend-selector showborder='false' actiontext='Select friends to send the What is your Knorr flavour? Invitation' cols='5' rows='3' bypass='cancel' max="20" import_external_friends="false">
          </fb:request-form>
      </fb:fbml>
  </script>
</fb:serverfbml>

