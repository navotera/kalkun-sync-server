<?php $this->load->view('js_sync_server');?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="<?php echo base_url();?>media/css/bootstrap.css">

<!-- Optional theme -->
<link rel="stylesheet" href="<?php echo base_url();?>media/css/bootstrap-theme.min.css">





<div class="panel panel-default">
  <div class="panel-body">

    <?php 
      if($rest_server_url) { 
        echo " <h3><u>Fungsi Plugin </u> </h3>
             <p> Plugin ini akan mensinkroniskan data ke server, anda harus membaca source code untuk memahami fungsinya dan konfigurasinya </p>
            <p> <b> Deskripsi : </b> </p>
            <p> plugin ini berjalan otomatis saat sms diterima dan akan mengirimkannya ke server sesuai dengan format yang diinginkan (lihat source code) </p>
      ";
    }
    else { 
    ?>

      <h2> Isi form alamat rest server berikut : </h2> 
      <form action="<?php echo site_url();?>/sync_server/post_rest_server_url" method="POST">
      <input class="rest_server_url" type="url" name="rest_server_url" placeholder="Isi Alamat Rest Server" />
      <input type="submit" value="Submit" />

    <?php } ?>
   

    <?php 

    $value = str_replace("O",0,'1O');
    echo $value;

    /*  include_once(APPPATH.'plugins/sync_server/vendor/autoload.php');

        $string = 'user:ah3 z:15 b:22 User:10 m:33 tps:103 area:20';
       // echo substr_count($string, ' ');
        //echo substr_count($string, ':');
        $array = explode(' ', $string);
      


        
       
     $data['username'] = grab_value($array, 'user');   
      $data['area_id'] = grab_value($array, 'area');
      $data['tps'] = grab_value($array, 'tps');
      $data['cagub_1'] = grab_value($array, 'z');
      $data['cagub_2'] = grab_value($array, 'b');
      $data['cagub_3'] = grab_value($array, 'm');
      $data['created_on'] = time();
      $data['telephone_number'] = '023333008484';
      
      
      //var_dump($data);
      
      function grab_value($array, $param)
      {
         $array = array_map('strtolower', $array);
         $input = preg_quote($param, '~'); // don't forget to quote input string!
         $prep = preg_grep('~' . $input . '~', $array);
          

          $prep = reset($prep); 
          return substr($prep, strpos($prep, ":") + 1);   
      }




    

      $pest = new Pest('http://localhost/web_rtc/index.php/');
try {
    $rest = $pest->post('/sync_sms',$data);
} catch (Pest_InvalidRecord $e) {
    // 422
    echo "Data for Thing is invalid because: ".$e->getMessage();
}
      
*/
      
      //var_dump($rest);


    ?>

  </div>
</div>




<style type="text/css">
	#top_navigation {height: auto !important;}
	.panel, .panel-body { padding: 10px;}
	.pull-right { float: right;}
	.clearfix { clear: both;}
  .rest_server_url { width: 70% !important;}
  .loading { display: none;}


	.spinner {
	  margin: 12px auto 0;
	  width: 70px;
	  text-align: center;
	  
	}

.spinner > div {
  width: 18px;
  height: 18px;
  background-color: #0910A1;

  border-radius: 100%;
  display: inline-block;
  -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
  animation: sk-bouncedelay 1.4s infinite ease-in-out both;
}

.spinner .bounce1 {
  -webkit-animation-delay: -0.32s;
  animation-delay: -0.32s;
}

.spinner .bounce2 {
  -webkit-animation-delay: -0.16s;
  animation-delay: -0.16s;
}

@-webkit-keyframes sk-bouncedelay {
  0%, 80%, 100% { -webkit-transform: scale(0) }
  40% { -webkit-transform: scale(1.0) }
}

@keyframes sk-bouncedelay {
  0%, 80%, 100% { 
    -webkit-transform: scale(0);
    transform: scale(0);
  } 40% { 
    -webkit-transform: scale(1.0);
    transform: scale(1.0);
  }
}


</style>