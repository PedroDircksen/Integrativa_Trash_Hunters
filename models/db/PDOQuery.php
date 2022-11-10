<?php

/**
*
* Classe que executa queries utilizando a PDO.
*
* @author Emprezaz.com
*
**/
class PDOQuery
{

	private $pdo;
	private $password;

	public function __construct($configFile = null)
	{

		$this->pdo 		= PDOFactory::createPDO($configFile);
		$this->password = '@dO^b2jG3^gc';

	}

	public function executeQuery($query, array $pdoValues = array())
	{

		$stmt = $this->pdo->prepare($query);
		$stmt->execute($pdoValues);

		return $stmt;

	}

	public function fetch($select, array $pdoValues = array())
	{
		$values = array();
		foreach ($pdoValues as $key => $value) {
			$values[$key] = $pdoValues[$key];

			if(!mb_strpos(strtolower($key), 'id') 
			&& !mb_strpos(strtolower($key), 'date') 
			&& !mb_strpos(strtolower($key), 'code') 
			&& !mb_strpos(strtolower($key), 'status') 
			&& !mb_strpos(strtolower($key), 'number') 
			&& !mb_strpos(strtolower($key), 'type')
			&& !mb_strpos(strtolower($key), 'price')
			&& !mb_strpos(strtolower($key), 'time')
			&& !mb_strpos(strtolower($key), 'block')
			&& !mb_strpos(strtolower($key), 'phone')
			&& !mb_strpos(strtolower($key), 'whats')
			&& !mb_strpos(strtolower($key), 'name')
			&& !mb_strpos(strtolower($key), 'model')
			&& !mb_strpos(strtolower($key), 'capacity')
			&& !mb_strpos(strtolower($key), 'value')
			&& !mb_strpos(strtolower($key), 'score')){
				$pdoValues[$key] = $this->encrypt($this->password, $pdoValues[$key]);
			}
		}

		$stmt = $this->pdo->prepare($select);
		$stmt->execute($pdoValues);
		$row  = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!$row){
			$stmt = $this->pdo->prepare($select);
			$stmt->execute($values);
			$row  = $stmt->fetch(PDO::FETCH_ASSOC);
		}

		if($row){
			$keys = array_keys($row);
			foreach ($keys as $key => $value) {
				if(!mb_strpos(strtolower($value), 'id') 
				&& !mb_strpos(strtolower($value), 'date') 
				&& !mb_strpos(strtolower($key), 'code')
				&& !mb_strpos(strtolower($key), 'status') 
				&& !mb_strpos(strtolower($key), 'number') 
				&& !mb_strpos(strtolower($key), 'type')
				&& !mb_strpos(strtolower($key), 'price')
				&& !mb_strpos(strtolower($key), 'time')
				&& !mb_strpos(strtolower($key), 'block')
				&& !mb_strpos(strtolower($key), 'phone')
				&& !mb_strpos(strtolower($key), 'whats')
				&& !mb_strpos(strtolower($key), 'name')
				&& !mb_strpos(strtolower($key), 'model')
				&& !mb_strpos(strtolower($key), 'capacity')
				&& !mb_strpos(strtolower($key), 'value')
				&& !mb_strpos(strtolower($key), 'score')){
					$row[$value] = $this->decrypt($this->password, $row[$value]);
				}
			}
		}

		return $row;

	}

	public function fetchAll($select, array $pdoValues = array())
	{

		foreach ($pdoValues as $key => $value) {
			
			//verificando o que pode criptografar
			if(!mb_strpos(strtolower($key), 'id') 
			&& !mb_strpos(strtolower($key), 'date') 
			&& !mb_strpos(strtolower($key), 'code')
			&& !mb_strpos(strtolower($key), 'status') 
			&& !mb_strpos(strtolower($key), 'number')
			&& !mb_strpos(strtolower($key), 'type')
			&& !mb_strpos(strtolower($key), 'price')
			&& !mb_strpos(strtolower($key), 'time')
			&& !mb_strpos(strtolower($key), 'block')
			&& !mb_strpos(strtolower($key), 'phone')
			&& !mb_strpos(strtolower($key), 'whats')
			&& !mb_strpos(strtolower($key), 'name')
			&& !mb_strpos(strtolower($key), 'model')
			&& !mb_strpos(strtolower($key), 'capacity')
			&& !mb_strpos(strtolower($key), 'value')
			&& !mb_strpos(strtolower($key), 'score')){
				$pdoValues[$key] = $this->encrypt($this->password, $pdoValues[$key]);
			}
		}

		$stmt = $this->pdo->prepare($select);
		$stmt->execute($pdoValues);
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if($rows){
			foreach ($rows as $key => $value) {
				$keys = array_keys($value);
				foreach ($keys as $key2 => $value2) {
					if(!mb_strpos(strtolower($key), 'id') 
					&& !mb_strpos(strtolower($key), 'date') 
					&& !mb_strpos(strtolower($key), 'code')
					&& !mb_strpos(strtolower($key), 'status') 
					&& !mb_strpos(strtolower($key), 'number')
					&& !mb_strpos(strtolower($key), 'type')
					&& !mb_strpos(strtolower($key), 'price')
					&& !mb_strpos(strtolower($key), 'time')
					&& !mb_strpos(strtolower($key), 'block')
					&& !mb_strpos(strtolower($key), 'phone')
					&& !mb_strpos(strtolower($key), 'whats')
					&& !mb_strpos(strtolower($key), 'name')
					&& !mb_strpos(strtolower($key), 'model')
					&& !mb_strpos(strtolower($key), 'capacity')
					&& !mb_strpos(strtolower($key), 'value')
					&& !mb_strpos(strtolower($key), 'score')){
						$rows[$key][$value2] = $this->decrypt($this->password, $rows[$key][$value2]);
					}
				}
			}
		}

		return $rows;

	}

	private function encrypt($key, $data) {
		$encryptionKey = $key;
		$iv 		   = openssl_cipher_iv_length('aes-256-gcm');
		$encrypted 	   = openssl_encrypt($data, 'aes-256-gcm', $encryptionKey, 0, $iv, $tag);
		return base64_encode($encrypted . '::' . $iv . '::' . $tag);
	}
	
	
	private function decrypt($key, $data) {
		$encryptionKey = $key;
		$list          = explode('::', base64_decode($data));
		if(count($list) == 3){
			$encryptedData = $list[0];
			$iv			   = $list[1];
			$tag		   = $list[2];
			return openssl_decrypt($encryptedData, 'aes-256-gcm', $encryptionKey, 0, $iv, $tag);
		}else{
			return $data;
		}
	}

}