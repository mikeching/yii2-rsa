<?php

namespace mikeching\rsa;

use Yii;

class Rsa
{

	const TYPE_PRIVATE_KEY = 1;
	const TYPE_PUBLIC_KEY = 2;

	/**
	 * 获取资源标示
	 *
	 * @param $getType
	 *
	 * @return bool|resource
	 */
	private function getResourceId($getType)
	{

		$keyPrivateStr = Yii::$app->params['rsaPrivateKey'];
		$keyPublicStr = Yii::$app->params['rsaPublicKey'];

		switch($getType){
			case self::TYPE_PRIVATE_KEY:
				return openssl_pkey_get_private($keyPrivateStr);
			case self::TYPE_PUBLIC_KEY:
				return openssl_pkey_get_public($keyPublicStr);
			default:
				return false;
		}
	}

	/**
	 * 私钥加密
	 *
	 * @param $dataStr
	 *
	 * @return string
	 */
	public static function rsaPrivateEncrypt($dataStr)
	{
		$retData = '';
		$resourceId = self::getResourceId(self::TYPE_PRIVATE_KEY);

		openssl_private_encrypt( $dataStr, $retData, $resourceId );
		$retData = base64_encode( $retData );

		return $retData;

	}

	/**
	 * 通过公钥解密 私钥加密后的内容
	 *
	 * @param string $encryptedStr 私钥加密后的字符串
	 *
	 * @return string
	 */
	public static function rsaPublicDecrypt($encryptedStr)
	{
		$retData = '';
		$resourceId = self::getResourceId(self::TYPE_PUBLIC_KEY);

		openssl_public_decrypt( base64_decode( $encryptedStr ), $retData, $resourceId );

		return $retData;

	}

	/**
	 * 通过公钥进行加密
	 *
	 * @param $dataStr
	 *
	 * @return string
	 */
	public static function rsaPublicEncrypt($dataStr)
	{
		$retData = '';
		$resourceId = self::getResourceId(self::TYPE_PUBLIC_KEY);

		openssl_public_encrypt( $dataStr, $retData, $resourceId );
		$retData = base64_encode( $retData );

		return $retData;

	}

	/**
	 *
	 * 通过私钥解密 公钥加密的内容
	 *
	 * @param string $encryptedStr 公钥加密后的字符串
	 *
	 * @return string
	 */
	public static function rsaPrivateDecrypt($encryptedStr)
	{
		$retData = '';
		$resourceId = self::getResourceId(self::TYPE_PRIVATE_KEY);

		openssl_private_decrypt( base64_decode( $encryptedStr ), $retData, $resourceId );

		return $retData;

	}

}//End Function Class