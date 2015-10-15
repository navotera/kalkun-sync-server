<?php
/**
* Plugin Name: Sync_Server
* Plugin URI: navotera@yahoo.co.id
* Version: 0.1
* Description: Syncronize To Server, Baca Source Code untuk memahami fungsinya
* Author: Navotera
* Author URI: 
*/

// Add hook for incoming message
add_action("message.incoming.after", "sync_server_incoming", 11);

include_once(APPPATH.'plugins/sync_server/vendor/autoload.php');
/*
|--------------------------------------------------------------------------
| CONFIGURATION
|--------------------------------------------------------------------------
| 
| uid - identifier of which user sent the autoreply, uid 1 is the default value
| message - the message you want to sent
| 
*/
function sync_server_initialize()
{
  $config['uid'] = '1';
  
 
  return $config;
}



/**
* Function called when plugin first activated
* Utility function must be prefixed with the plugin name
* followed by an underscore.
* 
* Format: pluginname_activate
* 
*/
function sync_server_activate()
{
    
   

    return true;
}

/**
* Function called when plugin deactivated
* Utility function must be prefixed with the plugin name
* followed by an underscore.
* 
* Format: pluginname_deactivate
* 
*/
function sync_server_deactivate()
{
    return true;
}

/**
* Function called when plugin first installed into the database
* Utility function must be prefixed with the plugin name
* followed by an underscore.
* 
* Format: pluginname_install
* 
*/
function sync_server_install()
{
	$CI =& get_instance();
	$CI->load->helper('kalkun');
  $CI->load->model('sync_server/sync_server_model', 'plugin_model');
	// check if table already exist
	if (!$CI->db->table_exists('plugin_sync_server'))
	{
		$db_driver = $CI->db->platform();
		$db_prop = get_database_property($db_driver);
		execute_sql(APPPATH."plugins/sync_server/media/".$db_prop['file']."_sync_server.sql");
	}
    //return true;
    $cek_rest_url = $CI->plugin_model->get_rest_server_url();
    if($cek_rest_url)
    {
      return TRUE;
    }
    else {
      //isi form rest url server
      redirect(site_url().'/sync_server');
    }
     
}

function sync_server_incoming($sms)
{
    $CI =& get_instance();
    $CI->load->model('sync_server/sync_server_model', 'plugin_model');
   

   // $CI->load->model('Message_model', 'inbox');
    //verify sms
       $text = trim($sms->TextDecoded);

       $cek_spasi = substr_count($text, ' ');
       $cek_titik_dua = substr_count($text, ':');

       $pieces = explode(' ', $text);

       $msg = '';
       $error = 0;


       //cek error first
       if($cek_spasi != 5)
       {
           $msg = 'Format SMS anda tidak tepat, mohon periksa dan kirim sesuai dengan format yang benar (ket. spasi ada yang salah) @admin';
           $error = $error + 1;
       }

        if($cek_titik_dua != 6)
         {
            $msg = 'Format SMS anda tidak tepat, mohon periksa dan kirim sesuai dengan format yang benar (ket. titik dua ada yang salah) @admin';
            $error = $error + 1;   
         }
             
        if(count($pieces) != 6)
       {
            $msg = 'Format SMS anda tidak tepat, mohon periksa dan kirim sesuai dengan format yang benar  @admin';
            $error = $error + 1;
       }


        //no error
        if($error == 0)
        {
            
            $data_array = explode(' ', $sms->TextDecoded);

            $data['username'] = grab_value($data_array, 'user');   
            $data['area_id'] = grab_value($data_array, 'area', TRUE);
            $data['tps']     = grab_value($data_array, 'tps', TRUE);
            $data['cagub_1'] = grab_value($data_array, 'z', TRUE);
            $data['cagub_2'] = grab_value($data_array, 'b', TRUE);
            $data['cagub_3'] = grab_value($data_array, 'm', TRUE);
            $data['created_on'] = time();
            $data['inbox_id'] = $sms->ID;
            $data['telephone_number'] = $sms->SenderNumber;


            //post data
            post_data($data);


            $msg = 'Terima Kasih telah mengirimkan data dengan benar @admin';
            send_sms_error_reply($msg, $sms->SenderNumber);

         
        }
        else {
             send_sms_error_reply($msg, $sms->SenderNumber);
        }


       
       



               
    
   
}



    function send_sms_error_reply($msg, $phone_number)
    {
          
            $CI =& get_instance();
            $CI->load->model('Message_model');
            $data['coding'] = 'default';
            $data['class'] = '1';
            $data['dest'] = $phone_number;
            $data['date'] = date('Y-m-d H:i:s');
            $data['message'] = $msg;
            $data['delivery_report'] = 'default';
            $data['uid'] = 1;  
            $CI->Message_model->send_messages($data);
    }



     function grab_value($array, $param, $numeric_only=FALSE)
      {
         $array = array_map('strtolower', $array);
         $input = preg_quote($param, '~'); // don't forget to quote input string!
         $prep = preg_grep('~' . $input . '~', $array);
          

          $prep = reset($prep); 
          $value = substr($prep, strpos($prep, ":") + 1);   
          if($numeric_only)
          {
            $value = str_replace("o",0,$value);
            $value = str_replace("O",0,$value);
          }
          return $value;
      }


      function post_data($data_array)
      {
         $CI =& get_instance();
         $CI->load->model('sync_server/sync_server_model', 'plugin_model');

         $config = $CI->plugin_model->get_rest_server_url()->row();
         $rest_client = new Pest($config->rest_server_url);
         $result = $rest_client->post('/sync_sms',$data_array);

         return $result;
    
      }



/* End of file blacklist_number.php */
/* Location: ./application/plugins/blacklist_number/blacklist_number.php */