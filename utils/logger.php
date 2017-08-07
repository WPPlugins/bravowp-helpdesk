<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

//Quick adding log info
//Example: "INFO", "TICKET UPDATE PROPERTY", "...data..."
function bwhd_systemlog_addentry( $type, $event, $message )
{
	
	//reading enabled log setting
	if ( get_option( "bwhd_log_enable", "no" ) == "yes" )
	{
	
		// Logging class initialization
		$log = new bwhd_systemlog_helper();
		
		// write message to the log file
		$log->lwrite( $type, $event, $message);
		 
		// close log file
		$log->lclose();
	
	}
	
}


class bwhd_systemlog_helper {
	
    // declare log file and file pointer as private properties
    private $log_file, $fp;
	
    // set log file (path and name)
    public function lfile($path) {
        $this->log_file = $path;
    }
	
    // write message to the log file
    public function lwrite($type, $event, $message) {
		
        // if file pointer doesn't exist, then open log file
        if (!is_resource($this->fp)) {
            $this->lopen();
        }
		
        // define current time and suppress E_WARNING if using the system TZ settings
        // (don't forget to set the INI setting date.timezone)
        $time = @date('[d/M/Y:H:i:s]');
		
        // write current time, script name and message to the log file
        fwrite($this->fp, "$time ($type) ($event) $message" . PHP_EOL);
    }
	
    // close log file (it's always a good idea to close a file when you're done with it)
    public function lclose() {
        fclose($this->fp);
    }
	
    // open log file (private method)
    private function lopen() {
		
        // in case of Windows set default log file
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $log_file_default = bwhd_globals()->plugin_url . '/logfile.txt';
        }
		
        // set default log file for Linux and other systems
        else {
            $log_file_default = '/tmp/logfile.txt';
        }
		
        // define log file from lfile method or use previously set default
        $lfile = $this->log_file ? $this->log_file : $log_file_default;
		
        // open log file for writing only and place file pointer at the end of the file
        // (if the file does not exist, try to create it)
        $this->fp = fopen($lfile, 'a') or exit("Can't open $lfile!");
		
    }
	
}

?>