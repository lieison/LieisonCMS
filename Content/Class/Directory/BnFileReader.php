<?php

/** 
 * @author Rolando Arriaza <rolignu90@gmail.com>
 * @copyright (c) 2012, ROLIGNU
 * @version 1.1
 * @license GPL
 */


class BinaryFileReader {
    
	protected $filename;
	protected $file;
	protected $available;
	
        /**
         * 
         * @param string $filename
         */
	public function __construct($filename) {
		$this->filename = $filename;
	}
	
        /**
         * 
         * @return type
         */
	public function getFile() {
		if(is_null($this->file)) {
			$this->file = fopen($this->filename, 'rb');
			$this->available = 0;
		}
		return $this->file;
	}
	
        /**
         * 
         */
	public function close() {
		fclose($this->getFile());
		$this->file  = NULL;
	}
	 
        /**
         * 
         * @return int
         */
	public function readUnsignedShort() {
		$bn = $this->read(2);
		$data = unpack('n', $bn);
		return $data[1];
	}
	
        /**
         * 
         * @return int
         */
	public function readShort() {
		$bn = $this->read(2);
		$data = unpack('n', $bn);
		if($data[1] >= pow(2, 15)) {
			$data[1] -= pow(2, 16);
		}
		return ($data[1]);
	}
	
        /**
         * 
         * @return int
         */
	public function readInt() {  
		return $this->readNInt();
	}
	
        /**
         * 
         * @return int
         */
	public function readNInt() {
		$bn = $this->read(4);
		$data = unpack('N', $bn); 
		return $data[1];
	}
	
        /**
         * 
         * @return int
         */
	public function readByte() {
		$bn = $this->read(1);
		$data = unpack('c', $bn);
		return $data[1];
	}
	
        /**
         * 
         * @return bool
         */
	public function readBool() {  
		return $this->readByte() == 1;
	}
	
        /**
         * 
         * @return int
         */
	public function  readUnsignedByte() {
		$bn = $this->read(1);
		$data = unpack('C', $bn);
		return $data[1];
	}
	
        /**
         * Read byte string.
         * @param int $size
         * @return string
         */
	public function readBString($size) {
		$bn = $this->read($size);
		$data = unpack('A'.$size, $bn);
		return $data[1];
	}
	
        /**
         * Read Pascal byte string.
         * @return string
         */
	public function readPBString() {
		$size = $this->readUnsignedByte(); 
		return $size > 0 ? $this->readBString($size) : NULL;
	}
	
	/**
         * Skip byte
         * @param int $sizeByte
         */
	public function skip($sizeByte) { 
		$this->read($sizeByte);
	}
	
        /**
         * 
         * @param int $sizeByte
         */
	public function back($sizeByte) {
		fseek($this->getFile(), -$sizeByte, SEEK_CUR );
		$this->available -= $sizeByte;
	}
	
        /**
         * 
         * @return int
         */
	public function available() {
		return $this->available;
	}
	
        /**
         * 
         * @param int $sizeByte
         * @return string
         */
	private function read($sizeByte) {
		if($sizeByte <= 0) {
			return '';			
		}
		$bn = fread($this->getFile(), $sizeByte); 
		$this->available += $sizeByte;
		return $bn;
	}
}