<?php
   function encrypt($sData, $sKey)
   {
      $sResult = '';

      for($i = 0; $i < strlen($sData); $i ++)
      {
         $sChar    = substr($sData, $i, 1);
         $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
         $sChar    = chr(ord($sChar) + ord($sKeyChar));
         $sResult .= $sChar;
      }

      return encode_base64($sResult);
   }

   function decrypt($sData, $sKey)
   {
      $sResult = '';
      $sData   = decode_base64($sData);

      for($i = 0; $i < strlen($sData); $i ++)
      {
         $sChar    = substr($sData, $i, 1);
         $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
         $sChar    = chr(ord($sChar) - ord($sKeyChar));
         $sResult .= $sChar;
      }

      return $sResult;
   }

   function encode_base64($sData)
   {
      $sBase64 = base64_encode($sData);

      return strtr($sBase64, '+/', '-_');
   }

   function decode_base64($sData)
   {
      $sBase64 = strtr($sData, '-_', '+/');

      return base64_decode($sBase64);
   }
   
   $enc=encode_base64("Most.Pravo.Simnuvanja-1");
   echo "encrypt ".$enc."<br>";
   echo "decrypt ".decode_base64($enc);
?>